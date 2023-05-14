<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <x-sidebar-item title="Dashboard" href="{{ route('admin.dashboard') }}" icon="menu-icon mdi mdi-floor-plan"
            active="{{ request()->routeIs('admin.dashboard') }}" />
        <li class="nav-item nav-category">Pengaturan</li>
        <x-sidebar-item title="Profil" href="{{ route('admin.setting.index') }}"
            icon="menu-icon mdi mdi-account-circle-outline" active="{{ request()->routeIs('admin.setting.index') }}" />
        <x-sidebar-item title="Daftar Pengguna" href="{{ route('admin.setting.user.list') }}"
            icon="menu-icon mdi mdi-account-multiple-outline"
            active="{{ request()->routeIs('admin.setting.user.list') }}" />
            <x-sidebar-item title="Keluar" href="{{ route('logout') }}" icon="menu-icon mdi mdi-logout" />
    </ul>
</nav>
