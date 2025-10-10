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
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h2 class="mb-0">{{ $stats['total_students'] }}</h2>
                    <p class="mb-0">Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-2">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h2 class="mb-0">{{ $stats['total_teachers'] }}</h2>
                    <p class="mb-0">Total Teachers</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-3">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-school"></i>
                    </div>
                    <h2 class="mb-0">{{ $stats['total_classes'] }}</h2>
                    <p class="mb-0">Total Classes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-4">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-book"></i>
                    </div>
                    <h2 class="mb-0">{{ $stats['total_subjects'] }}</h2>
                    <p class="mb-0">Total Subjects</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.students') }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-user-plus"></i><br>Manage Students
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.classes') }}" class="btn btn-outline-success w-100 mb-2">
                                <i class="fas fa-school"></i><br>Manage Classes
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.marks') }}" class="btn btn-outline-warning w-100 mb-2">
                                <i class="fas fa-chart-line"></i><br>Student Marks
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.attendance') }}" class="btn btn-outline-info w-100 mb-2">
                                <i class="fas fa-calendar-check"></i><br>Attendance
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
                        <div class="list-group-item d-flex align-items-center">
                            <div class="text-success me-3">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div>
                                <div class="fw-bold">New student registered</div>
                                <small class="text-muted">John Doe joined Class 6A</small>
                            </div>
                            <small class="text-muted ms-auto">2 hours ago</small>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="text-primary me-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Marks updated</div>
                                <small class="text-muted">Mathematics exam results uploaded</small>
                            </div>
                            <small class="text-muted ms-auto">4 hours ago</small>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
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
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Student Attendance</span>
                            <span>95%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 95%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Class Average</span>
                            <span>82%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 82%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
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