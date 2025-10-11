@extends('layouts.app')

@section('title', 'Attendance Management')
@section('page-title', 'Attendance Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Attendance</li>
@endsection

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
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
            <a class="nav-link active" href="{{ route('admin.attendance') }}">
                <i class="fas fa-calendar-check"></i> Attendance
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <strong>Oops!</strong> There were some problems.
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($class) && isset($students))
        <!-- ATTENDANCE MARKING FORM -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                <h6 class="card-title mb-0 text-white">
                    <i class="fas fa-calendar-check"></i> Mark Attendance - {{ $class['name'] }} {{ $class['section'] }}
                </h6>
                <a href="{{ route('attendance.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <div class="bg-light mb-3 rounded p-3">
                    <div class="row">
                        <div class="col-md-4">
                            <small><strong><i class="fas fa-calendar"></i> Date:</strong> {{ $date }}</small>
                        </div>
                        <div class="col-md-4">
                            <small><strong><i class="fas fa-chalkboard-teacher"></i> Teacher:</strong> {{ $class['teacher'] }}</small>
                        </div>
                        <div class="col-md-4 text-end">
                            <small><strong><i class="fas fa-users"></i> Total Students:</strong> {{ count($students) }}</small>
                        </div>
                    </div>
                </div>

                <form action="{{ route('attendance.store') }}" method="POST" id="attendanceForm">
                    @csrf
                    <input type="hidden" name="class" value="{{ $class['name'] }}{{ $class['section'] }}">
                    <input type="hidden" name="date" value="{{ $date }}">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Roll</th>
                                    <th style="width: 35%;">Student Name</th>
                                    <th style="width: 25%;">Email</th>
                                    <th style="width: 30%;" class="text-center">Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $student['name'] }}</strong><br>
                                            <small class="text-muted">ID: {{ $student['student_id'] }}</small>
                                        </td>
                                        <td>{{ $student['email'] }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <input type="radio" class="btn-check" name="attendance[{{ $student['id'] }}]" 
                                                       id="present_{{ $student['id'] }}" value="present" checked>
                                                <label class="btn btn-outline-success btn-sm" for="present_{{ $student['id'] }}">
                                                    <i class="fas fa-check"></i> Present
                                                </label>

                                                <input type="radio" class="btn-check" name="attendance[{{ $student['id'] }}]" 
                                                       id="absent_{{ $student['id'] }}" value="absent">
                                                <label class="btn btn-outline-danger btn-sm" for="absent_{{ $student['id'] }}">
                                                    <i class="fas fa-times"></i> Absent
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No students found in this class.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(count($students) > 0)
                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="markAllPresent()">
                                    <i class="fas fa-check-double"></i> Mark All Present
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="markAllAbsent()">
                                    <i class="fas fa-times-circle"></i> Mark All Absent
                                </button>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save"></i> Submit Attendance
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="card mt-3">
            <div class="card-header py-2">
                <h6 class="card-title mb-0"><i class="fas fa-chart-bar"></i> Quick Summary</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center p-3">
                                <h3 class="mb-0" id="presentCount">{{ count($students) }}</h3>
                                <small>Students Present</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center p-3">
                                <h3 class="mb-0" id="absentCount">0</h3>
                                <small>Students Absent</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- CLASS SELECTION VIEW -->
        <div class="row mb-3">
            <div class="col-md-12">
                <h6 class="mb-3"><i class="fas fa-chalkboard-teacher"></i> Select a Class to Mark Attendance</h6>
            </div>
        </div>
        <div class="row">
            @php
                $colors = ['#667eea', '#764ba2', '#f093fb', '#4facfe', '#43e97b', '#fa709a'];
                $icons = ['fa-book', 'fa-graduation-cap', 'fa-user-graduate', 'fa-chalkboard', 'fa-book-open', 'fa-school'];
            @endphp

            @forelse ($classes as $index => $class)
                <div class="col-md-4 mb-3">
                    <a href="{{ route('attendance.mark', $class['id']) }}" class="text-decoration-none">
                        <div class="card class-card h-100" style="cursor: pointer;">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box me-3"
                                        style="background: {{ $colors[$index % count($colors)] }}; width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas {{ $icons[$index % count($icons)] }} text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 text-dark" style="font-size: 1rem; font-weight: 600;">
                                            {{ $class['name'] }} {{ $class['section'] }}
                                        </h6>
                                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                            <i class="fas fa-users"></i> {{ $class['students'] }} Students
                                        </p>
                                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                            <i class="fas fa-chalkboard-teacher"></i> {{ $class['teacher'] }}
                                        </p>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No classes found. Please add classes first.
                    </div>
                </div>
            @endforelse
        </div>
    @endif
@endsection

@section('scripts')
    @if(isset($class) && isset($students))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const attendanceInputs = document.querySelectorAll('input[type="radio"][name^="attendance"]');
            
            // Update summary on radio button change
            attendanceInputs.forEach(input => {
                input.addEventListener('change', updateSummary);
            });

            // Initial summary update
            updateSummary();

            function updateSummary() {
                const totalStudents = {{ count($students) }};
                let presentCount = 0;
                let absentCount = 0;

                attendanceInputs.forEach(input => {
                    if (input.checked) {
                        if (input.value === 'present') {
                            presentCount++;
                        } else if (input.value === 'absent') {
                            absentCount++;
                        }
                    }
                });

                document.getElementById('presentCount').textContent = presentCount;
                document.getElementById('absentCount').textContent = absentCount;
            }
        });

        function markAllPresent() {
            const presentRadios = document.querySelectorAll('input[type="radio"][value="present"]');
            presentRadios.forEach(radio => {
                radio.checked = true;
                radio.dispatchEvent(new Event('change'));
            });
        }

        function markAllAbsent() {
            if (confirm('Are you sure you want to mark all students as absent?')) {
                const absentRadios = document.querySelectorAll('input[type="radio"][value="absent"]');
                absentRadios.forEach(radio => {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change'));
                });
            }
        }
    </script>
    @endif

    <style>
        .class-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
