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
            <li class="{{ (request()->is('types')) ? 'active' : '' }}"><a class="nav-link" href="{{route('types.index')}}"><i class="far fa-square"></i> <span>Types</span></a></li>
        </ul>
    </aside>
</div>
