<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room - Admin</title>
    
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
        
        .card-header {
            background: white;
            border-bottom: 2px solid #f3f4f6;
            padding: 1.5rem;
            border-radius: 15px 15px 0 0;
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
        
        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
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
            <a href="{{ route('admin.bookings.index') }}" class="menu-item">
                <i class="fas fa-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('admin.rooms.create') }}" class="menu-item active">
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
    
    <div class="main-content">
        <div class="topbar">
            <h2 class="mb-0">Add New Room</h2>
        </div>
        
        @include('components.toast')
        @include('components.confirm-modal')
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Room Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Room Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          name="description" rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price per Night ($) *</label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                           name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Capacity (Guests) *</label>
                                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                                           name="capacity" value="{{ old('capacity', 2) }}" min="1" required>
                                    @error('capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Room Type *</label>
                                    <select class="form-select @error('room_type') is-invalid @enderror" name="room_type" required>
                                        <option value="standard" {{ old('room_type') == 'standard' ? 'selected' : '' }}>Standard</option>
                                        <option value="deluxe" {{ old('room_type') == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                                        <option value="suite" {{ old('room_type') == 'suite' ? 'selected' : '' }}>Suite</option>
                                        <option value="presidential" {{ old('room_type') == 'presidential' ? 'selected' : '' }}>Presidential</option>
                                    </select>
                                    @error('room_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Room Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Recommended: 800x600px, max 2MB</small>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Amenities (comma separated)</label>
                                <input type="text" class="form-control" name="amenities" 
                                       value="{{ old('amenities') }}" 
                                       placeholder="WiFi, TV, AC, Mini Bar, Room Service, etc.">
                                <small class="text-muted">Separate multiple amenities with commas</small>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="available" 
                                           name="available" value="1" {{ old('available', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="available">
                                        Available for booking
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Room
                        </button>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @include('components.toast')
    @include('components.confirm-modal')
    
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
