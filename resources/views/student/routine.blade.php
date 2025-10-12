@extends('layouts.app')

@section('title', 'Class Routine')
@section('page-title', 'Class Routine')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Routine</li>
@endsection

@section('sidebar')
    @include('student.partials.sidebar')
@endsection

@section('content')
    <style>
        @media (max-width: 767.98px) {
            .table-responsive {
                font-size: 0.75rem;
            }
            .table th, .table td {
                padding: 0.5rem 0.25rem;
            }
            .fw-bold {
                font-size: 0.7rem;
            }
            small {
                font-size: 0.65rem;
            }
            .bg-primary.bg-opacity-10,
            .bg-secondary.bg-opacity-10 {
                padding: 0.5rem !important;
            }
        }
    </style>
    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-calendar-alt"></i> My Class Routine - Weekly Timetable</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 120px;">Time</th>
                            @foreach($days as $day)
                                <th>{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeSlots as $time)
                        <tr>
                            <td class="fw-bold bg-light">{{ $time }}</td>
                            @foreach($days as $day)
                                <td>
                                    @if(isset($timetable[$day][$time]))
                                        @php
                                            $class = $timetable[$day][$time];
                                            $isBreak = $class['subject'] == 'Break';
                                        @endphp
                                        <div class="p-2 {{ $isBreak ? 'bg-secondary bg-opacity-10' : 'bg-primary bg-opacity-10' }} rounded">
                                            <div class="fw-bold text-{{ $isBreak ? 'secondary' : 'primary' }}">
                                                <i class="fas fa-{{ $isBreak ? 'coffee' : 'book' }}"></i>
                                                {{ $class['subject'] }}
                                            </div>
                                            @if(!$isBreak)
                                                <small class="text-muted d-block mt-1">
                                                    <i class="fas fa-user"></i> {{ $class['teacher'] }}
                                                </small>
                                                <small class="text-muted d-block">
                                                    <i class="fas fa-door-open"></i> {{ $class['room'] }}
                                                </small>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Legend -->
            <div class="mt-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i> <strong>Note:</strong> 
                    School timing: Saturday to Wednesday, 8:00 AM - 1:00 PM
                </small>
            </div>
        </div>
    </div>
@endsection
