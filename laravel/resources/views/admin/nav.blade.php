
<!-- BEGIN DEFAULT SIDEBAR -->
<div class="ks-column ks-sidebar ks-info" style="position: relative;z-index: 1">
    <div class="ks-wrapper">
        <ul class="nav nav-pills nav-stacked">
            <li class="nav-item ks-user dropdown">
                <a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ $data['user']->gravatar }}" width="36" height="36" class="ks-avatar rounded-circle">
                    <div class="ks-info">
                        <div class="ks-name">{{ $data['user']->firstname }} {{ $data['user']->lastname }}</div>
                        <div class="ks-text">{{ $data['user']->company }}</div>
                    </div>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/profile">Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </li>
            <li class="nav-item"><a class="dropdown-item" href="/admin">Admin Home</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/addmember">Add Member</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/addcompany">Add Company</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/profileadvert">Change Profile Advert</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/companies">Company Memberships</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/authorize">Academic Authorization</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/directory">View Active Members</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/expireddirectory">View Expired Members</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/events">View Events</a></li>
            <li class="nav-item"><a class="dropdown-item" href="/admin/reports">Reports</a></li>
        </ul>
        <div class="ks-sidebar-extras-block">
            <div class="ks-sidebar-copyright">© 2017 Color Marketing Group. All right reserved</div>
        </div>
    </div>
</div>
<!-- END DEFAULT SIDEBAR -->