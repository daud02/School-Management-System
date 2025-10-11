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
    <div class="row mb-2">
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-user-graduate text-warning" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ count($students) }}</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">Total Students</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-2">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-male text-success" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ collect($students)->where('gender', 'Male')->count() }}</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">Male Students</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-3">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-female text-primary" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ collect($students)->where('gender', 'Female')->count() }}</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">Female Students</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-4">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-school text-danger" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ collect($students)->pluck('class')->unique()->count() }}</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">Total Classes</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card mb-4">
        <div class="card-header py-2">
            <h6 class="card-title mb-0">
                <i class="fas fa-filter"></i> Filter Students
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
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
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="genderFilter">Filter by Gender</label>
                        <select class="form-control" id="genderFilter">
                            <option value="">All Genders</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="searchStudent">Search Student</label>
                        <input class="form-control" id="searchStudent" type="text" placeholder="Search by name or ID...">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button class="btn btn-outline-secondary w-100" id="resetFilters">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
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
                <table class="table-striped table-hover table" id="studentsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td><strong>{{ $student['student_id'] }}</strong></td>

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
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-info view-student-btn"
                                            data-student-id="{{ $student['student_id'] }}"
                                            data-name="{{ $student['name'] }}"
                                            data-email="{{ $student['email'] }}" 
                                            data-class="{{ $student['class'] }}"
                                            data-gender="{{ $student['gender'] }}"
                                            data-dob="{{ $student['date_of_birth'] }}"
                                            data-phone="{{ $student['phone'] ?? '' }}"
                                            data-address="{{ $student['address'] ?? '' }}" 
                                            type="button"
                                            title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning edit-student-btn"
                                            data-student-id="{{ $student['student_id'] }}"
                                            data-name="{{ $student['name'] }}"
                                            data-email="{{ $student['email'] }}" 
                                            data-class="{{ $student['class'] }}"
                                            data-gender="{{ $student['gender'] }}"
                                            data-dob="{{ $student['date_of_birth'] }}"
                                            data-phone="{{ $student['phone'] ?? '' }}"
                                            data-address="{{ $student['address'] ?? '' }}" 
                                            type="button"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('students.destroy', $student['student_id']) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete {{ $student['name'] }}?')" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
                    <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route('students.store') }}" method="POST" id="addStudentForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="studentId">Student ID <span class="text-danger">*</span></label>
                                    <input class="form-control @error('student_id') is-invalid @enderror" 
                                           id="studentId" 
                                           name="student_id" 
                                           type="text" 
                                           placeholder="STU001"
                                           value="{{ old('student_id') }}"
                                           required>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="studentName">Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" 
                                           id="studentName" 
                                           name="name" 
                                           type="text"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentEmail">Email <span class="text-danger">*</span></label>
                                    <input class="form-control @error('email') is-invalid @enderror" 
                                           id="studentEmail" 
                                           name="email" 
                                           type="email"
                                           value="{{ old('email') }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentPhone">Phone</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" 
                                           id="studentPhone" 
                                           name="phone" 
                                           type="tel"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentClass">Class <span class="text-danger">*</span></label>
                                    <select class="form-control @error('class') is-invalid @enderror" 
                                            id="studentClass" 
                                            name="class" 
                                            required>
                                        <option value="">Select Class</option>
                                        <option value="Class 6A" {{ old('class') == 'Class 6A' ? 'selected' : '' }}>Class 6A</option>
                                        <option value="Class 6B" {{ old('class') == 'Class 6B' ? 'selected' : '' }}>Class 6B</option>
                                        <option value="Class 7A" {{ old('class') == 'Class 7A' ? 'selected' : '' }}>Class 7A</option>
                                        <option value="Class 7B" {{ old('class') == 'Class 7B' ? 'selected' : '' }}>Class 7B</option>
                                        <option value="Class 8A" {{ old('class') == 'Class 8A' ? 'selected' : '' }}>Class 8A</option>
                                        <option value="Class 8B" {{ old('class') == 'Class 8B' ? 'selected' : '' }}>Class 8B</option>
                                    </select>
                                    @error('class')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentGender">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control @error('gender') is-invalid @enderror" 
                                            id="studentGender" 
                                            name="gender" 
                                            required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentDOB">Date of Birth <span class="text-danger">*</span></label>
                                    <input class="form-control @error('date_of_birth') is-invalid @enderror" 
                                           id="studentDOB" 
                                           name="date_of_birth" 
                                           type="date"
                                           value="{{ old('date_of_birth') }}"
                                           required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="studentAddress">Address</label>
                                    <input class="form-control @error('address') is-invalid @enderror" 
                                           id="studentAddress" 
                                           name="address" 
                                           type="text"
                                           value="{{ old('address') }}">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-plus"></i> Add Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student Information</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="" method="POST" id="editStudentForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="editStudentId">Student ID <span class="text-danger">*</span></label>
                                    <input class="form-control" id="editStudentId" name="student_id" type="text" 
                                           placeholder="STU001" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="editStudentName">Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="editStudentName" name="name" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editStudentEmail">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" id="editStudentEmail" name="email" type="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editStudentPhone">Phone</label>
                                    <input class="form-control" id="editStudentPhone" name="phone" type="tel">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editStudentClass">Class <span class="text-danger">*</span></label>
                                    <select class="form-control" id="editStudentClass" name="class" required>
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
                                    <label for="editStudentGender">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control" id="editStudentGender" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editStudentDOB">Date of Birth <span class="text-danger">*</span></label>
                                    <input class="form-control" id="editStudentDOB" name="date_of_birth" type="date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editStudentAddress">Address</label>
                                    <input class="form-control" id="editStudentAddress" name="address" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        <button class="btn btn-warning" type="submit">
                            <i class="fas fa-save"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Student Details Modal -->
    <div class="modal fade" id="viewStudentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user-circle"></i> Student Details
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="viewStudentId">Student ID</label>
                                <input class="form-control" id="viewStudentId" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="viewStudentName">Full Name</label>
                                <input class="form-control" id="viewStudentName" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="viewStudentEmail">Email</label>
                                <input class="form-control" id="viewStudentEmail" type="email" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="viewStudentPhone">Phone</label>
                                <input class="form-control" id="viewStudentPhone" type="tel" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="viewStudentClass">Class</label>
                                <input class="form-control" id="viewStudentClass" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="viewStudentGender">Gender</label>
                                <input class="form-control" id="viewStudentGender" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="viewStudentDOB">Date of Birth</label>
                                <input class="form-control" id="viewStudentDOB" type="date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="viewStudentAddress">Address</label>
                                <input class="form-control" id="viewStudentAddress" type="text" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('studentsTable');
            const searchInput = document.getElementById('searchStudent');
            const classFilter = document.getElementById('classFilter');
            const genderFilter = document.getElementById('genderFilter');
            const resetButton = document.getElementById('resetFilters');

            console.log('Filter script loaded!');
            console.log('Table:', table);
            console.log('Reset Button:', resetButton);

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedClass = classFilter.value.trim();
                const selectedGender = genderFilter.value.trim();

                console.log('Applying filters - Search:', searchTerm, 'Class:', selectedClass, 'Gender:',
                    selectedGender);

                const tbody = table.querySelector('tbody');
                const rows = tbody.querySelectorAll('tr');
                let visibleCount = 0;

                rows.forEach((row, index) => {
                    // Table columns: ID(0), Name(1), Class(2), Gender(3), DOB(4), Actions(5)
                    const cells = row.querySelectorAll('td');

                    if (cells.length >= 4) {
                        // Get name from column 1 (Name column)
                        const nameDiv = cells[1].querySelector('strong');
                        const name = nameDiv ? nameDiv.textContent.toLowerCase().trim() : '';

                        // Get class from column 2 (Class column)
                        const studentClass = cells[2].textContent.trim();

                        // Get gender from the badge in column 3 (Gender column)
                        const genderBadge = cells[3].querySelector('.badge');
                        const gender = genderBadge ? genderBadge.textContent.trim() : '';

                        console.log(`Row ${index + 1}:`, {
                            name: name,
                            class: studentClass,
                            gender: gender
                        });

                        // Apply filter logic
                        let showRow = true;

                        // Search filter (name contains search term)
                        if (searchTerm && !name.includes(searchTerm)) {
                            showRow = false;
                        }

                        // Class filter (exact match or "All Classes")
                        if (selectedClass && selectedClass !== '' && studentClass !== selectedClass) {
                            showRow = false;
                        }

                        // Gender filter (exact match or "All Genders")
                        if (selectedGender && selectedGender !== '' && gender !== selectedGender) {
                            showRow = false;
                        }

                        console.log(`Row ${index + 1} visible:`, showRow);

                        // Show/hide row
                        if (showRow) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                console.log('Total visible rows:', visibleCount);
            }

            function resetFilters() {
                console.log('Resetting all filters...');

                // Clear all filter inputs
                searchInput.value = '';
                classFilter.selectedIndex = 0; // Reset to first option
                genderFilter.selectedIndex = 0; // Reset to first option

                // Show all rows
                const tbody = table.querySelector('tbody');
                const rows = tbody.querySelectorAll('tr');
                rows.forEach(row => {
                    row.style.display = '';
                });

                console.log('All filters reset and all rows shown');
            }

            // Event listeners for real-time filtering
            if (classFilter) {
                classFilter.addEventListener('change', function() {
                    console.log('Class filter changed');
                    filterTable();
                });
            }

            if (genderFilter) {
                genderFilter.addEventListener('change', function() {
                    console.log('Gender filter changed');
                    filterTable();
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    console.log('Search input changed');
                    filterTable();
                });
            }

            if (resetButton) {
                resetButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Reset button clicked');
                    resetFilters();
                });
            } else {
                console.error('Reset button not found!');
            }

            // View Student Modal functionality
            const viewStudentModal = new bootstrap.Modal(document.getElementById('viewStudentModal'));
            const viewButtons = document.querySelectorAll('.view-student-btn');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data from button attributes
                    const studentId = this.getAttribute('data-student-id');
                    const studentName = this.getAttribute('data-name');
                    const studentEmail = this.getAttribute('data-email');
                    const studentClass = this.getAttribute('data-class');
                    const studentGender = this.getAttribute('data-gender');
                    const studentDOB = this.getAttribute('data-dob');
                    const studentPhone = this.getAttribute('data-phone') || 'Not provided';
                    const studentAddress = this.getAttribute('data-address') || 'Not provided';

                    // Populate the view modal
                    document.getElementById('viewStudentId').value = studentId;
                    document.getElementById('viewStudentName').value = studentName;
                    document.getElementById('viewStudentEmail').value = studentEmail;
                    document.getElementById('viewStudentClass').value = studentClass;
                    document.getElementById('viewStudentGender').value = studentGender;
                    document.getElementById('viewStudentDOB').value = studentDOB;
                    document.getElementById('viewStudentPhone').value = studentPhone;
                    document.getElementById('viewStudentAddress').value = studentAddress;

                    // Show the modal
                    viewStudentModal.show();

                    console.log('View student details:', studentId, studentName);
                });
            });

            // Edit Student Modal functionality
            const editStudentModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
            const editStudentForm = document.getElementById('editStudentForm');
            const editButtons = document.querySelectorAll('.edit-student-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data from button attributes
                    const studentId = this.getAttribute('data-student-id');
                    const studentName = this.getAttribute('data-name');
                    const studentEmail = this.getAttribute('data-email');
                    const studentClass = this.getAttribute('data-class');
                    const studentGender = this.getAttribute('data-gender');
                    const studentDOB = this.getAttribute('data-dob');
                    const studentPhone = this.getAttribute('data-phone');
                    const studentAddress = this.getAttribute('data-address');

                    console.log('Edit student data:', {
                        studentId, studentName, studentEmail, studentClass, 
                        studentGender, studentDOB, studentPhone, studentAddress
                    });

                    // Update form action with the correct route
                    editStudentForm.action = `/students/${studentId}`;

                    // Populate the edit form
                    document.getElementById('editStudentId').value = studentId;
                    document.getElementById('editStudentName').value = studentName;
                    document.getElementById('editStudentEmail').value = studentEmail;
                    document.getElementById('editStudentClass').value = studentClass;
                    document.getElementById('editStudentGender').value = studentGender;
                    document.getElementById('editStudentDOB').value = studentDOB;
                    document.getElementById('editStudentPhone').value = studentPhone || '';
                    document.getElementById('editStudentAddress').value = studentAddress || '';

                    // Show the modal
                    editStudentModal.show();
                });
            });

            // Reopen Add Student Modal if there are validation errors
            @if($errors->any())
                const addStudentModal = new bootstrap.Modal(document.getElementById('addStudentModal'));
                addStudentModal.show();
            @endif
        });
    </script>
@endsection
