@extends('layouts.app')

@section('title', 'Users Management')
@section('page-title', 'Users Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.users') }}">
                <i class="fas fa-users"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.classes') }}">
                <i class="fas fa-school"></i> Classes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.subjects') }}">
                <i class="fas fa-book"></i> Subjects
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.exams') }}">
                <i class="fas fa-clipboard-list"></i> Exams
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.attendance') }}">
                <i class="fas fa-calendar-check"></i> Attendance
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.accounting') }}">
                <i class="fas fa-calculator"></i> Accounting
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.events') }}">
                <i class="fas fa-calendar-alt"></i> Events
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.library') }}">
                <i class="fas fa-book-open"></i> Library
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users"></i> All Users
                    </h5>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New User
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2">
                                                <i class="fas fa-user-circle fa-2x text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $user['name'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>
                                        @if($user['role'] == 'Teacher')
                                            <span class="badge bg-primary">{{ $user['role'] }}</span>
                                        @elseif($user['role'] == 'Student')
                                            <span class="badge bg-success">{{ $user['role'] }}</span>
                                        @elseif($user['role'] == 'Parent')
                                            <span class="badge bg-info">{{ $user['role'] }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $user['role'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $user['status'] }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection