<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: white;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .role-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .role-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .admin-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .student-card {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: white;
        }

        .hero-section {
            text-align: center;
            color: #333;
            padding: 1.5rem 0;
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 767.98px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .hero-section {
                padding: 1rem 0;
            }

            .role-icon {
                font-size: 2rem;
            }

            .card-body {
                padding: 2rem !important;
            }

            .features small {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 1.4rem;
            }

            .hero-subtitle {
                font-size: 0.8rem;
            }

            .role-icon {
                font-size: 1.8rem;
                margin-bottom: 0.5rem;
            }

            .card-title {
                font-size: 1.1rem;
            }

            .card-text {
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <div class="container px-3">
        <div class="hero-section">
            <h1 class="hero-title">
                <i class="fas fa-graduation-cap"></i>
                School Management System
            </h1>
            <p class="hero-subtitle">
                Simple and efficient school administration platform
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row g-4">
                    <!-- Admin Card -->
                    <div class="col-md-6">
                        <a class="text-decoration-none" href="{{ route('admin.login') }}">
                            <div class="card role-card admin-card">
                                <div class="card-body p-3 text-center">
                                    <div class="role-icon">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <h4 class="card-title mb-2">Admin Panel</h4>
                                    <p class="card-text mb-3">
                                        Manage students, classes, and academic records
                                    </p>
                                    <div class="features">
                                        <small class="d-block"><i class="fas fa-check me-1"></i>Student
                                            Management</small>
                                        <small class="d-block"><i class="fas fa-check me-1"></i>Class Management</small>
                                        <small class="d-block"><i class="fas fa-check me-1"></i>Attendance &
                                            Marks</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Student Card -->
                    <div class="col-md-6">
                        <a class="text-decoration-none" href="{{ route('student.login') }}">
                            <div class="card role-card student-card">
                                <div class="card-body p-3 text-center">
                                    <div class="role-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <h4 class="card-title mb-2">Student Portal</h4>
                                    <p class="card-text mb-3">
                                        View routine, marks, and attendance records
                                    </p>
                                    <div class="features">
                                        <small class="d-block"><i class="fas fa-check me-1"></i>Class Routine</small>
                                        <small class="d-block"><i class="fas fa-check me-1"></i>Exam Results</small>
                                        <small class="d-block"><i class="fas fa-check me-1"></i>Attendance
                                            Status</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card"
                            style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 15px;">
                            <div class="card-body text-dark p-3 text-center">
                                <h5 class="mb-3">Core Features</h5>
                                <div class="row">
                                    <div class="col-md-3 col-6 mb-2">
                                        <i class="fas fa-users fa-lg mb-1"></i>
                                        <p class="small mb-0">Student Records</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2">
                                        <i class="fas fa-school fa-lg mb-1"></i>
                                        <p class="small mb-0">Class Management</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2">
                                        <i class="fas fa-chart-line fa-lg mb-1"></i>
                                        <p class="small mb-0">Academic Tracking</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2">
                                        <i class="fas fa-calendar-check fa-lg mb-1"></i>
                                        <p class="small mb-0">Attendance System</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>