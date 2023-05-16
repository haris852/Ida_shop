<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <x-sidebar-item title="Dashboard" href="{{ route('admin.dashboard') }}" icon="menu-icon mdi mdi-floor-plan"
            active="{{ request()->routeIs('admin.dashboard') }}" />
        <li class="nav-item nav-category">Produk</li>
        <x-sidebar-item title="Daftar Produk" href="{{ route('admin.product.index') }}"
            active="{{ request()->routeIs('admin.product.index') }}" icon="menu-icon mdi mdi-package" />
        <x-sidebar-item title="Tambah" href="{{ route('admin.product.create') }}"
            active="{{ request()->routeIs('admin.product.create') }}" icon="menu-icon mdi mdi-plus-circle-outline" />
        <li class="nav-item nav-category">Pengguna</li>
        <x-sidebar-item title="Daftar Pengguna" href="{{ route('admin.user.index') }}"
            icon="menu-icon mdi mdi-account-multiple-outline"
            active="{{ request()->routeIs('admin.setting.user.list') }}" />
        <x-sidebar-item title="Tambah" href="{{ route('admin.user.create') }}"
            active="{{ request()->routeIs('admin.product.create') }}" icon="menu-icon mdi mdi-plus-circle-outline" />
        <li class="nav-item nav-category">Konfigurasi</li>
        <x-sidebar-item title="Usaha" href="{{route('admin.store-configuration.index')}}"
            icon="menu-icon mdi mdi-store" active="{{ request()->routeIs('admin.store-configuration.index') }}" />
        <li class="nav-item nav-category">Pengaturan</li>
        <x-sidebar-item title="Profil" href="{{ route('admin.setting.index') }}"
            icon="menu-icon mdi mdi-account-circle-outline" active="{{ request()->routeIs('admin.setting.index') }}" />
        <x-sidebar-item title="Keluar" href="{{ route('logout') }}" icon="menu-icon mdi mdi-logout" />
    </ul>
</nav>
