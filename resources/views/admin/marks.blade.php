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
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Marks Overview Stats -->
    <div class="row mb-2">
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-trophy text-warning" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ collect($marks)->where('grade', 'A+')->count() }}</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">A+ Grades</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-2">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-chart-line text-success" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ number_format(collect($marks)->avg('marks'), 1) }}%</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">Average Score</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-3">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-graduation-cap text-primary" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ collect($marks)->where('marks', '>=', 80)->count() }}</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">High Performers</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <div class="card stats-card-4">
                <div class="card-body p-1 text-center">
                    <i class="fas fa-exclamation-triangle text-danger" style="font-size: 1.2rem;"></i>
                    <h6 class="mb-0 mt-1">{{ collect($marks)->where('marks', '<', 50)->count() }}</h6>
                    <small class="mb-0" style="font-size: 0.8rem;">Need Support</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-header py-2">
            <h6 class="card-title mb-0">
                <i class="fas fa-filter"></i> Filter Marks
            </h6>
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
                        <input class="form-control" id="searchStudent" type="text" placeholder="Search by name...">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMarksModal">
                        <i class="fas fa-plus"></i> Add Marks
                    </button>
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
                <table class="table-striped table-hover table" id="marksTable">
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
                        @foreach ($marks as $mark)
                            <tr>
                                <td>
                                    <strong>{{ $mark['student_id'] }}</strong>
                                    @if(!empty($mark['student_name']))
                                        <br>
                                        <small class="text-muted">{{ $mark['student_name'] }}</small>
                                    @endif
                                </td>
                                <td>{{ $mark['class'] }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $mark['subject'] }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            @php
                                                $progressColor =
                                                    $mark['marks'] >= 80
                                                        ? 'success'
                                                        : ($mark['marks'] >= 60
                                                            ? 'warning'
                                                            : 'danger');
                                            @endphp
                                            <div class="progress-bar bg-{{ $progressColor }}"
                                                style="width: {{ $mark['marks'] }}%"></div>
                                        </div>
                                        <strong>{{ $mark['marks'] }}%</strong>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $badgeColor = 'danger'; // default
                                        if ($mark['grade'] == 'A+') {
                                            $badgeColor = 'success';
                                        } elseif ($mark['grade'] == 'A') {
                                            $badgeColor = 'primary';
                                        } elseif ($mark['grade'] == 'B+' || $mark['grade'] == 'B') {
                                            $badgeColor = 'warning';
                                        } elseif ($mark['grade'] == 'C') {
                                            $badgeColor = 'info';
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $badgeColor }}">
                                        {{ $mark['grade'] }}
                                    </span>
                                </td>
                                <td>{{ $mark['exam_type'] }}</td>
                                @php
                                    try {
                                        $inputDate = $mark['date'] ? \Carbon\Carbon::parse($mark['date'])->format('Y-m-d') : '';
                                        $displayDate = $mark['date'] ? \Carbon\Carbon::parse($mark['date'])->format('M d, Y') : '';
                                    } catch (\Exception $e) {
                                        $inputDate = '';
                                        $displayDate = $mark['date'] ?? '';
                                    }
                                @endphp
                                <td>{{ $displayDate }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-warning edit-mark-btn"
                                            data-id="{{ $mark['id'] }}"
                                            data-student-id="{{ $mark['student_id'] }}" data-class="{{ $mark['class'] }}"
                                            data-subject="{{ $mark['subject'] }}" data-marks="{{ $mark['marks'] }}"
                                            data-grade="{{ $mark['grade'] }}" data-exam-type="{{ $mark['exam_type'] }}"
                                            data-date="{{ $inputDate }}" type="button" title="Edit Marks">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('marks.destroy', $mark['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this mark?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit" title="Delete">
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
                    @foreach ($subjects as $subject)
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
                                @php
                                    $progressColor =
                                        $average >= 80 ? 'success' : ($average >= 60 ? 'warning' : 'danger');
                                @endphp
                                <div class="progress-bar bg-{{ $progressColor }}" style="width: {{ $average }}%">
                                </div>
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
                    @foreach (['A+', 'A', 'B+', 'B', 'C', 'F'] as $grade)
                        @php
                            $count = $gradeDistribution->get($grade, 0);
                            $percentage = count($marks) > 0 ? ($count / count($marks)) * 100 : 0;
                        @endphp
                        <div class="mb-3">
                            @php
                                $badgeColor = 'danger'; // default
                                if ($grade == 'A+') {
                                    $badgeColor = 'success';
                                } elseif ($grade == 'A') {
                                    $badgeColor = 'primary';
                                } elseif ($grade == 'B+' || $grade == 'B') {
                                    $badgeColor = 'warning';
                                } elseif ($grade == 'C') {
                                    $badgeColor = 'info';
                                }
                            @endphp
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-{{ $badgeColor }}">
                                    Grade {{ $grade }}
                                </span>
                                <span>{{ $count }} ({{ number_format($percentage, 1) }}%)</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-{{ $badgeColor }}" style="width: {{ $percentage }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Marks Modal -->
    <div class="modal fade" id="editMarksModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Marks Information</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form id="editMarksForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editStudentId">Student ID</label>
                                    <input class="form-control" id="editStudentId" name="student_id" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editClass">Class</label>
                                    <select class="form-control" id="editClass" name="class" required>
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editSubject">Subject</label>
                                    <select class="form-control" id="editSubject" name="subject" required>
                                        <option value="">Select Subject</option>
                                        <option value="Mathematics">Mathematics</option>
                                        <option value="English">English</option>
                                        <option value="Science">Science</option>
                                        <option value="Social Studies">Social Studies</option>
                                        <option value="Computer Science">Computer Science</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editExamType">Exam Type</label>
                                    <select class="form-control" id="editExamType" name="exam_type" required>
                                        <option value="">Select Exam Type</option>
                                        <option value="Mid Term">Mid Term</option>
                                        <option value="Final Term">Final Term</option>
                                        <option value="Class Test">Class Test</option>
                                        <option value="Assignment">Assignment</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editMarks">Marks (%)</label>
                                    <input class="form-control" id="editMarks" name="marks" type="number" min="0"
                                        max="100" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editGrade">Grade</label>
                                    <select class="form-control" id="editGrade" name="grade" required>
                                        <option value="">Select Grade</option>
                                        <option value="A+">A+</option>
                                        <option value="A">A</option>
                                        <option value="B+">B+</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="editDate">Exam Date</label>
                                    <input class="form-control" id="editDate" name="date" type="date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        <button class="btn btn-warning" type="submit">
                            <i class="fas fa-save"></i> Update Marks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Marks Modal -->
    <div class="modal fade" id="addMarksModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Marks</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <form action="{{ route('marks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="addStudentId">Student ID</label>
                                    <input class="form-control" id="addStudentId" name="student_id" type="text"
                                        placeholder="Enter student id (e.g. STU-1001)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="addClass">Class</label>
                                    <select class="form-control" id="addClass" name="class" required>
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="addSubject">Subject</label>
                                    <select class="form-control" id="addSubject" name="subject" required>
                                        <option value="">Select Subject</option>
                                        <option value="Mathematics">Mathematics</option>
                                        <option value="English">English</option>
                                        <option value="Science">Science</option>
                                        <option value="Social Studies">Social Studies</option>
                                        <option value="Computer Science">Computer Science</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="addExamType">Exam Type</label>
                                    <select class="form-control" id="addExamType" name="exam_type" required>
                                        <option value="">Select Exam Type</option>
                                        <option value="Mid Term">Mid Term</option>
                                        <option value="Final Term">Final Term</option>
                                        <option value="Class Test">Class Test</option>
                                        <option value="Assignment">Assignment</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="addMarks">Marks (%)</label>
                                    <input class="form-control" id="addMarks" name="marks" type="number" min="0"
                                        max="100" placeholder="Enter marks" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="addGrade">Grade</label>
                                    <select class="form-control" id="addGrade" name="grade" required>
                                        <option value="">Select Grade</option>
                                        <option value="A+">A+</option>
                                        <option value="A">A</option>
                                        <option value="B+">B+</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="addDate">Exam Date</label>
                                    <input class="form-control" id="addDate" name="date" type="date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-plus"></i> Add Marks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('marksTable');
            const searchInput = document.getElementById('searchStudent');
            const classFilter = document.getElementById('classFilter');
            const subjectFilter = document.getElementById('subjectFilter');
            const gradeFilter = document.getElementById('gradeFilter');

            console.log('Marks filter script loaded!');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedClass = classFilter.value.trim();
                const selectedSubject = subjectFilter.value.trim();
                const selectedGrade = gradeFilter.value.trim();

                console.log('Filtering marks - Search:', searchTerm, 'Class:', selectedClass, 'Subject:',
                    selectedSubject, 'Grade:', selectedGrade);

                const tbody = table.querySelector('tbody');
                const rows = tbody.querySelectorAll('tr');
                let visibleCount = 0;

                rows.forEach((row, index) => {
                    // Table columns: Student(0), Class(1), Subject(2), Marks(3), Grade(4), Exam Type(5), Date(6), Actions(7)
                    const cells = row.querySelectorAll('td');

                    if (cells.length >= 5) {
                        // Get student name from column 0 (inside the div with image)
                        const studentNameElement = cells[0].querySelector('strong');
                        const studentName = studentNameElement ? studentNameElement.textContent
                            .toLowerCase().trim() : '';

                        // Get class from column 1
                        const studentClass = cells[1].textContent.trim();

                        // Get subject from column 2 (inside badge)
                        const subjectBadge = cells[2].querySelector('.badge');
                        const subject = subjectBadge ? subjectBadge.textContent.trim() : cells[2]
                            .textContent.trim();

                        // Get grade from column 4 (inside badge)
                        const gradeBadge = cells[4].querySelector('.badge');
                        const grade = gradeBadge ? gradeBadge.textContent.trim() : cells[4].textContent
                            .trim();

                        console.log(`Row ${index + 1}:`, {
                            name: studentName,
                            class: studentClass,
                            subject: subject,
                            grade: grade
                        });

                        // Apply filter logic
                        let showRow = true;

                        // Search filter (name contains search term)
                        if (searchTerm && !studentName.includes(searchTerm)) {
                            showRow = false;
                        }

                        // Class filter (exact match)
                        if (selectedClass && selectedClass !== '' && studentClass !== selectedClass) {
                            showRow = false;
                        }

                        // Subject filter (exact match)
                        if (selectedSubject && selectedSubject !== '' && subject !== selectedSubject) {
                            showRow = false;
                        }

                        // Grade filter (exact match)
                        if (selectedGrade && selectedGrade !== '' && grade !== selectedGrade) {
                            showRow = false;
                        }

                        // Show/hide row
                        if (showRow) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                console.log('Total visible marks rows:', visibleCount);
            }

            // Add event listeners for real-time filtering
            searchInput.addEventListener('input', filterTable);
            classFilter.addEventListener('change', filterTable);
            subjectFilter.addEventListener('change', filterTable);
            gradeFilter.addEventListener('change', filterTable);

            // Edit Marks Modal functionality
            const editMarksModal = new bootstrap.Modal(document.getElementById('editMarksModal'));
            const editMarksForm = document.getElementById('editMarksForm');
            const editButtons = document.querySelectorAll('.edit-mark-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data from button attributes
                    const markId = this.getAttribute('data-id');
                    const studentId = this.getAttribute('data-student-id');
                    const studentClass = this.getAttribute('data-class');
                    const subject = this.getAttribute('data-subject');
                    const marks = this.getAttribute('data-marks');
                    const grade = this.getAttribute('data-grade');
                    const examType = this.getAttribute('data-exam-type');
                    const date = this.getAttribute('data-date');

                    // Update form action with the correct route
                    editMarksForm.action = `/marks/${markId}`;

                    // Populate the edit form
                    document.getElementById('editStudentId').value = studentId;
                    document.getElementById('editClass').value = studentClass;
                    document.getElementById('editSubject').value = subject;
                    document.getElementById('editMarks').value = marks;
                    document.getElementById('editGrade').value = grade;
                    document.getElementById('editExamType').value = examType;
                    document.getElementById('editDate').value = date;

                    // Show the modal
                    editMarksModal.show();

                    console.log('Edit marks:', studentId, subject, markId);
                });
            });
        });
    </script>
@endsection
