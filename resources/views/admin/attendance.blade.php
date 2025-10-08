@extends('layouts.app')

@section('title', 'Attendance Management')
@section('page-title', 'Attendance Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Attendance</li>
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
            <a class="nav-link" href="{{ route('admin.marks') }}">
                <i class="fas fa-chart-line"></i> Marks
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.attendance') }}">
                <i class="fas fa-calendar-check"></i> Attendance
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <!-- Class Selection Section -->
    <div id="classSelection">
        <div class="row mb-2">
            <div class="col-md-12">
                <h6 class="mb-2"><i class="fas fa-chalkboard-teacher"></i> Select a Class</h6>
            </div>
        </div>
        <div class="row">
            @php
                $classes = [
                    [
                        'id' => 1,
                        'name' => 'Class 1 - Section A',
                        'students' => 32,
                        'icon' => 'fa-book',
                        'color' => '#667eea',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Class 1 - Section B',
                        'students' => 30,
                        'icon' => 'fa-book',
                        'color' => '#764ba2',
                    ],
                    [
                        'id' => 3,
                        'name' => 'Class 2 - Section A',
                        'students' => 28,
                        'icon' => 'fa-graduation-cap',
                        'color' => '#f093fb',
                    ],
                    [
                        'id' => 4,
                        'name' => 'Class 2 - Section B',
                        'students' => 31,
                        'icon' => 'fa-graduation-cap',
                        'color' => '#4facfe',
                    ],
                    [
                        'id' => 5,
                        'name' => 'Class 3 - Section A',
                        'students' => 29,
                        'icon' => 'fa-user-graduate',
                        'color' => '#43e97b',
                    ],
                    [
                        'id' => 6,
                        'name' => 'Class 3 - Section B',
                        'students' => 33,
                        'icon' => 'fa-user-graduate',
                        'color' => '#fa709a',
                    ],
                ];
            @endphp

            @foreach ($classes as $class)
                <div class="col-md-4 mb-2">
                    <div class="card class-card" style="cursor: pointer;"
                        onclick="selectClass({{ $class['id'] }}, '{{ $class['name'] }}')">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3"
                                    style="background: {{ $class['color'] }}; width: 50px; height: 50px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas {{ $class['icon'] }} text-white" style="font-size: 1.3rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1" style="font-size: 0.95rem;">{{ $class['name'] }}</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem;">
                                        <i class="fas fa-users"></i> {{ $class['students'] }} Students
                                    </p>
                                </div>
                                <div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Attendance Marking Section (Hidden by default) -->
    <div id="attendanceSection" style="display: none;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-2">
                <h6 class="card-title mb-0">
                    <i class="fas fa-calendar-check"></i> Mark Attendance - <span id="selectedClassName"></span>
                </h6>
                <button class="btn btn-secondary btn-sm" onclick="backToClassSelection()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>
            <div class="card-body p-1">
                <div class="bg-light mb-2 rounded p-2">
                    <div class="row">
                        <div class="col-md-6">
                            <small><strong>Date:</strong> {{ date('F d, Y') }}</small>
                        </div>
                        <div class="col-md-6 text-end">
                            <small><strong>Total Students:</strong> <span id="totalStudents">0</span></small>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table-striped table-sm mb-0 table">
                        <thead>
                            <tr>
                                <th style="width: 10%;">Roll</th>
                                <th style="width: 40%;">Student Name</th>
                                <th style="width: 50%;">Mark Attendance</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceTableBody">
                            <!-- Will be populated dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="border-top d-flex justify-content-between align-items-center mt-2 p-2">
                    <div>
                        <span class="badge bg-success me-2">Present: <span id="presentCount">0</span></span>
                        <span class="badge bg-danger">Absent: <span id="absentCount">0</span></span>
                    </div>
                    <button class="btn btn-primary btn-sm" onclick="saveAttendance()">
                        <i class="fas fa-save"></i> Save Attendance
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .class-card {
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
        }

        .class-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
        }

        .status-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .status-btn.active {
            font-weight: bold;
        }
    </style>

    <script>
        // Sample student data for different classes
        const classStudents = {
            1: [{
                    roll: '001',
                    name: 'Ahmed Hassan'
                },
                {
                    roll: '002',
                    name: 'Fatima Rahman'
                },
                {
                    roll: '003',
                    name: 'Mohammad Ali'
                },
                {
                    roll: '004',
                    name: 'Ayesha Khan'
                },
                {
                    roll: '005',
                    name: 'Karim Ahmed'
                }
            ],
            2: [{
                    roll: '001',
                    name: 'Sara Begum'
                },
                {
                    roll: '002',
                    name: 'Omar Farooq'
                },
                {
                    roll: '003',
                    name: 'Zara Malik'
                },
                {
                    roll: '004',
                    name: 'Hassan Ibrahim'
                }
            ],
            3: [{
                    roll: '001',
                    name: 'Noor Hossain'
                },
                {
                    roll: '002',
                    name: 'Aisha Siddiqui'
                },
                {
                    roll: '003',
                    name: 'Rashid Khan'
                },
                {
                    roll: '004',
                    name: 'Maryam Ali'
                },
                {
                    roll: '005',
                    name: 'Tariq Rahman'
                },
                {
                    roll: '006',
                    name: 'Layla Ahmed'
                }
            ],
            4: [{
                    roll: '001',
                    name: 'Ibrahim Khalil'
                },
                {
                    roll: '002',
                    name: 'Khadija Nasir'
                },
                {
                    roll: '003',
                    name: 'Yusuf Mahmood'
                }
            ],
            5: [{
                    roll: '001',
                    name: 'Amina Chowdhury'
                },
                {
                    roll: '002',
                    name: 'Bilal Hussain'
                },
                {
                    roll: '003',
                    name: 'Hiba Karim'
                },
                {
                    roll: '004',
                    name: 'Salman Akhtar'
                }
            ],
            6: [{
                    roll: '001',
                    name: 'Rukhsar Sultana'
                },
                {
                    roll: '002',
                    name: 'Imran Patel'
                },
                {
                    roll: '003',
                    name: 'Nadia Aziz'
                },
                {
                    roll: '004',
                    name: 'Fahad Malik'
                },
                {
                    roll: '005',
                    name: 'Sana Qureshi'
                }
            ]
        };

        let currentClassId = null;
        let attendanceData = {};

        function selectClass(classId, className) {
            currentClassId = classId;
            document.getElementById('selectedClassName').textContent = className;
            document.getElementById('classSelection').style.display = 'none';
            document.getElementById('attendanceSection').style.display = 'block';

            // Load students for this class
            loadStudents(classId);
        }

        function backToClassSelection() {
            document.getElementById('classSelection').style.display = 'block';
            document.getElementById('attendanceSection').style.display = 'none';
            currentClassId = null;
            attendanceData = {};
        }

        function loadStudents(classId) {
            const students = classStudents[classId] || [];
            const tbody = document.getElementById('attendanceTableBody');
            tbody.innerHTML = '';

            document.getElementById('totalStudents').textContent = students.length;

            // Initialize attendance as Present for all students
            students.forEach(student => {
                attendanceData[student.roll] = 'Present';

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><strong>${student.roll}</strong></td>
                    <td><i class="fas fa-user text-info me-2"></i>${student.name}</td>
                    <td>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status-${student.roll}" 
                                       id="present-${student.roll}" value="Present" checked 
                                       onclick="setStatus('${student.roll}', 'Present')">
                                <label class="form-check-label" for="present-${student.roll}" style="cursor: pointer;">
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Present
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status-${student.roll}" 
                                       id="absent-${student.roll}" value="Absent" 
                                       onclick="setStatus('${student.roll}', 'Absent')">
                                <label class="form-check-label" for="absent-${student.roll}" style="cursor: pointer;">
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times"></i> Absent
                                    </span>
                                </label>
                            </div>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            updateCounts();
        }

        function setStatus(roll, status) {
            // Update attendance data
            attendanceData[roll] = status;

            // Update counts
            updateCounts();
        }

        function updateCounts() {
            let present = 0,
                absent = 0;

            Object.values(attendanceData).forEach(status => {
                if (status === 'Present') present++;
                else if (status === 'Absent') absent++;
            });

            document.getElementById('presentCount').textContent = present;
            document.getElementById('absentCount').textContent = absent;
        }

        function saveAttendance() {
            if (!currentClassId) {
                alert('No class selected!');
                return;
            }

            console.log('Saving attendance for class:', currentClassId);
            console.log('Attendance data:', attendanceData);

            // Show success message
            alert('Attendance saved successfully!');

            // Go back to class selection
            backToClassSelection();
        }
    </script>
@endsection
