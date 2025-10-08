@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('sidebar')
    @include('student.partials.sidebar')
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="row mb-2">
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-book"
                        style="color: #FFD700; text-shadow: 0 2px 4px rgba(255,215,0,0.3); font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ $stats['total_subjects'] }}</h6>
                    <small class="mb-0" style="font-size: 0.9rem;">Total Subjects</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-2">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-calendar-check"
                        style="color: #00FF7F; text-shadow: 0 2px 4px rgba(0,255,127,0.3); font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ $stats['attendance_percentage'] }}%</h6>
                    <small class="mb-0" style="font-size: 0.9rem;">Attendance</small>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h6 class="card-title mb-0"><i class="fas fa-bolt"></i> Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-outline-primary btn-block mb-2" href="{{ route('student.routine') }}">
                                <i class="fas fa-calendar-alt" style="color: #4285F4; font-size: 1.2rem;"></i><br>View
                                Routine
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-success btn-block mb-2" href="{{ route('student.marks') }}">
                                <i class="fas fa-chart-line" style="color: #34A853; font-size: 1.2rem;"></i><br>Check Marks
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-warning btn-block mb-2" href="{{ route('student.attendance') }}">
                                <i class="fas fa-calendar-check"
                                    style="color: #FBBC05; font-size: 1.2rem;"></i><br>Attendance
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-info btn-block mb-2" href="{{ route('student.routine') }}">
                                <i class="fas fa-book" style="color: #17A2B8; font-size: 1.2rem;"></i><br>Class Schedule
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Schedule & Performance -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-clock"></i> Today's Schedule</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center py-2">
                            <div class="text-primary me-3"><i class="fas fa-clock"></i></div>
                            <div>
                                <div class="fw-bold">09:00 - 10:00 AM</div>
                                <small class="text-muted">Mathematics - Room 101</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-2">
                            <div class="text-success me-3"><i class="fas fa-clock"></i></div>
                            <div>
                                <div class="fw-bold">10:30 - 11:30 AM</div>
                                <small class="text-muted">English - Room 102</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-2">
                            <div class="text-warning me-3"><i class="fas fa-clock"></i></div>
                            <div>
                                <div class="fw-bold">02:00 - 03:00 PM</div>
                                <small class="text-muted">Science - Lab 1</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar"></i> My Performance</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Mathematics</span>
                            <span>85%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>English</span>
                            <span>92%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 92%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Science</span>
                            <span>78%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 78%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Overall Average</span>
                            <span>85%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
