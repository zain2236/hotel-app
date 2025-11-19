<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Booking Success - Luxury Hotel</title>
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      
      <style>
         :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #10b981;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 100px 20px 20px;
         }
         
         .success-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 120px);
         }
         
         .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
         }
         
         .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color) !important;
         }
         
         .success-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
            text-align: center;
            animation: slideUp 0.6s ease-out;
         }
         
         @keyframes slideUp {
            from {
               opacity: 0;
               transform: translateY(30px);
            }
            to {
               opacity: 1;
               transform: translateY(0);
            }
         }
         
         .success-icon-wrapper {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--success-color), #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: scaleIn 0.5s ease-out 0.2s both;
         }
         
         @keyframes scaleIn {
            from {
               transform: scale(0);
            }
            to {
               transform: scale(1);
            }
         }
         
         .success-icon {
            font-size: 60px;
            color: white;
         }
         
         .success-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
         }
         
         .success-message {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.6;
         }
         
         .info-box {
            background: var(--light-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
         }
         
         .info-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
         }
         
         .info-item:last-child {
            border-bottom: none;
         }
         
         .info-label {
            color: #6b7280;
            font-weight: 500;
         }
         
         .info-value {
            color: var(--dark-color);
            font-weight: 600;
         }
         
         .btn {
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s;
         }
         
         .btn-primary {
            background: var(--primary-color);
            border: none;
         }
         
         .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
         }
         
         .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
         }
         
         .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light">
         <div class="container">
            <a class="navbar-brand" href="{{ route('homepage') }}">
               <i class="fas fa-hotel me-2"></i>Luxury Hotel
            </a>
            <div class="ms-auto">
               @auth
                  <a href="{{ route('home') }}" class="btn btn-outline-primary me-2">Dashboard</a>
               @else
                  <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
               @endauth
            </div>
         </div>
      </nav>
      
      <div class="success-wrapper">
         <div class="container">
            <div class="success-card">
               <div class="success-icon-wrapper">
                  <i class="fas fa-check success-icon"></i>
               </div>
               
               <h1 class="success-title">Booking Confirmed!</h1>
               <p class="success-message">
                  Thank you for your booking! We have successfully received your reservation request.
                  <br><br>
                  Our team will review your booking and send you a confirmation email shortly. You can also view your booking in your dashboard.
               </p>
               
               @if(session('booking') && session('booking')->room)
               <div class="info-box">
                  <div class="info-item">
                     <span class="info-label">Booking ID:</span>
                     <span class="info-value">#{{ session('booking')->id }}</span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">Room:</span>
                     <span class="info-value">{{ session('booking')->room->title }}</span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">Check In:</span>
                     <span class="info-value">{{ \Carbon\Carbon::parse(session('booking')->check_in)->format('M d, Y') }}</span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">Check Out:</span>
                     <span class="info-value">{{ \Carbon\Carbon::parse(session('booking')->check_out)->format('M d, Y') }}</span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">Total Amount:</span>
                     <span class="info-value text-success">${{ number_format(session('booking')->total_price, 2) }}</span>
                  </div>
               </div>
               @endif
               
               <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                  @auth
                     <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                     </a>
                     <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-calendar-check me-2"></i>View My Bookings
                     </a>
                  @else
                     <a href="{{ route('homepage') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Back to Home
                     </a>
                     <a href="{{ route('login') }}" class="btn btn-outline-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to View Bookings
                     </a>
                  @endauth
               </div>
               
               <div class="mt-4">
                  <a href="{{ route('rooms.public') }}" class="text-decoration-none text-muted">
                     <i class="fas fa-bed me-2"></i>Browse More Rooms
                  </a>
               </div>
            </div>
         </div>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
