<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}"><a class="nav-link" href="{{route('.')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Transaksi</li>

            <li class="{{ (request()->is('transactions') || request()->is('transactions/index')) ? 'active' : '' }}"><a class="nav-link" href="{{route('transactions.index')}}"><i class="fas fa-retweet"></i> <span>Rekap</span></a></li>

            <li class="{{ (request()->is('transactions') || request()->is('transactions/selling')) ? 'active' : '' }}"><a class="nav-link" href="{{route('transactions.selling')}}"><i class="fas fa-retweet"></i> <span>Pelaporan</span></a></li>

            <li class="menu-header">Product</li>

            <li class="{{ (request()->is('dashboard/product') || request()->is('dashboard/product/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('dashboard.product')}}"><i class="fas fa-chart-bar"></i> <span>Statistik</span></a></li>

            <li class="{{ (request()->is('products') || request()->is('products/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('products.index')}}"><i class="fas fa-sms"></i> <span>Produk</span></a></li>

            <li class="{{ (request()->is('product-items') || request()->is('product-items/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('product-items.index')}}"><i class="fas fa-cubes"></i> <span>Stok</span></a></li>

            <li class="menu-header">Master</li>

            <li class="{{ (request()->is('types') || request()->is('types/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('types.index')}}"><i class="far fa-square"></i> <span>Tipe</span></a></li>

            <li class="{{ (request()->is('categories') || request()->is('categories/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('categories.index')}}"><i class="far fa-square"></i> <span>Kategori</span></a></li>

            <li class="{{ (request()->is('sub-categories') || request()->is('sub-categories/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('sub-categories.index')}}"><i class="far fa-square"></i> <span>Sub Kategori</span></a></li>

            <li class="{{ (request()->is('providers') || request()->is('providers/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('providers.index')}}"><i class="far fa-square"></i> <span>Provider</span></a></li>

            <li class="{{ (request()->is('banks') || request()->is('banks/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('banks.index')}}"><i class="far fa-square"></i> <span>Bank</span></a></li>

            <li class="menu-header">Resources</li>

            <li class="{{ (request()->is('branches') || request()->is('branches/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('branches.index')}}"><i class="fas fa-building"></i> <span>Cabang</span></a></li>

            <li class="{{ (request()->is('users') || request()->is('users/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('users.index')}}"><i class="fas fa-users"></i> <span>Karyawan</span></a></li>

            <li class="{{ (request()->is('schedules') || request()->is('schedules/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('schedules.index')}}"><i class="fas fa-user-clock"></i> <span>Jadwal</span></a></li>

            <li class="menu-header">Admin Panel</li>

            <li class="{{ (request()->is('permissions') || request()->is('permissions/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('permissions.index')}}"><i class="fas fa-users"></i> <span>Permission</span></a></li>

            <li class="{{ (request()->is('roles') || request()->is('roles/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('roles.index')}}"><i class="fas fa-users"></i> <span>Role</span></a></li>
        </ul>
    </aside>
</div>
