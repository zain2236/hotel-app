<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    /**
     * Display user's bookings
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('room')
            ->latest()
            ->paginate(10);
        
        return view('user.bookings', compact('bookings'));
    }

    /**
     * Show booking details
     */
    public function show($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with('room')
            ->findOrFail($id);
        
        return view('user.booking-detail', compact('booking'));
    }

    /**
     * Update booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);

        // Only allow cancellation for pending/confirmed bookings
        if ($booking->status == 'cancelled' || $booking->status == 'completed') {
            return back()->withErrors(['status' => 'Cannot modify this booking.']);
        }

        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $booking->room->capacity,
        ]);

        // Recalculate price
        $checkIn = \Carbon\Carbon::parse($validated['check_in']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        $validated['total_price'] = $booking->room->price * $nights;

        $booking->update($validated);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Cancel booking
     */
    public function destroy($id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);

        if ($booking->status == 'cancelled') {
            return back()->withErrors(['status' => 'Booking is already cancelled.']);
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }
}
