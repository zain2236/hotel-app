<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Luxury Hotel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-color);
        }
        
        .navbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('homepage') }}">
                <i class="fas fa-hotel me-2"></i>Luxury Hotel
            </a>
            <div class="ms-auto">
                <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-primary me-2">Back to Bookings</a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mb-4">Booking Details</h1>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Booking Information</h4>
                        
                        <div class="info-item">
                            <strong>Booking ID:</strong> #{{ $booking->id }}
                        </div>
                        <div class="info-item">
                            <strong>Room:</strong> {{ $booking->room->title }} ({{ ucfirst($booking->room->room_type) }})
                        </div>
                        <div class="info-item">
                            <strong>Check In:</strong> {{ $booking->check_in->format('F d, Y') }}
                        </div>
                        <div class="info-item">
                            <strong>Check Out:</strong> {{ $booking->check_out->format('F d, Y') }}
                        </div>
                        <div class="info-item">
                            <strong>Number of Guests:</strong> {{ $booking->guests }}
                        </div>
                        <div class="info-item">
                            <strong>Total Price:</strong> 
                            <span class="text-primary fs-4 fw-bold">${{ number_format($booking->total_price, 2) }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Status:</strong> 
                            <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        @if($booking->special_requests)
                        <div class="info-item">
                            <strong>Special Requests:</strong> {{ $booking->special_requests }}
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($booking->status != 'cancelled' && $booking->status != 'completed')
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="mb-3">Update Booking</h5>
                        <form action="{{ route('user.bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check In Date *</label>
                                    <input type="date" class="form-control" name="check_in" 
                                           value="{{ old('check_in', $booking->check_in->format('Y-m-d')) }}" 
                                           min="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check Out Date *</label>
                                    <input type="date" class="form-control" name="check_out" 
                                           value="{{ old('check_out', $booking->check_out->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Number of Guests *</label>
                                <input type="number" class="form-control" name="guests" 
                                       value="{{ old('guests', $booking->guests) }}" 
                                       min="1" max="{{ $booking->room->capacity }}" required>
                                <small class="text-muted">Maximum: {{ $booking->room->capacity }} guests</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Booking
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Actions</h5>
                        @if($booking->status != 'cancelled' && $booking->status != 'completed')
                        <form action="{{ route('user.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel/delete this booking? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 mb-2">
                                <i class="fas fa-trash me-2"></i>Cancel/Delete Booking
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary w-100">
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

