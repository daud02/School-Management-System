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
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-chart-line"></i> My Exam Results</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Marks</th>
                        <th>Total</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($marks as $mark)
                        <tr>
                            <td><i class="fas fa-book text-primary me-2"></i>{{ $mark['subject'] }}</td>
                            <td>{{ $mark['exam'] }}</td>
                            <td><span class="badge bg-success">{{ $mark['marks'] }}</span></td>
                            <td>{{ $mark['total'] }}</td>
                            <td>
                                @if($mark['grade'] == 'A+')
                                    <span class="badge bg-success">{{ $mark['grade'] }}</span>
                                @elseif($mark['grade'] == 'A')
                                    <span class="badge bg-info">{{ $mark['grade'] }}</span>
                                @elseif($mark['grade'] == 'A-')
                                    <span class="badge bg-primary">{{ $mark['grade'] }}</span>
                                @elseif($mark['grade'] == 'B')
                                    <span class="badge bg-warning">{{ $mark['grade'] }}</span>
                                @elseif($mark['grade'] == 'C')
                                    <span class="badge bg-secondary">{{ $mark['grade'] }}</span>
                                @elseif($mark['grade'] == 'D')
                                    <span class="badge bg-light text-dark">{{ $mark['grade'] }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $mark['grade'] }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No marks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
