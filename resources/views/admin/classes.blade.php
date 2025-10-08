@extends('layouts.app')

@section('title',
    'Class </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table-hover table-sm table">anagement')
            @section('page-title', 'Classes Management')

            @section('breadcrumb')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Classes</li>
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
                        <a class="nav-link active" href="{{ route('admin.classes') }}">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center py-2">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-school"></i> All Classes
                                </h6>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addClassModal">
                                    <i class="fas fa-plus"></i> Add New Class
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Class Name</th>
                                                <th>Section</th>
                                                <th>Students</th>
                                                <th>Class Teacher</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $class)
                                                <tr>
                                                    <td>{{ $class['id'] }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-primary me-2">
                                                                <i class="fas fa-graduation-cap"></i>
                                                            </div>
                                                            <div class="fw-bold">{{ $class['name'] }}</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info">Section {{ $class['section'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success">{{ $class['students'] }}
                                                            Students</span>
                                                    </td>
                                                    <td>{{ $class['teacher'] }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-warning edit-class-btn"
                                                                data-id="{{ $class['id'] }}"
                                                                data-name="{{ $class['name'] }}"
                                                                data-section="{{ $class['section'] }}"
                                                                data-students="{{ $class['students'] }}"
                                                                data-teacher="{{ $class['teacher'] }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger">
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
                    </div>
                </div>

                <!-- Add New Class Modal -->
                <div class="modal fade" id="addClassModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Class</h5>
                                <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="addClassId">Class ID</label>
                                                <input class="form-control" id="addClassId" type="text"
                                                    placeholder="CLS001" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label for="addClassName">Class Name</label>
                                                <input class="form-control" id="addClassName" type="text"
                                                    placeholder="Class 6" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="addClassSection">Section</label>
                                                <select class="form-control" id="addClassSection" required>
                                                    <option value="">Select Section</option>
                                                    <option value="A">Section A</option>
                                                    <option value="B">Section B</option>
                                                    <option value="C">Section C</option>
                                                    <option value="D">Section D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="addClassStudents">Number of Students</label>
                                                <input class="form-control" id="addClassStudents" type="number"
                                                    min="0" placeholder="0" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="addClassTeacher">Class Teacher</label>
                                                <input class="form-control" id="addClassTeacher" type="text"
                                                    placeholder="Teacher Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="btn btn-primary" id="saveClassBtn" type="button">
                                    <i class="fas fa-save"></i> Save Class
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Class Modal -->
                <div class="modal fade" id="editClassModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Class Information</h5>
                                <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="editClassId">Class ID</label>
                                                <input class="form-control" id="editClassId" type="text"
                                                    placeholder="CLS001" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label for="editClassName">Class Name</label>
                                                <input class="form-control" id="editClassName" type="text"
                                                    placeholder="Class 6" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="editClassSection">Section</label>
                                                <select class="form-control" id="editClassSection" required>
                                                    <option value="">Select Section</option>
                                                    <option value="A">Section A</option>
                                                    <option value="B">Section B</option>
                                                    <option value="C">Section C</option>
                                                    <option value="D">Section D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="editClassStudents">Number of Students</label>
                                                <input class="form-control" id="editClassStudents" type="number"
                                                    min="0" placeholder="0" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="editClassTeacher">Class Teacher</label>
                                                <input class="form-control" id="editClassTeacher" type="text"
                                                    placeholder="Teacher Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="btn btn-warning" id="updateClassBtn" type="button">
                                    <i class="fas fa-save"></i> Update Class
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection

            @section('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Add New Class Modal functionality
                        const addClassModal = new bootstrap.Modal(document.getElementById('addClassModal'));
                        const saveClassBtn = document.getElementById('saveClassBtn');

                        if (saveClassBtn) {
                            saveClassBtn.addEventListener('click', function() {
                                const classId = document.getElementById('addClassId').value;
                                const className = document.getElementById('addClassName').value;
                                const classSection = document.getElementById('addClassSection').value;
                                const classStudents = document.getElementById('addClassStudents').value;
                                const classTeacher = document.getElementById('addClassTeacher').value;

                                // Validation
                                if (!classId || !className || !classSection || !classStudents || !classTeacher) {
                                    alert('Please fill in all fields!');
                                    return;
                                }

                                console.log('Adding new class:', {
                                    id: classId,
                                    name: className,
                                    section: classSection,
                                    students: classStudents,
                                    teacher: classTeacher
                                });

                                // Here you would typically send an AJAX request to save the class
                                // For now, we'll just show an alert
                                alert('New class added successfully!\n\nID: ' + classId + '\nName: ' +
                                    className + '\nSection: ' + classSection);

                                // Clear the form
                                document.getElementById('addClassId').value = '';
                                document.getElementById('addClassName').value = '';
                                document.getElementById('addClassSection').value = '';
                                document.getElementById('addClassStudents').value = '';
                                document.getElementById('addClassTeacher').value = '';

                                // Close the modal
                                addClassModal.hide();
                            });
                        }

                        // Edit Class Modal functionality
                        const editClassModal = new bootstrap.Modal(document.getElementById('editClassModal'));
                        const editButtons = document.querySelectorAll('.edit-class-btn');

                        editButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                // Get data from button attributes
                                const classId = this.getAttribute('data-id');
                                const className = this.getAttribute('data-name');
                                const classSection = this.getAttribute('data-section');
                                const classStudents = this.getAttribute('data-students');
                                const classTeacher = this.getAttribute('data-teacher');

                                // Populate the edit form
                                document.getElementById('editClassId').value = classId;
                                document.getElementById('editClassName').value = className;
                                document.getElementById('editClassSection').value = classSection;
                                document.getElementById('editClassStudents').value = classStudents;
                                document.getElementById('editClassTeacher').value = classTeacher;

                                // Show the modal
                                editClassModal.show();

                                console.log('Edit class:', classId, className);
                            });
                        });

                        // Handle Update Class button click
                        const updateClassBtn = document.getElementById('updateClassBtn');
                        if (updateClassBtn) {
                            updateClassBtn.addEventListener('click', function() {
                                const classId = document.getElementById('editClassId').value;
                                const className = document.getElementById('editClassName').value;
                                const classSection = document.getElementById('editClassSection').value;
                                const classStudents = document.getElementById('editClassStudents').value;
                                const classTeacher = document.getElementById('editClassTeacher').value;

                                console.log('Updating class:', {
                                    id: classId,
                                    name: className,
                                    section: classSection,
                                    students: classStudents,
                                    teacher: classTeacher
                                });

                                // Here you would typically send an AJAX request to update the class
                                // For now, we'll just show an alert
                                alert('Class information updated successfully!\n\nID: ' + classId + '\nName: ' +
                                    className + '\nSection: ' + classSection);

                                // Close the modal
                                editClassModal.hide();
                            });
                        }
                    });
                </script>
            @endsection
