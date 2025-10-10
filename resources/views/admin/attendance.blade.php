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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-calendar-check"></i> Student Attendance</h5>
            <button class="btn btn-primary"><i class="fas fa-plus"></i> Mark Attendance</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Student</th><th>Class</th><th>Date</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($attendance as $record)
                        <tr>
                            <td><i class="fas fa-user text-info me-2"></i>{{ $record['student'] }}</td>
                            <td>{{ $record['class'] }}</td>
                            <td>{{ $record['date'] }}</td>
                            <td>
                                @if($record['status'] == 'Present')
                                    <span class="badge bg-success">Present</span>
                                @elseif($record['status'] == 'Absent')
                                    <span class="badge bg-danger">Absent</span>
                                @else
                                    <span class="badge bg-warning">Late</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection