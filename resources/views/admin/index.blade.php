<!DOCTYPE html>
<html lang="en">
  <head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Luxury Hotel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-color);
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 2rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            padding: 0.75rem 1.5rem;
            color: var(--dark-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background: #f3f4f6;
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .menu-item i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 2rem;
        }
        
        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .stat-icon.blue { background: var(--primary-color); }
        .stat-icon.green { background: var(--success-color); }
        .stat-icon.orange { background: var(--warning-color); }
        .stat-icon.red { background: var(--danger-color); }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background: white;
            border-bottom: 2px solid #f3f4f6;
            padding: 1.5rem;
            border-radius: 15px 15px 0 0;
            font-weight: 600;
        }
        
        .table {
            margin: 0;
        }
        
        .table thead {
            background: #f9fafb;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
        }
        
        .btn-primary:hover {
            background: var(--secondary-color);
        }
    </style>
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-hotel me-2"></i>Admin Panel</h4>
            <small class="text-white-50">{{ Auth::user()->name }}</small>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('home') }}" class="menu-item active">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.rooms.index') }}" class="menu-item">
                <i class="fas fa-bed"></i> Rooms
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="menu-item">
                <i class="fas fa-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('admin.rooms.create') }}" class="menu-item">
                <i class="fas fa-plus-circle"></i> Add Room
            </a>
            <a href="{{ url('/') }}" target="_blank" class="menu-item">
                <i class="fas fa-external-link-alt"></i> View Website
            </a>
            <hr>
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="menu-item w-100 text-start border-0 bg-transparent">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <h2 class="mb-0">Dashboard</h2>
            <div>
                <span class="text-muted">Welcome back, {{ Auth::user()->name }}</span>
            </div>
        </div>
        
        @include('components.toast')
        @include('components.confirm-modal')
        
        <!-- Statistics -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="stat-value">{{ $stats['total_rooms'] }}</div>
                    <div class="stat-label">Total Rooms</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value">{{ $stats['available_rooms'] }}</div>
                    <div class="stat-label">Available Rooms</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-value">{{ $stats['total_bookings'] }}</div>
                    <div class="stat-label">Total Bookings</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-value">${{ number_format($stats['total_revenue'], 0) }}</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>
        </div>
        
        <!-- Recent Bookings -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Recent Bookings</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room</th>
                                <th>Guest</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->room ? $booking->room->title : 'N/A' }}</td>
                                <td>{{ $booking->guest_name ?? ($booking->user ? $booking->user->name : 'Guest') }}</td>
                                <td>{{ $booking->check_in ? $booking->check_in->format('M d, Y') : 'N/A' }}</td>
                                <td>{{ $booking->check_out ? $booking->check_out->format('M d, Y') : 'N/A' }}</td>
                                <td><strong>${{ number_format($booking->total_price ?? 0, 2) }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($booking->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($booking->status == 'pending')
                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="d-inline" data-confirm="Are you sure you want to approve this booking?" data-title="Approve Booking">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="confirmed">
                                            <input type="hidden" name="check_in" value="{{ $booking->check_in ? $booking->check_in->format('Y-m-d') : '' }}">
                                            <input type="hidden" name="check_out" value="{{ $booking->check_out ? $booking->check_out->format('Y-m-d') : '' }}">
                                            <input type="hidden" name="guests" value="{{ $booking->guests ?? 1 }}">
                                            <button type="submit" class="btn btn-sm btn-success" title="Approve Booking">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    No bookings yet
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize toasts
        document.addEventListener('DOMContentLoaded', function() {
            const toastElements = document.querySelectorAll('.toast');
            toastElements.forEach(function(toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        });
    </script>
</body>
</html>
