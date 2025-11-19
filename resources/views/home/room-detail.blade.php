<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ $room->title }} - Luxury Hotel</title>
      
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
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
         }
         
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
         }
         
         body {
            font-family: 'Poppins', sans-serif;
            color: #333;
         }
         
         .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
         }
         
         .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color) !important;
         }
         
         .room-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0 50px;
            margin-top: 76px;
         }
         
         .room-image-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
         }
         
         .room-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
         }
         
         .room-info-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
         }
         
         .booking-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            position: sticky;
            top: 100px;
         }
         
         .price-display {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 1rem 0;
         }
         
         .amenity-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
         }
         
         .amenity-item:last-child {
            border-bottom: none;
         }
         
         .amenity-item i {
            color: var(--accent-color);
            margin-right: 0.75rem;
            width: 20px;
         }
         
         .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            padding: 0.75rem;
         }
         
         .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
         }
         
         .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
         }
         
         .btn-primary:hover {
            background: var(--secondary-color);
         }
         
         .total-price {
            background: #f3f4f6;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
         }
         
         .alert {
            border-radius: 8px;
         }
      </style>
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-light fixed-top">
         <div class="container">
            <a class="navbar-brand" href="{{ route('homepage') }}">
               <i class="fas fa-hotel me-2"></i>Luxury Hotel
            </a>
            <div class="ms-auto d-flex align-items-center gap-2">
               @auth
                  <a href="{{ route('home') }}" class="btn btn-outline-primary">Dashboard</a>
               @else
                  <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                  <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
               @endauth
            </div>
         </div>
      </nav>

      <!-- Room Header -->
      <div class="room-header">
         <div class="container">
            <h1 class="display-4 mb-3">{{ $room->title }}</h1>
            <p class="lead">{{ ucfirst($room->room_type) }} Room • Up to {{ $room->capacity }} Guests</p>
         </div>
      </div>

      <div class="container my-5">
         <div class="row">
            <!-- Room Details -->
            <div class="col-lg-8">
               <div class="room-image-container">
                  <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('images/room1.jpg') }}" 
                       alt="{{ $room->title }}" class="room-image">
               </div>
               
               <div class="room-info-card">
                  <h3 class="mb-4">Room Description</h3>
                  <p class="lead">{{ $room->description }}</p>
               </div>
               
               @if($room->amenities)
               <div class="room-info-card">
                  <h3 class="mb-4">Amenities</h3>
                  @foreach(explode(',', $room->amenities) as $amenity)
                  <div class="amenity-item">
                     <i class="fas fa-check-circle"></i>
                     <span>{{ trim($amenity) }}</span>
                  </div>
                  @endforeach
               </div>
               @endif
               
               <div class="room-info-card">
                  <h3 class="mb-4">Room Details</h3>
                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <strong><i class="fas fa-users me-2 text-primary"></i>Capacity:</strong>
                        <span class="ms-2">{{ $room->capacity }} Guests</span>
                     </div>
                     <div class="col-md-6 mb-3">
                        <strong><i class="fas fa-bed me-2 text-primary"></i>Room Type:</strong>
                        <span class="ms-2">{{ ucfirst($room->room_type) }}</span>
                     </div>
                     <div class="col-md-6 mb-3">
                        <strong><i class="fas fa-check-circle me-2 text-success"></i>Status:</strong>
                        <span class="ms-2">{{ $room->available ? 'Available' : 'Unavailable' }}</span>
                     </div>
                  </div>
               </div>
            </div>
            
            <!-- Booking Form -->
            <div class="col-lg-4">
               <div class="booking-card">
                  <h3 class="mb-4">Book This Room</h3>
                  
                  @if($errors->any())
                     <div class="alert alert-danger">
                        <ul class="mb-0">
                           @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                  @endif
                  
                  @if(!$room->available)
                     <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>This room is currently unavailable.
                     </div>
                  @endif
                  
                  <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                     @csrf
                     <input type="hidden" name="room_id" value="{{ $room->id }}">
                     
                     <div class="mb-3">
                        <label class="form-label">Check In Date *</label>
                        <input type="date" class="form-control" id="check_in" name="check_in" 
                               value="{{ old('check_in') }}" min="{{ date('Y-m-d') }}" required>
                     </div>
                     
                     <div class="mb-3">
                        <label class="form-label">Check Out Date *</label>
                        <input type="date" class="form-control" id="check_out" name="check_out" 
                               value="{{ old('check_out') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                     </div>
                     
                     <div class="mb-3">
                        <label class="form-label">Number of Guests *</label>
                        <input type="number" class="form-control" id="guests" name="guests" 
                               value="{{ old('guests', 1) }}" min="1" max="{{ $room->capacity }}" required>
                        <small class="text-muted">Maximum: {{ $room->capacity }} guests</small>
                     </div>
                     
                     <div class="mb-3">
                        <label class="form-label">Your Name *</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name" 
                               value="{{ old('guest_name', Auth::user()->name ?? '') }}" required>
                     </div>
                     
                     <div class="mb-3">
                        <label class="form-label">Your Email *</label>
                        <input type="email" class="form-control" id="guest_email" name="guest_email" 
                               value="{{ old('guest_email', Auth::user()->email ?? '') }}" required>
                     </div>
                     
                     <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="guest_phone" name="guest_phone" 
                               value="{{ old('guest_phone', Auth::user()->phone ?? '') }}">
                     </div>
                     
                     <div class="mb-3">
                        <label class="form-label">Special Requests</label>
                        <textarea class="form-control" id="special_requests" name="special_requests" rows="3">{{ old('special_requests') }}</textarea>
                     </div>
                     
                     <div class="total-price">
                        <div class="d-flex justify-content-between mb-2">
                           <span>Price per night:</span>
                           <strong>${{ number_format($room->price, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                           <span>Total:</span>
                           <strong class="price-display" id="totalPrice">$0.00</strong>
                        </div>
                        <small class="text-muted" id="nightsInfo">0 nights</small>
                     </div>
                     
                     @guest
                     <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <a href="{{ route('login') }}" class="alert-link">Please login</a> to make a booking.
                     </div>
                     @endguest
                     
                     <button type="submit" class="btn btn-primary" {{ Auth::guest() || !$room->available ? 'disabled' : '' }}>
                        <i class="fas fa-calendar-check me-2"></i>Book Now
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>

      @include('components.toast')

      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
         const pricePerNight = {{ $room->price }};
         const checkIn = document.getElementById('check_in');
         const checkOut = document.getElementById('check_out');
         const totalPrice = document.getElementById('totalPrice');
         const nightsInfo = document.getElementById('nightsInfo');
         
         function calculateTotal() {
            if (checkIn.value && checkOut.value) {
               const checkInDate = new Date(checkIn.value);
               const checkOutDate = new Date(checkOut.value);
               const diffTime = checkOutDate - checkInDate;
               const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
               
               if (diffDays > 0) {
                  const total = pricePerNight * diffDays;
                  totalPrice.textContent = '$' + total.toFixed(2);
                  nightsInfo.textContent = diffDays + ' night' + (diffDays > 1 ? 's' : '');
               } else {
                  totalPrice.textContent = '$0.00';
                  nightsInfo.textContent = '0 nights';
               }
            }
         }
         
         checkIn.addEventListener('change', function() {
            if (checkIn.value) {
               const nextDay = new Date(checkIn.value);
               nextDay.setDate(nextDay.getDate() + 1);
               const minDate = nextDay.toISOString().split('T')[0];
               checkOut.min = minDate;
               checkOut.value = checkOut.value || minDate;
               if (checkOut.value && checkOut.value <= checkIn.value) {
                  checkOut.value = minDate;
               }
            }
            calculateTotal();
         });
         
         checkOut.addEventListener('change', calculateTotal);
         
         // Initial calculation if dates are pre-filled
         calculateTotal();
         
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
