<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings Management - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        
        .card-header {
            background: white;
            border-bottom: 2px solid #f3f4f6;
            padding: 1.5rem;
            border-radius: 15px 15px 0 0;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-hotel me-2"></i>Admin Panel</h4>
            <small class="text-white-50">{{ Auth::user()->name }}</small>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('home') }}" class="menu-item">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.rooms.index') }}" class="menu-item">
                <i class="fas fa-bed"></i> Rooms
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="menu-item active">
                <i class="fas fa-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('admin.rooms.create') }}" class="menu-item">
                <i class="fas fa-plus-circle"></i> Add Room
            </a>
            <a href="{{ route('homepage') }}" target="_blank" class="menu-item">
                <i class="fas fa-external-link-alt"></i> View Website
            </a>
            <hr>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item w-100 text-start border-0 bg-transparent">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
    
    <div class="main-content">
        <div class="topbar">
            <h2 class="mb-0">Bookings Management</h2>
        </div>
        
        @include('components.toast')
        @include('components.confirm-modal')
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Bookings</h5>
                <div>
                    <span class="badge bg-warning me-2">{{ \App\Models\Booking::where('status', 'pending')->count() }} Pending</span>
                    <span class="badge bg-success">{{ \App\Models\Booking::where('status', 'confirmed')->count() }} Confirmed</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room</th>
                                <th>Guest</th>
                                <th>Email</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Guests</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td><strong>{{ $booking->room->title }}</strong></td>
                                <td>{{ $booking->guest_name }}</td>
                                <td>{{ $booking->guest_email }}</td>
                                <td>{{ $booking->check_in->format('M d, Y') }}</td>
                                <td>{{ $booking->check_out->format('M d, Y') }}</td>
                                <td>{{ $booking->guests }}</td>
                                <td><strong>${{ number_format($booking->total_price, 2) }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : ($booking->status == 'cancelled' ? 'danger' : 'info')) }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning" title="Edit Booking">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($booking->status == 'pending')
                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="d-inline" data-confirm="Are you sure you want to approve this booking?" data-title="Approve Booking">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="confirmed">
                                            <input type="hidden" name="check_in" value="{{ $booking->check_in->format('Y-m-d') }}">
                                            <input type="hidden" name="check_out" value="{{ $booking->check_out->format('Y-m-d') }}">
                                            <input type="hidden" name="guests" value="{{ $booking->guests }}">
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
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="fas fa-calendar-times fa-2x mb-2"></i><br>
                                    No bookings found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
    
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
