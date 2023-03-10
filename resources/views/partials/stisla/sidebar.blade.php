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

            <li class="menu-header">Master</li>

            <li class="{{ (request()->is('types') || request()->is('types/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('types.index')}}"><i class="far fa-square"></i> <span>Type</span></a></li>

            <li class="{{ (request()->is('categories') || request()->is('categories/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('categories.index')}}"><i class="far fa-square"></i> <span>Category</span></a></li>

            <li class="{{ (request()->is('sub-categories') || request()->is('sub-categories/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('sub-categories.index')}}"><i class="far fa-square"></i> <span>Sub Category</span></a></li>

            <li class="{{ (request()->is('providers') || request()->is('providers/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('providers.index')}}"><i class="far fa-square"></i> <span>Provider</span></a></li>

            <li class="{{ (request()->is('banks') || request()->is('banks/*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('banks.index')}}"><i class="far fa-square"></i> <span>Bank</span></a></li>
        </ul>
    </aside>
</div>
