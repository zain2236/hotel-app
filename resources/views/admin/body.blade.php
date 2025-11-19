<div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-home"></i></div><strong>Total Rooms</strong>
                    </div>
                    <div class="number dashtext-1">{{ $stats['total_rooms'] }}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: {{ $stats['total_rooms'] > 0 ? ($stats['available_rooms'] / $stats['total_rooms'] * 100) : 0 }}%" aria-valuenow="{{ $stats['available_rooms'] }}" aria-valuemin="0" aria-valuemax="{{ $stats['total_rooms'] }}" class="progress-bar progress-bar-template dashbg-1"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-check"></i></div><strong>Available Rooms</strong>
                    </div>
                    <div class="number dashtext-2">{{ $stats['available_rooms'] }}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: {{ $stats['total_rooms'] > 0 ? ($stats['available_rooms'] / $stats['total_rooms'] * 100) : 0 }}%" aria-valuenow="{{ $stats['available_rooms'] }}" aria-valuemin="0" aria-valuemax="{{ $stats['total_rooms'] }}" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-padnote"></i></div><strong>Total Bookings</strong>
                    </div>
                    <div class="number dashtext-3">{{ $stats['total_bookings'] }}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: {{ $stats['total_bookings'] > 0 ? ($stats['confirmed_bookings'] / $stats['total_bookings'] * 100) : 0 }}%" aria-valuenow="{{ $stats['confirmed_bookings'] }}" aria-valuemin="0" aria-valuemax="{{ $stats['total_bookings'] }}" class="progress-bar progress-bar-template dashbg-3"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-dollar"></i></div><strong>Total Revenue</strong>
                    </div>
                    <div class="number dashtext-4">${{ number_format($stats['total_revenue'], 2) }}</div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Recent Bookings</strong></div>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Room</th>
                          <th>Guest</th>
                          <th>Check In</th>
                          <th>Check Out</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($recentBookings as $booking)
                        <tr>
                          <td>{{ $booking->id }}</td>
                          <td>{{ $booking->room->title }}</td>
                          <td>{{ $booking->guest_name }}</td>
                          <td>{{ $booking->check_in->format('M d, Y') }}</td>
                          <td>{{ $booking->check_out->format('M d, Y') }}</td>
                          <td>${{ number_format($booking->total_price, 2) }}</td>
                          <td>
                            <span class="badge badge-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                              {{ ucfirst($booking->status) }}
                            </span>
                          </td>
                          <td>
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">View</a>
                          </td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="8" class="text-center">No bookings yet</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
