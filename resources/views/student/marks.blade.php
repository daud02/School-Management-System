@extends('layouts.app')

@section('title', 'Exam Marks')
@section('page-title', 'Exam Marks')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Marks</li>
@endsection

@section('sidebar')
    @include('student.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header py-2">
            <h6 class="card-title mb-0"><i class="fas fa-chart-line"></i> My Exam Results</h6>
        </div>
        <div class="card-body p-1">
            <div class="table-responsive">
                <table class="table-striped table-sm table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Exam</th>
                            <th>Marks</th>
                            <th>Total</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marks as $mark)
                            <tr>
                                <td><i class="fas fa-book text-primary me-1"></i>{{ $mark['subject'] }}</td>
                                <td><small>{{ $mark['exam'] }}</small></td>
                                <td><span class="badge bg-success">{{ $mark['marks'] }}</span></td>
                                <td><small>{{ $mark['total'] }}</small></td>
                                <td>
                                    @if ($mark['grade'] == 'A+')
                                        <span class="badge bg-success">{{ $mark['grade'] }}</span>
                                    @elseif($mark['grade'] == 'A')
                                        <span class="badge bg-info">{{ $mark['grade'] }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $mark['grade'] }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
