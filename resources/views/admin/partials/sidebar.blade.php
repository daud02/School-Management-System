<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
            <i class="fas fa-users"></i> Users
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.classes') ? 'active' : '' }}" href="{{ route('admin.classes') }}">
            <i class="fas fa-school"></i> Classes
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.subjects') ? 'active' : '' }}" href="{{ route('admin.subjects') }}">
            <i class="fas fa-book"></i> Subjects
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.exams') ? 'active' : '' }}" href="{{ route('admin.exams') }}">
            <i class="fas fa-clipboard-list"></i> Exams
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.attendance') ? 'active' : '' }}" href="{{ route('admin.attendance') }}">
            <i class="fas fa-calendar-check"></i> Attendance
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.accounting') ? 'active' : '' }}" href="{{ route('admin.accounting') }}">
            <i class="fas fa-calculator"></i> Accounting
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.events') ? 'active' : '' }}" href="{{ route('admin.events') }}">
            <i class="fas fa-calendar-alt"></i> Events
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.library') ? 'active' : '' }}" href="{{ route('admin.library') }}">
            <i class="fas fa-book-open"></i> Library
        </a>
    </li>
</ul>