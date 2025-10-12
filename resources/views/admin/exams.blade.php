@extends('layouts.app')

@section('title', 'Exams Management')
@section('page-title', 'Exams Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Exams</li>
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-clipboard-list"></i> All Exams</h5>
            <button class="btn btn-primary"><i class="fas fa-plus"></i> Schedule New Exam</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr><th>ID</th><th>Exam Name</th><th>Date</th><th>Class</th><th>Subject</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($exams as $exam)
                        <tr>
                            <td>{{ $exam['id'] }}</td>
                            <td><i class="fas fa-clipboard-list text-warning me-2"></i>{{ $exam['name'] }}</td>
                            <td>{{ $exam['date'] }}</td>
                            <td>{{ $exam['class'] }}</td>
                            <td>{{ $exam['subject'] }}</td>
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