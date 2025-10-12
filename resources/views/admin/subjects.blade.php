@extends('layouts.app')

@section('title', 'Subjects Management')
@section('page-title', 'Subjects Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Subjects</li>
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-book"></i> All Subjects</h5>
            <button class="btn btn-primary"><i class="fas fa-plus"></i> Add New Subject</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr><th>ID</th><th>Subject Name</th><th>Code</th><th>Teacher</th><th>Class</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject['id'] }}</td>
                            <td><i class="fas fa-book text-primary me-2"></i>{{ $subject['name'] }}</td>
                            <td><span class="badge bg-secondary">{{ $subject['code'] }}</span></td>
                            <td>{{ $subject['teacher'] }}</td>
                            <td>{{ $subject['class'] }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
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