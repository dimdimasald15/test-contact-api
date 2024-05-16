<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $nav == 'dashboard'? 'active':''}}">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ $nav == 'users'? 'active':''}}">
        <a class="nav-link" href="{{ url('admin/users') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </li>
    <li class="nav-item {{ $nav == 'contacts'? 'active':''}}">
        <a class="nav-link" href="{{ url('admin/contacts') }}">
            <i class="fas fa-fw fa-address-book"></i>
            <span>Contacts</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->