<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('student.routine') ? 'active' : '' }}" href="{{ route('student.routine') }}">
            <i class="fas fa-calendar-alt"></i> Class Routine
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('student.marks') ? 'active' : '' }}" href="{{ route('student.marks') }}">
            <i class="fas fa-chart-line"></i> Exam Marks
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('student.attendance') ? 'active' : '' }}" href="{{ route('student.attendance') }}">
            <i class="fas fa-calendar-check"></i> Attendance
        </a>
    </li>
</ul>