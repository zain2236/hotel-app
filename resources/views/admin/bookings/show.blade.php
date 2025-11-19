<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
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
        
        .info-item {
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        
        .info-value {
            font-size: 1.1rem;
            color: var(--dark-color);
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
            <h2 class="mb-0">Booking Details</h2>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Booking Information</h4>
                        
                        <div class="info-item">
                            <div class="info-label">Booking ID</div>
                            <div class="info-value">#{{ $booking->id }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Room</div>
                            <div class="info-value">{{ $booking->room->title }} ({{ ucfirst($booking->room->room_type) }})</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Guest Name</div>
                            <div class="info-value">{{ $booking->guest_name }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Guest Email</div>
                            <div class="info-value">{{ $booking->guest_email }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Guest Phone</div>
                            <div class="info-value">{{ $booking->guest_phone ?? 'N/A' }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Check In Date</div>
                            <div class="info-value">{{ $booking->check_in->format('F d, Y') }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Check Out Date</div>
                            <div class="info-value">{{ $booking->check_out->format('F d, Y') }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Number of Guests</div>
                            <div class="info-value">{{ $booking->guests }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Total Price</div>
                            <div class="info-value">
                                <strong style="font-size: 1.5rem; color: var(--primary-color);">
                                    ${{ number_format($booking->total_price, 2) }}
                                </strong>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : ($booking->status == 'cancelled' ? 'danger' : 'info')) }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>
                        
                        @if($booking->special_requests)
                        <div class="info-item">
                            <div class="info-label">Special Requests</div>
                            <div class="info-value">{{ $booking->special_requests }}</div>
                        </div>
                        @endif
                        
                        <div class="info-item">
                            <div class="info-label">Booked On</div>
                            <div class="info-value">{{ $booking->created_at->format('F d, Y h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Actions</h5>
                        @if($booking->status == 'pending')
                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="mb-2">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="confirmed">
                            <input type="hidden" name="check_in" value="{{ $booking->check_in->format('Y-m-d') }}">
                            <input type="hidden" name="check_out" value="{{ $booking->check_out->format('Y-m-d') }}">
                            <input type="hidden" name="guests" value="{{ $booking->guests }}">
                            <button type="submit" class="btn btn-success w-100 mb-2" onclick="return confirm('Approve this booking?');">
                                <i class="fas fa-check-circle me-2"></i>Approve Booking
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-edit me-2"></i>Edit Booking
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
