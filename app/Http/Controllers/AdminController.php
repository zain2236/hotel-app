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

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Here you can add email sending logic or save to database
        // For now, we'll just return success message
        
        return redirect()->route('homepage')->with('success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }

    /**
     * Get booking statistics for charts
     */
    public function getBookingStats(Request $request)
    {
        $period = $request->input('period', 'month'); // 'week' or 'month'
        
        if ($period === 'week') {
            // Get last 12 weeks
            $data = [];
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $startOfWeek = now()->subWeeks($i)->startOfWeek();
                $endOfWeek = now()->subWeeks($i)->endOfWeek();
                
                $count = Booking::whereBetween('check_in', [$startOfWeek, $endOfWeek])
                    ->count();
                
                $labels[] = $startOfWeek->format('M d');
                $data[] = $count;
            }
        } else {
            // Get last 12 months
            $data = [];
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $startOfMonth = $month->copy()->startOfMonth();
                $endOfMonth = $month->copy()->endOfMonth();
                
                $count = Booking::whereBetween('check_in', [$startOfMonth, $endOfMonth])
                    ->count();
                
                $labels[] = $month->format('M Y');
                $data[] = $count;
            }
        }
        
        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    /**
     * Get revenue statistics for charts
     */
    public function getRevenueStats(Request $request)
    {
        $period = $request->input('period', 'month'); // 'week' or 'month'
        
        if ($period === 'week') {
            // Get last 12 weeks
            $data = [];
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $startOfWeek = now()->subWeeks($i)->startOfWeek();
                $endOfWeek = now()->subWeeks($i)->endOfWeek();
                
                $revenue = Booking::where('status', 'confirmed')
                    ->whereBetween('check_in', [$startOfWeek, $endOfWeek])
                    ->sum('total_price');
                
                $labels[] = $startOfWeek->format('M d');
                $data[] = (float) $revenue;
            }
        } else {
            // Get last 12 months
            $data = [];
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $startOfMonth = $month->copy()->startOfMonth();
                $endOfMonth = $month->copy()->endOfMonth();
                
                $revenue = Booking::where('status', 'confirmed')
                    ->whereBetween('check_in', [$startOfMonth, $endOfMonth])
                    ->sum('total_price');
                
                $labels[] = $month->format('M Y');
                $data[] = (float) $revenue;
            }
        }
        
        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
