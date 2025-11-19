<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{ asset('admin/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{ Auth::user()->name }}</h1>
            <p>Administrator</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}"> <i class="icon-home"></i>Dashboard </a></li>
                <li class="{{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}"><a href="{{ route('admin.rooms.index') }}"> <i class="icon-grid"></i>Rooms </a></li>
                <li class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"><a href="{{ route('admin.bookings.index') }}"> <i class="icon-padnote"></i>Bookings </a></li>
        </ul><span class="heading">Actions</span>
        <ul class="list-unstyled">
          <li><a href="{{ route('admin.rooms.create') }}"> <i class="icon-plus"></i>Add Room </a></li>
          <li><a href="{{ route('homepage') }}" target="_blank"> <i class="icon-screen"></i>View Website </a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" style="background: none; border: none; color: inherit; width: 100%; text-align: left; padding: 0;">
                <i class="icon-logout"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </nav>
