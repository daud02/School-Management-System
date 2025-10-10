@extends('layouts.app')

@section('title', 'Marks Management')
@section('page-title', 'Marks Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Marks</li>
@endsection

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.students') }}">
                <i class="fas fa-users"></i> Students
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.classes') }}">
                <i class="fas fa-school"></i> Classes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.marks') }}">
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
    <!-- Marks Overview Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-trophy text-warning"></i>
                    </div>
                    <h3 class="mb-0">{{ collect($marks)->where('grade', 'A+')->count() }}</h3>
                    <p class="mb-0">A+ Grades</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-2">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-chart-line text-success"></i>
                    </div>
                    <h3 class="mb-0">{{ number_format(collect($marks)->avg('marks'), 1) }}%</h3>
                    <p class="mb-0">Average Score</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-3">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-graduation-cap text-primary"></i>
                    </div>
                    <h3 class="mb-0">{{ collect($marks)->where('marks', '>=', 80)->count() }}</h3>
                    <p class="mb-0">High Performers</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card-4">
                <div class="card-body text-center">
                    <div class="display-4 mb-2">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                    </div>
                    <h3 class="mb-0">{{ collect($marks)->where('marks', '<', 50)->count() }}</h3>
                    <p class="mb-0">Need Support</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-filter"></i> Filter Marks
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
                        <label for="subjectFilter">Filter by Subject</label>
                        <select class="form-control" id="subjectFilter">
                            <option value="">All Subjects</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="English">English</option>
                            <option value="Science">Science</option>
                            <option value="Social Studies">Social Studies</option>
                            <option value="Computer Science">Computer Science</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="gradeFilter">Filter by Grade</label>
                        <select class="form-control" id="gradeFilter">
                            <option value="">All Grades</option>
                            <option value="A+">A+</option>
                            <option value="A">A</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="searchStudent">Search Student</label>
                        <input type="text" class="form-control" id="searchStudent" placeholder="Search by name...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Marks Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-table"></i> Student Marks
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="marksTable">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Marks</th>
                            <th>Grade</th>
                            <th>Exam Type</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marks as $mark)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/30x30/007bff/ffffff?text={{ strtoupper(substr($mark['student_name'], 0, 1)) }}" 
                                         class="rounded-circle me-2" alt="Student" width="30" height="30">
                                    <strong>{{ $mark['student_name'] }}</strong>
                                </div>
                            </td>
                            <td>{{ $mark['class'] }}</td>
                            <td>
                                <span class="badge bg-info">{{ $mark['subject'] }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress me-2" style="width: 60px; height: 8px;">
                                        <div class="progress-bar bg-{{ $mark['marks'] >= 80 ? 'success' : ($mark['marks'] >= 60 ? 'warning' : 'danger') }}" 
                                             style="width: {{ $mark['marks'] }}%"></div>
                                    </div>
                                    <strong>{{ $mark['marks'] }}%</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ 
                                    $mark['grade'] == 'A+' ? 'success' : (
                                    $mark['grade'] == 'A' ? 'primary' : (
                                    $mark['grade'] == 'B+' || $mark['grade'] == 'B' ? 'warning' : (
                                    $mark['grade'] == 'C' ? 'info' : 'danger'))) }}">
                                    {{ $mark['grade'] }}
                                </span>
                            </td>
                            <td>{{ $mark['exam_type'] }}</td>
                            <td>{{ $mark['date'] }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" title="Edit Marks">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-success" title="Print Result">
                                        <i class="fas fa-print"></i>
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

    <!-- Subject Performance Analysis -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar"></i> Subject Performance
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $subjects = ['Mathematics', 'English', 'Science', 'Social Studies', 'Computer Science'];
                    @endphp
                    @foreach($subjects as $subject)
                        @php
                            $subjectMarks = collect($marks)->where('subject', $subject);
                            $average = $subjectMarks->avg('marks');
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>{{ $subject }}</span>
                                <span>{{ number_format($average, 1) }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-{{ $average >= 80 ? 'success' : ($average >= 60 ? 'warning' : 'danger') }}" 
                                     style="width: {{ $average }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie"></i> Grade Distribution
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $gradeDistribution = collect($marks)->countBy('grade');
                    @endphp
                    @foreach(['A+', 'A', 'B+', 'B', 'C', 'F'] as $grade)
                        @php
                            $count = $gradeDistribution->get($grade, 0);
                            $percentage = count($marks) > 0 ? ($count / count($marks)) * 100 : 0;
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-{{ 
                                    $grade == 'A+' ? 'success' : (
                                    $grade == 'A' ? 'primary' : (
                                    $grade == 'B+' || $grade == 'B' ? 'warning' : (
                                    $grade == 'C' ? 'info' : 'danger'))) }}">
                                    Grade {{ $grade }}
                                </span>
                                <span>{{ $count }} ({{ number_format($percentage, 1) }}%)</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-{{ 
                                    $grade == 'A+' ? 'success' : (
                                    $grade == 'A' ? 'primary' : (
                                    $grade == 'B+' || $grade == 'B' ? 'warning' : (
                                    $grade == 'C' ? 'info' : 'danger'))) }}" 
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#addMarksModal">
                                <i class="fas fa-plus"></i><br>Add Marks
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success w-100 mb-2">
                                <i class="fas fa-file-excel"></i><br>Export Results
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-warning w-100 mb-2">
                                <i class="fas fa-print"></i><br>Print Reports
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-info w-100 mb-2">
                                <i class="fas fa-chart-line"></i><br>Analytics
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('marksTable');
    const searchInput = document.getElementById('searchStudent');
    const classFilter = document.getElementById('classFilter');
    const subjectFilter = document.getElementById('subjectFilter');
    const gradeFilter = document.getElementById('gradeFilter');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedClass = classFilter.value;
        const selectedSubject = subjectFilter.value;
        const selectedGrade = gradeFilter.value;
        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {
            const studentName = row.children[0].textContent.toLowerCase();
            const studentClass = row.children[1].textContent;
            const subject = row.children[2].textContent.trim();
            const grade = row.children[4].textContent.trim();
            
            const matchesSearch = studentName.includes(searchTerm);
            const matchesClass = !selectedClass || studentClass === selectedClass;
            const matchesSubject = !selectedSubject || subject.includes(selectedSubject);
            const matchesGrade = !selectedGrade || grade.includes(selectedGrade);
            
            if (matchesSearch && matchesClass && matchesSubject && matchesGrade) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    classFilter.addEventListener('change', filterTable);
    subjectFilter.addEventListener('change', filterTable);
    gradeFilter.addEventListener('change', filterTable);
});
</script>
@endpush