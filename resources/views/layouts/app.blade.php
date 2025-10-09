<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - I.E.T Government High School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .sidebar .nav-link {
            color: #ffffff;
            font-weight: 600;
            padding: 12px 20px;
            margin: 2px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #ffffff;
            /* font-weight: 700; */
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link:hover::before,
        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.1) 100%);
            border-radius: 8px;
            z-index: -1;
        }

        .sidebar .nav-link i {
            color: #ffffff;
            font-weight: 600;
            margin-right: 8px;
        }

        .sidebar h4,
        .sidebar .text-white {
            color: #ffffff !important;
            font-weight: 700;
        }

        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .card:hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            pointer-events: none;
            z-index: 1;
        }

        .card:hover .card-body,
        .card:hover .card-header {
            position: relative;
            z-index: 2;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats-card-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .stats-card-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .stats-card-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
        }

        /* Compact Styles */
        .table-sm td,
        .table-sm th {
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        /* Custom Table Row Hover Effects */
        .table tbody tr {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .table tbody tr:hover {
            background-color: #93e4d3 !important;
        }

        .table tbody tr:hover td {
            border-color: #dee2e6;
        }

        .card-header {
            padding: 0.75rem 1rem;
        }

        .card-body {
            padding: 1rem;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Profile and Logout Button Hover Effects */
        .btn-toolbar .btn-group button:first-child {
            transition: all 0.3s ease;
        }

        .btn-toolbar .btn-group button:first-child:hover {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: white !important;
            border-color: #10b981 !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-toolbar .btn-group button:last-child {
            transition: all 0.3s ease;
        }

        .btn-toolbar .btn-group button:last-child:hover {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
            color: white !important;
            border-color: #ef4444 !important;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        /* Form Label and Input Spacing */
        .form-group label,
        .form-label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            display: block;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control,
        .form-select {
            margin-top: 0.25rem;
        }

        /* Modal Form Spacing */
        .modal-body .form-group {
            margin-bottom: 1.25rem;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1050;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 767.98px) {
            .mobile-menu-toggle {
                display: block;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                max-width: 300px;
                height: 100vh;
                z-index: 1040;
                transition: left 0.3s ease;
                overflow-y: auto;
            }

            .sidebar.show {
                left: 0;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1030;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-content {
                padding-top: 60px !important;
            }

            .col-md-9.main-content {
                width: 100%;
                margin-left: 0 !important;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .card-body {
                padding: 1rem;
            }

            h1.h2 {
                font-size: 1.5rem;
            }

            .btn-toolbar {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .btn-group {
                margin-bottom: 10px;
            }
        }

        @media (max-width: 575.98px) {
            .stats-card h2 {
                font-size: 1.5rem;
            }

            .card-title {
                font-size: 1rem;
            }

            .table {
                font-size: 0.8rem;
            }

            .badge {
                font-size: 0.7rem;
            }
        }
    </style>
</head>

<body>
    <!-- Mobile Menu Toggle Button -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar" id="sidebar">
                <div class="position-sticky pt-3">
                    <div class="mb-4 text-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="School Logo" class="mb-3" style="width: 90px; height: 90px; object-fit: contain; border-radius: 15px; background: white; padding: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.2);">
                        <h5 class="text-white" style="font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.3); line-height: 1.3; margin-bottom: 5px;">
                            I.E.T Government High School
                        </h5>
                        <small class="text-white" style="font-weight: 600; opacity: 0.95; font-size: 0.85rem;">Management System</small>
                    </div>
                    @yield('sidebar')
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Top Navigation -->
                <div
                    class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
                    <div>
                        <h1 class="h2">@yield('page-title')</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                    <div class="btn-toolbar mb-md-0 mb-2">
                        <div class="btn-group me-2">
                            @if (request()->is('student/*') || request()->is('student'))
                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#profileModal" type="button">
                                    <i class="fas fa-user"></i> Profile
                                </button>
                            @endif
                            <button class="btn btn-sm btn-outline-secondary" type="button">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </div>
                    </div>
                </div>

                @yield('content')

                <!-- Student Profile Modal (Only for Students) -->
                @if (request()->is('student/*') || request()->is('student'))
                    <div class="modal fade" id="profileModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                    <h5 class="modal-title">
                                        <i class="fas fa-user-circle"></i> Student Profile
                                    </h5>
                                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        type="button"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Student ID</label>
                                                    <input class="form-control" type="text" value="STU001" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Roll Number</label>
                                                    <input class="form-control" type="text" value="101" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Full Name</label>
                                                    <input class="form-control" type="text" value="Md. Abdul Karim"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Email</label>
                                                    <input class="form-control" type="email"
                                                        value="karim@school.edu.bd" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Phone Number</label>
                                                    <input class="form-control" type="text" value="+880 1712-345678"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Class</label>
                                                    <input class="form-control" type="text" value="Class 8A"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Gender</label>
                                                    <input class="form-control" type="text" value="Male" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Date of Birth</label>
                                                    <input class="form-control" type="text"
                                                        value="15 January 2010" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Blood Group</label>
                                                    <input class="form-control" type="text" value="A+"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Address</label>
                                                    <textarea class="form-control" rows="2" readonly>123 Main Road, Dhaka-1205, Bangladesh</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Guardian Name</label>
                                                    <input class="form-control" type="text" value="Md. Rahman"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold">Guardian Phone</label>
                                                    <input class="form-control" type="text"
                                                        value="+880 1912-345678" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Info Message -->
                                        <div class="alert alert-info mb-0 mt-3" role="alert">
                                            <i class="fas fa-info-circle"></i>
                                            <strong>Note:</strong> To change your student information, please contact
                                            the
                                            school administration.
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal"
                                        type="button">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Toggle sidebar
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });

            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });

            // Close sidebar when clicking a nav link (mobile only)
            if (window.innerWidth < 768) {
                const navLinks = sidebar.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    });
                });
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
