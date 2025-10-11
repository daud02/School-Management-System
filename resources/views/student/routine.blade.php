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
        .table th,
        .table td {
            padding: 0.4rem 0.3rem;
            font-size: 0.85rem;
        }

        .table thead th {
            font-size: 0.9rem;
        }

        .routine-cell {
            padding: 0.3rem 0.4rem !important;
        }

        .routine-cell .fw-bold {
            font-size: 0.8rem;
            margin-bottom: 0.2rem;
        }

        .routine-cell small {
            font-size: 0.7rem;
            line-height: 1.2;
        }

        @media (max-width: 767.98px) {
            .table-responsive {
                font-size: 0.75rem;
            }

            .table th,
            .table td {
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
        <div class="card-header py-2">
            <h6 class="card-title mb-0"><i class="fas fa-calendar-alt"></i> My Class Routine - Weekly Timetable</h6>
        </div>
        <div class="card-body p-1">
            <div class="table-responsive">
                <table class="table-bordered table-sm table text-center">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 100px;">Time</th>
                            @foreach ($days as $day)
                                <th>{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timeSlots as $time)
                            <tr>
                                <td class="fw-bold bg-light" style="font-size: 0.8rem;">{{ $time }}</td>
                                @foreach ($days as $day)
                                    <td>
                                        @if (isset($timetable[$day][$time]))
                                            @php
                                                $class = $timetable[$day][$time];
                                                $isBreak = $class['subject'] == 'Break';
                                            @endphp
                                            <div
                                                class="routine-cell {{ $isBreak ? 'bg-secondary bg-opacity-10' : 'bg-primary bg-opacity-10' }} rounded">
                                                <div class="fw-bold text-{{ $isBreak ? 'secondary' : 'primary' }}">

                                                    {{ $class['subject'] }}
                                                </div>
                                                @if (!$isBreak)
                                                    <small class="text-muted d-block">
                                                        {{ $class['teacher'] }}
                                                    </small>
                                                    <small class="text-muted d-block">
                                                        {{ $class['room'] }}
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
            <div class="mt-2">
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i> <strong>Note:</strong>
                    School timing: Saturday to Wednesday, 8:00 AM - 1:00 PM
                </small>
            </div>
        </div>
    </div>
@endsection
