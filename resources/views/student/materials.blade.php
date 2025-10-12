@extends('layouts.app')

@section('title', 'Study Materials')
@section('page-title', 'Study Materials')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Materials</li>
@endsection

@section('sidebar')
    @include('student.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-download"></i> Study Materials</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Title</th><th>Subject</th><th>Teacher</th><th>Uploaded</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                        <tr>
                            <td><i class="fas fa-file-pdf text-danger me-2"></i>{{ $material['title'] }}</td>
                            <td>{{ $material['subject'] }}</td>
                            <td>{{ $material['teacher'] }}</td>
                            <td>{{ $material['uploaded'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Download</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection