<div class="page-sidebar">
    <div class="logo-box"><a href="#" class="logo-text">Laundry</a><a href="#" id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a></div>
    <div class="page-sidebar-inner slimscroll">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            {{-- <li class="active-page">
                <a href="index.html" class="active"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
            </li> --}}
            <li class="{{ request()->routeIs('admin.user.index') ? 'active-page' : '' }}">
                <a href="{{ route('admin.user.index') }}" class="active"><i class="material-icons-outlined">manage_accounts</i>User</a>
            </li>
            <li class="{{ request()->routeIs('admin.member.index') ? 'active-page' : '' }}">
                <a href="{{ route('admin.member.index') }}" class="active"><i class="material-icons-outlined">account_circle</i>Member</a>
            </li>
            <li class="{{ request()->routeIs('admin.outlet.index') ? 'active-page' : '' }}">
                <a href="{{ route('admin.outlet.index') }}" class="active"><i class="material-icons-outlined">home</i>Outlet</a>
            </li>
            <li class="{{ request()->routeIs('admin.paket.index') ? 'active-page' : '' }}">
                <a href="{{ route('admin.paket.index') }}" class="active"><i class="material-icons-outlined">local_post_office</i>Paket</a>
            </li>
            <li class="{{ request()->routeIs('admin.transaksi.index') ? 'active-page' : '' }}">
                <a href="{{ route('admin.transaksi.index') }}" class="active"><i class="material-icons-outlined">shopping_cart</i>Transaksi</a>
            </li>
            <li class="{{ request()->routeIs('admin.status.laporan.*') ? 'active-page' : '' }}">
                <a href="#" class="{{ request()->routeIs('admin.status.laporan.*') ? 'active-page' : '' }}"><i class="material-icons">storefront</i>Status Laporan<i class="material-icons has-sub-menu">add</i></a>
                <ul class="sub-menu">
                    <li class="{{ request()->routeIs('admin.status.laporan.baru') ? 'active' : '' }}">
                        <a href="{{ route('admin.status.laporan.baru') }}" class="{{ request()->routeIs('admin.status.laporan.baru') ? 'active' : '' }}">Baru</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>