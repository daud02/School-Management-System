@php
    $student = session('student');
    if (!$student) {
        return redirect()->route('student.login'); // redirect if not logged in
    }
    $studentId = $student['student_id'];
@endphp

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
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-2"><i class="fas fa-book"></i></div>
                    <h2 class="mb-0">{{ $stats['total_subjects'] }}</h2>
                    <p class="mb-0">Total Subjects</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-2">
                <div class="card-body text-center">
                    <div class="display-4 mb-2"><i class="fas fa-calendar-check"></i></div>
                    <h2 class="mb-0">{{ $stats['attendance_percentage'] }}%</h2>
                    <p class="mb-0">Attendance</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-3">
                <div class="card-body text-center">
                    <div class="display-4 mb-2"><i class="fas fa-clipboard-list"></i></div>
                    <h2 class="mb-0">{{ $stats['pending_assignments'] }}</h2>
                    <p class="mb-0">Pending Assignments</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-4">
                <div class="card-body text-center">
                    <div class="display-4 mb-2"><i class="fas fa-clock"></i></div>
                    <h2 class="mb-0">{{ $stats['upcoming_exams'] }}</h2>
                    <p class="mb-0">Upcoming Exams</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('student.routine', ['student_id' => $studentId]) }}" 
                               class="btn btn-outline-primary btn-block mb-2">
                                <i class="fas fa-calendar-alt"></i><br>View Routine
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('student.marks', ['student_id' => $studentId]) }}" 
                               class="btn btn-outline-success btn-block mb-2">
                                <i class="fas fa-chart-line"></i><br>Check Marks
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('student.attendance', ['student_id' => $studentId]) }}" 
                               class="btn btn-outline-warning btn-block mb-2">
                                <i class="fas fa-calendar-check"></i><br>Attendance
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('student.routine', ['student_id' => $studentId]) }}" 
                               class="btn btn-outline-info btn-block mb-2">
                                <i class="fas fa-book"></i><br>Class Schedule
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
                    @if(empty($todaySchedule) || $todaySchedule->isEmpty())
                        <div class="text-center text-muted py-3">
                            No classes today.
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($todaySchedule as $s)
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="text-primary me-3"><i class="fas fa-clock"></i></div>
                                    <div>
                                        <div class="fw-bold">{{ $s->time ?? 'Slot ' . ($s->row+1) }}</div>
                                        <small class="text-muted">{{ $s->subject }} - Room {{ $s->room }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar"></i> My Performance</h5>
                </div>
                <div class="card-body">
                @foreach($marks as $m)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>{{ $m->subject }}</span>
                            <span>{{ $m->marks }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $m->marks }}%"></div>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Overall Average</span>
                            <span>{{ round($overallAvg) }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: {{ round($overallAvg) }}%"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
