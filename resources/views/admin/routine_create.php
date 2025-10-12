@extends('layouts.app')

@section('title', 'Edit Class Routine')
@section('page-title', 'Edit Class Routine')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Select Class -->
<form method="GET" action="{{ route('admin.routine.create') }}" class="mb-3">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="class" value="{{ $class ?? '' }}" class="form-control" placeholder="Enter class" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Load Routine</button>
        </div>
    </div>
</form>

@if(isset($class))
<form method="POST" action="{{ route('admin.routine.update', ['class' => $class]) }}">
    @csrf
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 120px;">Time</th>
                    @foreach($days as $day)
                        <th>{{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($timeSlots as $row => $time)
                <tr>
                    <td class="fw-bold bg-light">{{ $time }}</td>
                    @foreach(range(0,4) as $col)
                        @php $cell = $grid[$row][$col] ?? null; @endphp
                        <td>
                            <div class="mb-1">
                                <input type="text" name="routine[{{ $row }}][{{ $col }}][subject]" 
                                       value="{{ $cell->subject ?? '' }}" placeholder="Subject" class="form-control form-control-sm mb-1">
                                <input type="text" name="routine[{{ $row }}][{{ $col }}][instructor]" 
                                       value="{{ $cell->instructor ?? '' }}" placeholder="Instructor" class="form-control form-control-sm mb-1">
                                <input type="text" name="routine[{{ $row }}][{{ $col }}][room]" 
                                       value="{{ $cell->room ?? '' }}" placeholder="Room" class="form-control form-control-sm">
                            </div>
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-success mt-3">
        <i class="fas fa-save"></i> Save Routine
    </button>
</form>
@endif

@endsection
