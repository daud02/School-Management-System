@extends('layouts.app')

@section('title', 'Students Management')
@section('page-title', 'Students Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Students</li>
@endsection

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.students') }}">
                <i class="fas fa-users"></i> Students
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.classes') }}">
                <i class="fas fa-school"></i> Classes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.marks') }}">
                <i class="fas fa-chart-line"></i> Marks
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.attendance') }}">
                <i class="fas fa-calendar-check"></i> Attendance
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <!-- Students Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-user-graduate text-primary"></i>
                    </div>
                    <h3 class="mb-0">{{ count($students) }}</h3>
                    <p class="mb-0">Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-2">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-male text-info"></i>
                    </div>
                    <h3 class="mb-0">{{ collect($students)->where('gender', 'Male')->count() }}</h3>
                    <p class="mb-0">Male Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-3">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-female text-danger"></i>
                    </div>
                    <h3 class="mb-0">{{ collect($students)->where('gender', 'Female')->count() }}</h3>
                    <p class="mb-0">Female Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-4">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-star text-warning"></i>
                    </div>
                    <h3 class="mb-0">{{ collect($students)->where('status', 'Active')->count() }}</h3>
                    <p class="mb-0">Active Students</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-filter"></i> Filter Students
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="classFilter">Filter by Class</label>
                        <select class="form-control" id="classFilter">
                            <option value="">All Classes</option>
                            <option value="Class 6A">Class 6A</option>
                            <option value="Class 6B">Class 6B</option>
                            <option value="Class 7A">Class 7A</option>
                            <option value="Class 7B">Class 7B</option>
                            <option value="Class 8A">Class 8A</option>
                            <option value="Class 8B">Class 8B</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="genderFilter">Filter by Gender</label>
                        <select class="form-control" id="genderFilter">
                            <option value="">All Genders</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="searchStudent">Search Student</label>
                        <input type="text" class="form-control" id="searchStudent" placeholder="Search by name or ID...">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                            <i class="fas fa-plus"></i> Add Student
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-list"></i> Students List
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="studentsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student['id'] }}</td>
                            <td>
                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text={{ strtoupper(substr($student['name'], 0, 1)) }}" 
                                     class="rounded-circle" alt="Student Photo" width="40" height="40">
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $student['name'] }}</strong><br>
                                    <small class="text-muted">{{ $student['email'] }}</small>
                                </div>
                            </td>
                            <td>{{ $student['class'] }}</td>
                            <td>
                                <span class="badge bg-{{ $student['gender'] == 'Male' ? 'info' : 'danger' }}">
                                    {{ $student['gender'] }}
                                </span>
                            </td>
                            <td>{{ $student['date_of_birth'] }}</td>
                            <td>
                                <span class="badge bg-{{ $student['status'] == 'Active' ? 'success' : 'secondary' }}">
                                    {{ $student['status'] }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentName">Full Name</label>
                                    <input type="text" class="form-control" id="studentName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentEmail">Email</label>
                                    <input type="email" class="form-control" id="studentEmail" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentClass">Class</label>
                                    <select class="form-control" id="studentClass" required>
                                        <option value="">Select Class</option>
                                        <option value="Class 6A">Class 6A</option>
                                        <option value="Class 6B">Class 6B</option>
                                        <option value="Class 7A">Class 7A</option>
                                        <option value="Class 7B">Class 7B</option>
                                        <option value="Class 8A">Class 8A</option>
                                        <option value="Class 8B">Class 8B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentGender">Gender</label>
                                    <select class="form-control" id="studentGender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentDOB">Date of Birth</label>
                                    <input type="date" class="form-control" id="studentDOB" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentPhone">Phone</label>
                                    <input type="tel" class="form-control" id="studentPhone">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="studentAddress">Address</label>
                            <textarea class="form-control" id="studentAddress" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Add Student</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('studentsTable');
    const searchInput = document.getElementById('searchStudent');
    const classFilter = document.getElementById('classFilter');
    const genderFilter = document.getElementById('genderFilter');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedClass = classFilter.value;
        const selectedGender = genderFilter.value;
        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {
            const name = row.children[2].textContent.toLowerCase();
            const studentClass = row.children[3].textContent;
            const gender = row.children[4].textContent.trim();
            
            const matchesSearch = name.includes(searchTerm);
            const matchesClass = !selectedClass || studentClass === selectedClass;
            const matchesGender = !selectedGender || gender.includes(selectedGender);
            
            if (matchesSearch && matchesClass && matchesGender) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    classFilter.addEventListener('change', filterTable);
    genderFilter.addEventListener('change', filterTable);
});
</script>
@endpush