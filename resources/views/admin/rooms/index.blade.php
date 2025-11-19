<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rooms Management - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #10b981;
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
        
        .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--dark-color);
            text-decoration: none;
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
        
        .room-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
        }
        
        .room-image-placeholder {
            width: 80px;
            height: 60px;
            background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
            color: #9ca3af;
            font-size: 1.5rem;
        }
        
        .room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .room-image-container {
            width: 80px;
            height: 60px;
            flex-shrink: 0;
        }
        
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
        }
        
        .d-flex.gap-2 {
            gap: 0.5rem;
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
            <a href="{{ route('admin.rooms.index') }}" class="menu-item active">
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
    
    <div class="main-content">
        <div class="topbar">
            <h2 class="mb-0">Rooms Management</h2>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Room
            </a>
        </div>
        
        @include('components.toast')
        @include('components.confirm-modal')
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Rooms</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rooms as $room)
                            <tr>
                                <td>
                                    <div class="room-image-container">
                                        @if($room->image && file_exists(storage_path('app/public/' . $room->image)))
                                            <div class="room-image">
                                                <img src="{{ asset('storage/' . $room->image) }}" 
                                                     alt="{{ $room->title }}"
                                                     onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'room-image-placeholder\'><i class=\'fas fa-image\'></i></div>';">
                                            </div>
                                        @else
                                            <div class="room-image-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td><strong>{{ $room->title }}</strong></td>
                                <td>{{ ucfirst($room->room_type) }}</td>
                                <td><strong>${{ number_format($room->price, 2) }}</strong></td>
                                <td>{{ $room->capacity }} guests</td>
                                <td>
                                    <span class="badge bg-{{ $room->available ? 'success' : 'danger' }}">
                                        {{ $room->available ? 'Available' : 'Unavailable' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-warning" title="Edit Room">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline" data-confirm="Are you sure you want to delete this room? This action cannot be undone." data-title="Delete Room">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Room">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-bed fa-2x mb-2"></i><br>
                                    No rooms found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $rooms->links() }}
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
