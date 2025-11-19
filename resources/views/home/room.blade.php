<div class="our_room" style="padding: 80px 0; background: var(--light-color);">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-center mb-5">
                     <h2 class="display-5 fw-bold mb-3">Our Luxurious Rooms</h2>
                     <p class="lead text-muted">Discover our comfortable and luxurious accommodations</p>
                  </div>
               </div>
            </div>
            <div class="row">
               @forelse($rooms as $room)
               <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s;">
                     <div style="height: 250px; overflow: hidden;">
                        @if($room->image)
                           <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->title }}" class="w-100 h-100" style="object-fit: cover;"/>
                        @else
                           <img src="{{ asset('images/room1.jpg') }}" alt="{{ $room->title }}" class="w-100 h-100" style="object-fit: cover;"/>
                        @endif
                     </div>
                     <div class="card-body">
                        <h3 class="card-title fw-bold mb-2">{{ $room->title }}</h3>
                        <p class="text-primary mb-2">
                           <i class="fas fa-star me-1"></i>{{ ucfirst($room->room_type) }}
                        </p>
                        <p class="text-muted mb-3" style="min-height: 48px;">{{ Str::limit($room->description, 100) }}</p>
                        <div class="mb-3">
                           <p class="mb-1"><i class="fas fa-users text-warning me-2"></i><strong>Capacity:</strong> {{ $room->capacity }} {{ $room->capacity == 1 ? 'guest' : 'guests' }}</p>
                           <p class="mb-0"><i class="fas fa-dollar-sign text-success me-2"></i><strong>Price:</strong> ${{ number_format($room->price, 2) }} <small>/night</small></p>
                        </div>
                        <a href="{{ route('room.show', $room->id) }}" target="_blank" class="btn btn-primary w-100" style="border-radius: 8px;">
                           <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                     </div>
                  </div>
               </div>
               @empty
               <div class="col-12">
                  <div class="text-center py-5">
                     <i class="fas fa-bed fa-3x text-muted mb-3"></i>
                     <h3 class="text-muted">No Rooms Available</h3>
                     <p class="text-muted">Please check back later or contact us for more information.</p>
                  </div>
               </div>
               @endforelse
            </div>
         </div>
      </div>
