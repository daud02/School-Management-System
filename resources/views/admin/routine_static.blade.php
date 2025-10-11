@extends('layouts.app')

@section('title', 'Edit Routine')
@section('page-title', 'Edit Routine (Static Form)')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Edit Routine Cell</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @error('*')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form method="POST" action="{{ route('admin.routine.static.save') }}">
            @csrf

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Class</label>
                    <input type="text" name="class" class="form-control" placeholder="e.g. CSE 2nd Year" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Day</label>
                    <select name="day" class="form-select" required>
                        <option value="">Select Day</option>
                        @foreach($days as $d)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Time</label>
                    <select name="time" class="form-select" required>
                        <option value="">Select Time</option>
                        @foreach($timeSlots as $t)
                            <option value="{{ $t }}">{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="Subject name">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Instructor</label>
                    <input type="text" name="instructor" class="form-control" placeholder="Instructor name">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Room</label>
                    <input type="text" name="room" class="form-control" placeholder="Room number">
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Save Routine Cell</button>
            </div>
        </form>
    </div>
</div>
@endsection
