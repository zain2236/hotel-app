<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="Luxury Hotel - Book your perfect stay with us">
      <meta name="author" content="">
      <title>Luxury Hotel - Your Perfect Stay Awaits</title>
      
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
            --light-color: #f9fafb;
         }
         
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
         }
         
         body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
         }
         
         /* Header Styles */
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
         
         .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 0.5rem;
            transition: color 0.3s;
         }
         
         .nav-link:hover {
            color: var(--primary-color) !important;
         }
         
         /* Hero Section */
         .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
         }
         
         .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("images/banner1.jpg") }}') center/cover;
            opacity: 0.3;
            z-index: 0;
         }
         
         .hero-content {
            position: relative;
            z-index: 1;
         }
         
         .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s;
         }
         
         .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1.2s;
         }
         
         @keyframes fadeInUp {
            from {
               opacity: 0;
               transform: translateY(30px);
            }
            to {
               opacity: 1;
               transform: translateY(0);
            }
         }
         
         /* Booking Form */
         .booking-form {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-top: 2rem;
            position: relative;
            z-index: 10;
         }
         
         .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            padding: 0.75rem;
            transition: all 0.3s;
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
            transition: all 0.3s;
         }
         
         .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
         }
         
         /* Rooms Section */
         .rooms-section {
            padding: 80px 0;
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
         
         .section-title p {
            color: #6b7280;
            font-size: 1.1rem;
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
         
         /* Footer */
         .footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 20px;
         }
         
         .footer h5 {
            margin-bottom: 1.5rem;
            font-weight: 600;
         }
         
         .footer a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s;
         }
         
         .footer a:hover {
            color: white;
         }
         
         .footer-bottom {
            border-top: 1px solid #374151;
            margin-top: 3rem;
            padding-top: 2rem;
            text-align: center;
            color: #9ca3af;
         }
         
         /* Empty State */
         .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
         }
         
         .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #d1d5db;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#rooms">Rooms</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#about">About</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#contact">Contact</a>
                  </li>
                  @auth
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                     </li>
                     <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                           @csrf
                           <button type="submit" class="btn btn-outline-danger btn-sm ms-2">
                              <i class="fas fa-sign-out-alt me-1"></i>Logout
                           </button>
                        </form>
                     </li>
                  @else
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                     </li>
                     <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ route('register') }}">Register</a>
                     </li>
                  @endauth
               </ul>
            </div>
         </div>
      </nav>

      <!-- Hero Section -->
      <section class="hero-section">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6 hero-content">
                  <h1 class="hero-title">Experience Luxury Like Never Before</h1>
                  <p class="hero-subtitle">Discover our world-class accommodations and exceptional service. Your perfect stay awaits.</p>
                  <a href="#rooms" class="btn btn-primary btn-lg">
                     <i class="fas fa-calendar-check me-2"></i>Book Now
                  </a>
               </div>
               <div class="col-lg-6">
                  <div class="booking-form">
                     <h4 class="mb-4"><i class="fas fa-search me-2"></i>Find Your Room</h4>
                     <form action="{{ route('rooms.public') }}" method="GET">
                        <div class="row g-3">
                           <div class="col-md-6">
                              <label class="form-label">Check In</label>
                              <input type="date" class="form-control" name="check_in" value="{{ request('check_in') }}" min="{{ date('Y-m-d') }}">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Check Out</label>
                              <input type="date" class="form-control" name="check_out" value="{{ request('check_out') }}" 
                                     min="{{ request('check_in') ? date('Y-m-d', strtotime(request('check_in') . ' +1 day')) : date('Y-m-d', strtotime('+1 day')) }}" 
                                     id="check_out_search">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Guests</label>
                              <select class="form-select" name="guests">
                                 <option value="">Select Guests</option>
                                 <option value="1" {{ request('guests') == 1 ? 'selected' : '' }}>1 Guest</option>
                                 <option value="2" {{ request('guests') == 2 ? 'selected' : '' }}>2 Guests</option>
                                 <option value="3" {{ request('guests') == 3 ? 'selected' : '' }}>3 Guests</option>
                                 <option value="4" {{ request('guests') == 4 || request('guests') >= 4 ? 'selected' : '' }}>4+ Guests</option>
                              </select>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">&nbsp;</label>
                              <button type="submit" class="btn btn-primary w-100">
                                 <i class="fas fa-search me-2"></i>Search Rooms
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- Rooms Section -->
      <section id="rooms" class="rooms-section">
         <div class="container">
            <div class="section-title">
               <h2>Our Luxurious Rooms</h2>
               <p>Choose from our selection of beautifully designed accommodations</p>
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
                           <span><i class="fas fa-users"></i>{{ $room->capacity }} {{ $room->capacity == 1 ? 'Guest' : 'Guests' }}</span>
                           @if($room->amenities)
                              <span><i class="fas fa-wifi"></i>WiFi</span>
                           @endif
                        </div>
                        <div class="room-price">${{ number_format($room->price, 2) }}<small class="text-muted">/night</small></div>
                        <a href="{{ route('room.show', $room->id) }}" target="_blank" class="btn-book">
                           <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                     </div>
                  </div>
               </div>
               @empty
               <div class="col-12">
                  <div class="empty-state">
                     <i class="fas fa-bed"></i>
                     <h3>No Rooms Available</h3>
                     <p>Please check back later or contact us for more information.</p>
                  </div>
               </div>
               @endforelse
            </div>
         </div>
      </section>

      <!-- About Section -->
      <section id="about" class="py-5" style="background: white;">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6 mb-4 mb-lg-0">
                  <h2 class="display-5 fw-bold mb-4">About Luxury Hotel</h2>
                  <p class="lead mb-4">Experience unparalleled luxury and world-class hospitality at our premier destination.</p>
                  <p class="mb-4">Since our establishment, we have been committed to providing exceptional service and creating unforgettable experiences for our guests. Our hotel combines elegant design with modern amenities to ensure your comfort and satisfaction.</p>
                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                           <i class="fas fa-check-circle text-primary me-2 fs-4"></i>
                           <span>24/7 Concierge Service</span>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                           <i class="fas fa-check-circle text-primary me-2 fs-4"></i>
                           <span>World-Class Amenities</span>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                           <i class="fas fa-check-circle text-primary me-2 fs-4"></i>
                           <span>Premium Dining Options</span>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                           <i class="fas fa-check-circle text-primary me-2 fs-4"></i>
                           <span>Spa & Wellness Center</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <img src="{{ asset('images/about.png') }}" alt="About Us" class="img-fluid rounded-3 shadow">
               </div>
            </div>
         </div>
      </section>

      <!-- Contact Section -->
      <section id="contact" class="py-5" style="background: var(--light-color);">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 text-center mb-5">
                  <h2 class="display-5 fw-bold mb-3">Contact Us</h2>
                  <p class="lead">We'd love to hear from you. Get in touch with us!</p>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <div class="card shadow border-0">
                     <div class="card-body p-4">
                        <form>
                           <div class="row">
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">Your Name</label>
                                 <input type="text" class="form-control" placeholder="Enter your name">
                              </div>
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">Your Email</label>
                                 <input type="email" class="form-control" placeholder="Enter your email">
                              </div>
                           </div>
                           <div class="mb-3">
                              <label class="form-label">Subject</label>
                              <input type="text" class="form-control" placeholder="Enter subject">
                           </div>
                           <div class="mb-3">
                              <label class="form-label">Message</label>
                              <textarea class="form-control" rows="5" placeholder="Enter your message"></textarea>
                           </div>
                           <button type="submit" class="btn btn-primary w-100">
                              <i class="fas fa-paper-plane me-2"></i>Send Message
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row mt-5">
               <div class="col-md-4 text-center mb-4">
                  <div class="p-4 bg-white rounded shadow-sm">
                     <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                     <h5>Phone</h5>
                     <p class="mb-0">+1 (555) 123-4567</p>
                  </div>
               </div>
               <div class="col-md-4 text-center mb-4">
                  <div class="p-4 bg-white rounded shadow-sm">
                     <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                     <h5>Email</h5>
                     <p class="mb-0">info@luxuryhotel.com</p>
                  </div>
               </div>
               <div class="col-md-4 text-center mb-4">
                  <div class="p-4 bg-white rounded shadow-sm">
                     <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                     <h5>Address</h5>
                     <p class="mb-0">123 Luxury Street<br>City, Country</p>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- Footer -->
      <footer class="footer">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 mb-4">
                  <h5><i class="fas fa-hotel me-2"></i>Luxury Hotel</h5>
                  <p>Experience world-class hospitality and exceptional service in the heart of luxury.</p>
               </div>
               <div class="col-lg-4 mb-4">
                  <h5>Quick Links</h5>
                  <ul class="list-unstyled">
                     <li><a href="{{ route('homepage') }}">Home</a></li>
                     <li><a href="#rooms">Rooms</a></li>
                     <li><a href="#about">About</a></li>
                     <li><a href="#contact">Contact</a></li>
                  </ul>
               </div>
               <div class="col-lg-4 mb-4">
                  <h5>Contact Us</h5>
                  <p><i class="fas fa-phone me-2"></i>+1 (555) 123-4567</p>
                  <p><i class="fas fa-envelope me-2"></i>info@luxuryhotel.com</p>
                  <p><i class="fas fa-map-marker-alt me-2"></i>123 Luxury Street, City, Country</p>
               </div>
            </div>
            <div class="footer-bottom">
               <p>&copy; {{ date('Y') }} Luxury Hotel. All rights reserved.</p>
            </div>
      </div>
      </footer>

      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
         // Update check-out min date when check-in changes
         document.addEventListener('DOMContentLoaded', function() {
            const checkInInput = document.querySelector('input[name="check_in"]');
            const checkOutInput = document.getElementById('check_out_search');
            
            if (checkInInput && checkOutInput) {
               checkInInput.addEventListener('change', function() {
                  if (this.value) {
                     const nextDay = new Date(this.value);
                     nextDay.setDate(nextDay.getDate() + 1);
                     checkOutInput.min = nextDay.toISOString().split('T')[0];
                     if (checkOutInput.value && checkOutInput.value <= this.value) {
                        checkOutInput.value = nextDay.toISOString().split('T')[0];
                     }
                  }
               });
            }
         });
      </script>
   </body>
</html>
