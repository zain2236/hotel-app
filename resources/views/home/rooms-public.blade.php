<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Our Rooms - Luxury Hotel</title>
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      
      <style>
         :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
         }
         
         body {
            font-family: 'Poppins', sans-serif;
            color: #333;
         }
         
         .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
         }
         
         .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color) !important;
         }
         
         .rooms-section {
            padding: 100px 0 80px;
            background: var(--light-color);
         }
         
         .section-title {
            text-align: center;
            margin-bottom: 3rem;
         }
         
         .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
         }
         
         .room-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
            margin-bottom: 2rem;
            height: 100%;
         }
         
         .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
         }
         
         .room-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
         }
         
         .room-body {
            padding: 1.5rem;
         }
         
         .room-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
         }
         
         .room-type {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 1rem;
         }
         
         .room-description {
            color: #6b7280;
            margin-bottom: 1rem;
            font-size: 0.95rem;
         }
         
         .room-features {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #6b7280;
         }
         
         .room-features i {
            color: var(--accent-color);
            margin-right: 0.5rem;
         }
         
         .room-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
         }
         
         .btn-book {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: block;
            text-align: center;
            transition: all 0.3s;
         }
         
         .btn-book:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            color: white;
         }
         
         .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light fixed-top">
         <div class="container">
            <a class="navbar-brand" href="{{ route('homepage') }}">
               <i class="fas fa-hotel me-2"></i>Luxury Hotel
            </a>
            <div class="ms-auto">
               @auth
                  <a href="{{ route('home') }}" class="btn btn-outline-primary me-2">Dashboard</a>
               @else
                  <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                  <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
               @endauth
            </div>
         </div>
      </nav>

      <section class="rooms-section">
         <div class="container">
            <div class="section-title">
               <h2>Available Rooms</h2>
               <p>Choose from our selection of beautifully designed accommodations</p>
               @if(request('guests') || request('check_in'))
               <div class="alert alert-info mt-3" style="max-width: 600px; margin: 1rem auto 0;">
                  <i class="fas fa-info-circle me-2"></i>
                  @if(request('guests'))
                     <strong>Filter:</strong> 
                     @if(request('guests') >= 4)
                        Showing rooms for 4+ guests
                     @else
                        Showing rooms for exactly {{ request('guests') }} {{ request('guests') == 1 ? 'guest' : 'guests' }}
                     @endif
                  @endif
                  @if(request('check_in') && request('check_out'))
                     <br><strong>Dates:</strong> {{ \Carbon\Carbon::parse(request('check_in'))->format('M d') }} - {{ \Carbon\Carbon::parse(request('check_out'))->format('M d, Y') }}
                  @endif
               </div>
               @endif
            </div>
            
            <div class="row">
               @forelse($rooms as $room)
               <div class="col-lg-4 col-md-6">
                  <div class="room-card">
                     <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('images/room1.jpg') }}" 
                          alt="{{ $room->title }}" class="room-image">
                     <div class="room-body">
                        <h3 class="room-title">{{ $room->title }}</h3>
                        <div class="room-type">
                           <i class="fas fa-star me-1"></i>{{ ucfirst($room->room_type) }}
                        </div>
                        <p class="room-description">{{ Str::limit($room->description, 100) }}</p>
                        <div class="room-features">
                           <span><i class="fas fa-users"></i>{{ $room->capacity }} Guests</span>
                           @if($room->amenities)
                              <span><i class="fas fa-wifi"></i>WiFi</span>
                           @endif
                        </div>
                        <div class="room-price">${{ number_format($room->price, 2) }}<small>/night</small></div>
                        <a href="{{ route('room.show', $room->id) }}" target="_blank" class="btn-book">
                           <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                     </div>
                  </div>
               </div>
               @empty
               <div class="col-12">
                  <div class="empty-state">
                     <i class="fas fa-bed fa-3x mb-3"></i>
                     <h3>No Rooms Available</h3>
                     <p>Please check back later or contact us for more information.</p>
                     <a href="{{ route('homepage') }}" class="btn btn-primary mt-3">Back to Home</a>
                  </div>
               </div>
               @endforelse
            </div>
         </div>
      </section>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
