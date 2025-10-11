@extends('layouts.app')

@section('title', 'Attendance')
@section('page-title', 'My Attendance')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Attendance</li>
@endsection

@section('sidebar')
    @include('student.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-calendar-check"></i> My Attendance Record</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-calendar"></i> Date</th>
                            <th><i class="fas fa-calendar-day"></i> Day</th>
                            <th><i class="fas fa-clock"></i> Time</th>
                            <th><i class="fas fa-check-circle"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendance as $record)
                        <tr>
                            <td>{{ $record['date'] }}</td>
                            <td><span class="badge bg-info">{{ $record['day'] }}</span></td>
                            <td>{{ $record['time'] }}</td>
                            <td>
                                @if($record['status'] == 'Present')
                                    <span class="badge bg-success"><i class="fas fa-check"></i> Present</span>
                                @elseif($record['status'] == 'Late')
                                    <span class="badge bg-warning"><i class="fas fa-clock"></i> Late</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times"></i> Absent</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Attendance Summary -->
            <div class="mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h3 class="mb-0">
                                    {{ collect($attendance)->where('status', 'Present')->count() }}
                                </h3>
                                <small>Days Present</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h3 class="mb-0">
                                    {{ collect($attendance)->where('status', 'Late')->count() }}
                                </h3>
                                <small>Days Late</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <h3 class="mb-0">
                                    {{ collect($attendance)->where('status', 'Absent')->count() }}
                                </h3>
                                <small>Days Absent</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
