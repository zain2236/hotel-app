<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::id()) {
            return redirect()->route('login');
        }

        $usertype = Auth()->user()->usertype;

        if ($usertype == 'user') {
            $userBookings = Booking::where('user_id', Auth::id())
                ->with('room')
                ->latest()
                ->take(5)
                ->get();
            
            $stats = [
                'total_bookings' => Booking::where('user_id', Auth::id())->count(),
                'pending_bookings' => Booking::where('user_id', Auth::id())->where('status', 'pending')->count(),
                'confirmed_bookings' => Booking::where('user_id', Auth::id())->where('status', 'confirmed')->count(),
            ];
            
            return view('user.dashboard', compact('userBookings', 'stats'));
        } else if ($usertype == 'admin') {
            $stats = [
                'total_rooms' => Room::count(),
                'available_rooms' => Room::where('available', true)->count(),
                'total_bookings' => Booking::count(),
                'pending_bookings' => Booking::where('status', 'pending')->count(),
                'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
                'total_revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
            ];
            
            try {
                $recentBookings = Booking::with(['room', 'user'])
                    ->latest()
                    ->take(5)
                    ->get();
            } catch (\Exception $e) {
                $recentBookings = collect([]); // Empty collection if there's an error
            }
            
            return view('admin.index', compact('stats', 'recentBookings'));
        } else {
            return redirect()->back();
        }
    }

    public function home()
    {
        $rooms = Room::where('available', true)->latest()->take(6)->get();
        return view('home.index', compact('rooms'));
    }
}
