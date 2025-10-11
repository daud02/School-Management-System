@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.students') }}">
                <i class="fas fa-users"></i> Students
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.classes') }}">
                <i class="fas fa-school"></i> Classes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.marks') }}">
                <i class="fas fa-chart-line"></i> Marks
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.attendance') }}">
                <i class="fas fa-calendar-check"></i> Attendance
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="row mb-2">
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-user-graduate"
                        style="color: #FFE135; text-shadow: 0 2px 4px rgba(255,225,53,0.4); font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ $stats['total_students'] }}</h6>
                    <small class="mb-0" style="font-size: 0.9rem;">Total Students</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-2">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-chalkboard-teacher text-success" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ $stats['total_teachers'] }}</h6>
                    <small class="mb-0" style="font-size: 0.9rem;">Total Teachers</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-3">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-school text-primary" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ $stats['total_classes'] }}</h6>
                    <small class="mb-0" style="font-size: 0.9rem;">Total Classes</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-4">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-book text-danger" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ $stats['total_subjects'] }}</h6>
                    <small class="mb-0" style="font-size: 0.9rem;">Total Subjects</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-3 col-6 mb-2">
                            <a class="btn btn-outline-primary w-100 mb-2" href="{{ route('admin.students') }}">
                                <i class="fas fa-user-plus" style="color: #667eea; font-size: 1.3rem;"></i><br>Manage
                                Students
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-success w-100 mb-2" href="{{ route('admin.classes') }}">
                                <i class="fas fa-school" style="color: #2ECC71; font-size: 1.3rem;"></i><br>Manage Classes
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-warning w-100 mb-2" href="{{ route('admin.marks') }}">
                                <i class="fas fa-chart-line" style="color: #F39C12; font-size: 1.3rem;"></i><br>Student
                                Marks
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-info w-100 mb-2" href="{{ route('admin.attendance') }}">
                                <i class="fas fa-calendar-check"
                                    style="color: #3498DB; font-size: 1.3rem;"></i><br>Attendance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock"></i> Recent Activities
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center py-2">
                            <div class="text-success me-3">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div>
                                <div class="fw-bold">New student registered</div>
                                <small class="text-muted">John Doe joined Class 6A</small>
                            </div>
                            <small class="text-muted ms-auto">2 hours ago</small>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-2">
                            <div class="text-primary me-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Marks updated</div>
                                <small class="text-muted">Mathematics exam results uploaded</small>
                            </div>
                            <small class="text-muted ms-auto">4 hours ago</small>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-2">
                            <div class="text-warning me-3">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Attendance marked</div>
                                <small class="text-muted">Today's attendance completed</small>
                            </div>
                            <small class="text-muted ms-auto">6 hours ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie"></i> System Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Student Attendance</span>
                            <span>95%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 95%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Class Average</span>
                            <span>82%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 82%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Active Students</span>
                            <span>98%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 98%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
