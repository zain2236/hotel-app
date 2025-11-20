<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ensure this is an admin route request
        if (!request()->is('admin/rooms*')) {
            abort(404, 'Route not found. Admin room routes must be accessed via /admin/rooms');
        }
        
        // Ensure user is admin (double check)
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized. Admin access required.');
        }
        
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'capacity' => 'required|integer|min:1',
                'room_type' => 'required|string|max:255',
                'available' => 'boolean',
                'amenities' => 'nullable|string',
            ]);

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('rooms', 'public');
            }

            $validated['available'] = $request->has('available');

            Room::create($validated);

            return redirect()->route('admin.rooms.index')
                ->with('success', 'Room created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create room: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        
        // Check if this is an admin request or public request
        // Admin routes use /admin/rooms/{id}, public uses /room/{id}
        if (request()->is('admin/rooms/*')) {
            return view('admin.rooms.show', compact('room'));
        }
        
        return view('home.room-detail', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'capacity' => 'required|integer|min:1',
            'room_type' => 'required|string|max:255',
            'available' => 'boolean',
            'amenities' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        $validated['available'] = $request->has('available');

        $room->update($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully.');
    }

    /**
     * Display rooms for public view
     */
    public function publicIndex(Request $request)
    {
        $query = Room::where('available', true);
        
        // Filter by check-in/check-out dates
        if ($request->has('check_in') && $request->has('check_out')) {
            $checkIn = Carbon::parse($request->check_in);
            $checkOut = Carbon::parse($request->check_out);
            
            // Get room IDs that are booked during this period
            $bookedRoomIds = Booking::where('status', '!=', 'cancelled')
                ->where(function($q) use ($checkIn, $checkOut) {
                    $q->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut])
                      ->orWhere(function($q2) use ($checkIn, $checkOut) {
                          $q2->where('check_in', '<=', $checkIn)
                             ->where('check_out', '>=', $checkOut);
                      });
                })
                ->pluck('room_id');
            
            $query->whereNotIn('id', $bookedRoomIds);
        }
        
        // Filter by capacity - exact match for 1-3, >= for 4+
        if ($request->has('guests') && $request->guests) {
            $guests = (int) $request->guests;
            if ($guests >= 4) {
                // For 4+ guests, show rooms that can accommodate 4 or more
                $query->where('capacity', '>=', 4);
            } else {
                // For 1, 2, or 3 guests, show rooms with exact capacity
                $query->where('capacity', '=', $guests);
            }
        }
        
        $rooms = $query->latest()->get();
        return view('home.rooms-public', compact('rooms'));
    }
}
