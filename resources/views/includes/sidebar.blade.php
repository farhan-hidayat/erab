<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">E-RAB</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">ER</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i
                    class="fas fa-gauge-high fa-beat"></i>
                <span>Dashboard</span></a></li>
        <li class="menu-header">Master Data</li>
        <li class="nav-item dropdown {{ request()->is('activities*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                    class="fas fa-list-check fa-beat"></i>
                <span>Data Kegiatan</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->is('activities*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('activities.index') }}">Kegiatan</a></li>
                <li><a class="nav-link" href="#">Klasifikasi</a></li>
                <li><a class="nav-link" href="#">Rincian</a></li>
                <li><a class="nav-link" href="#">Komponen</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                    class="fas fa-magnifying-glass-dollar fa-beat"></i>
                <span>Data Sumber Dana</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="#">Sumber</a></li>
                <li><a class="nav-link" href="#">Kelompok Akun</a></li>
                <li><a class="nav-link" href="#">Akun</a></li>
            </ul>
        </li>
        <li class="{{ request()->is('faculties*') ? 'active' : '' }}">
            <a href="{{ route('faculties.index') }}" class="nav-link"><i class="fas fa-building-columns fa-beat"></i>
                <span>Data Fakultas</span></a>
        </li>
        <li class="{{ request()->is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="nav-link"><i class="fas fa-users-gear fa-beat"></i>
                <span>Data Pengguna</span></a>
        </li>
        <li class="menu-header">Aplikasi</li>
        <li class="">
            <a href="#" class="nav-link"><i class="fas fa-scale-balanced fa-beat"></i>
                <span>RAB</span></a>
        </li>
    </ul>

    <div class="p-3 mt-4 mb-4 hide-sidebar-mini">
        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split" target="_blank">
            <i class="fas fa-rocket"></i> Documentation
        </a>
    </div>
</aside>
