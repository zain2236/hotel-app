<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ensure this is an admin route request
        if (!request()->is('admin/bookings*')) {
            abort(404, 'Route not found. Admin booking routes must be accessed via /admin/bookings');
        }
        
        // Ensure user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized. Admin access required.');
        }
        
        $bookings = Booking::with(['room', 'user'])->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::where('available', true)->get();
        return view('admin.bookings.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if this is an admin route request
        $isAdminRoute = request()->is('admin/bookings*');
        
        if ($isAdminRoute) {
            // Ensure user is admin for admin booking creation
            if (!Auth::check() || Auth::user()->usertype !== 'admin') {
                abort(403, 'Unauthorized. Admin access required.');
            }
        } else {
            // Public booking - just need to be authenticated
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Please login to make a booking.');
            }
        }

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'nullable|string|max:255',
            'special_requests' => 'nullable|string',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check if room is available for the dates
        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);

        // Check for conflicting bookings
        $conflictingBooking = Booking::where('room_id', $room->id)
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->where(function($q) use ($checkIn, $checkOut) {
                    // Check if new booking overlaps with existing bookings
                    $q->where(function($q2) use ($checkIn, $checkOut) {
                        // New check-in is between existing booking dates
                        $q2->where('check_in', '<=', $checkIn)
                           ->where('check_out', '>', $checkIn);
                    })->orWhere(function($q2) use ($checkIn, $checkOut) {
                        // New check-out is between existing booking dates
                        $q2->where('check_in', '<', $checkOut)
                           ->where('check_out', '>=', $checkOut);
                    })->orWhere(function($q2) use ($checkIn, $checkOut) {
                        // New booking completely contains existing booking
                        $q2->where('check_in', '>=', $checkIn)
                           ->where('check_out', '<=', $checkOut);
                    });
                });
            })
            ->exists();

        if ($conflictingBooking) {
            return back()->withErrors(['room_id' => 'Room is not available for the selected dates.'])->withInput();
        }

        // Check capacity
        if ($validated['guests'] > $room->capacity) {
            return back()->withErrors(['guests' => 'Number of guests exceeds room capacity.'])->withInput();
        }

        $validated['user_id'] = Auth::id();
        $validated['total_price'] = $room->price * $nights;
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);

        // Redirect based on route type
        if ($isAdminRoute) {
            return redirect()->route('admin.bookings.index')
                ->with('success', 'Booking created successfully.');
        } else {
            return redirect()->route('bookings.success')
                ->with('success', 'Booking created successfully. We will confirm shortly.')
                ->with('booking', $booking->load('room'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ensure user is admin (double check)
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized. Admin access required.');
        }
        
        try {
            $booking = Booking::with(['room', 'user'])->findOrFail($id);
            return view('admin.bookings.show', compact('booking'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Booking not found.');
        } catch (\Exception $e) {
            return redirect()->route('admin.bookings.index')
                ->with('error', 'Error loading booking: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $rooms = Room::all();
        return view('admin.bookings.edit', compact('booking', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        // Recalculate price if dates changed
        if ($booking->check_in != $validated['check_in'] || $booking->check_out != $validated['check_out']) {
            $checkIn = Carbon::parse($validated['check_in']);
            $checkOut = Carbon::parse($validated['check_out']);
            $nights = $checkIn->diffInDays($checkOut);
            $validated['total_price'] = $booking->room->price * $nights;
        }

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Show booking success page
     */
    public function success()
    {
        return view('home.booking-success');
    }
}
