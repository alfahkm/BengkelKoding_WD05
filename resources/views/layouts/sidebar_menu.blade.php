<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    @if (Auth::user()->role == 'dokter')

    <li class="nav-item">
        <a href="/obat" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/periksa" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Pemeriksaan
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/list-obat" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Obat
                <span class="right badge badge-danger">New</span>
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="/profile" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profile
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
    </li>
    @elseif (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/profile" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profile
            </p>
        </a>
    </li>
    @elseif (Auth::user()->role == 'pasien')
    <li class="nav-item">
        <a href="/dokter" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/list-dokter" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Pemeriksaan
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/profile" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profile
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
    </li>
    @endif
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
    </form>