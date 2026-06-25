<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lourdes Academy - Attendance Dashboard</title>
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Loader -->
    <?php include 'components/loader.php'; ?>

    <!-- Sidebar Backdrop (mobile) -->
    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

    <!-- ===== TOP NAVBAR ===== -->
    <?php include 'components/navbar.php'; ?>

    <!-- ===== SIDEBAR ===== -->
    <?php include 'components/sidebar.php'; ?>

    <!-- ===== MAIN CONTENT ===== -->
    <main id="main" class="main">
        <!-- Breadcrumb & Clock -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bi bi-house-door me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-2 bg-white px-3 py-2 rounded-pill shadow-sm" style="border: 1px solid #eef1f6;">
                <i class="bi bi-calendar3" style="color: var(--gold);"></i>
               <span id="live-clock" class="badge bg-light text-dark border" style="font-size:.9rem;"></span>
            </div>
        </div>

        <!-- Stat Cards Row -->
        <div class="row g-3 mb-3">
            <!-- Card 1 - Registered Students -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card stat-card stat-navy rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1 fw-medium text-uppercase" style="letter-spacing: .4px;">Registered Students</p>
                                <h2 class="stat-value mb-2" data-target="1250" style="font-weight: 700; font-size: 2.1rem;">0</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span class="stat-trend" style="background: rgba(13,43,94,.1); color: var(--navy);">
                                <i class="bi bi-arrow-up-short"></i>5%
                            </span>
                            <span class="small text-muted">from last month</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 - Student In -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card stat-card stat-green rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1 fw-medium text-uppercase" style="letter-spacing: .4px;">Student In</p>
                                <h2 class="stat-value mb-1" data-target="850" style="font-weight: 700; font-size: 2.1rem;">0</h2>
                                <p class="small text-muted mb-2" style="margin-top: -2px;">Currently inside campus</p>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-box-arrow-in-right"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="stat-trend" style="background: rgba(25,135,84,.12); color: #198754;">
                                <i class="bi bi-arrow-up-short"></i>12%
                            </span>
                            <span class="small text-muted">from yesterday</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 - Student Out -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card stat-card stat-red rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1 fw-medium text-uppercase" style="letter-spacing: .4px;">Student Out</p>
                                <h2 class="stat-value mb-1" data-target="400" style="font-weight: 700; font-size: 2.1rem;">0</h2>
                                <p class="small text-muted mb-2" style="margin-top: -2px;">Left the campus</p>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-box-arrow-left"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="stat-trend" style="background: rgba(220,53,69,.12); color: #dc3545;">
                                <i class="bi bi-arrow-down-short"></i>3%
                            </span>
                            <span class="small text-muted">from yesterday</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 - Today's Scans -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card stat-card stat-blue rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1 fw-medium text-uppercase" style="letter-spacing: .4px;">Today's Scans</p>
                                <h2 class="stat-value mb-1" data-target="2100" style="font-weight: 700; font-size: 2.1rem;">0</h2>
                                <p class="small text-muted mb-2" style="margin-top: -2px;">Total QR scans performed today</p>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-qr-code-scan"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="stat-trend" style="background: rgba(13,110,253,.12); color: #0d6efd;">
                                <i class="bi bi-arrow-up-short"></i>18%
                            </span>
                            <span class="small text-muted">from yesterday</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Attendance - Full Width -->
        <div class="row g-3">
            <div class="col-12">
                <div class="card rounded-4 h-100">
                    <div class="card-header bg-transparent border-0 pt-3 pb-2 px-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                            <h5 class="mb-0 fw-semibold d-flex align-items-center" style="color: var(--navy);">
                                <i class="bi bi-clock-history me-2" style="color: var(--gold);"></i>
                                Recent Attendance
                            </h5>
                            <div class="search-box" style="min-width: 240px; width: 100%; max-width: 280px;">
                                <i class="bi bi-search"></i>
                                <input type="text" id="attendanceSearch" class="form-control" placeholder="Search student, ID...">
                            </div>
                        </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Grade/Section</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Status</th>
                                        <th>Scan Type</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceTableBody">
                                    <tr>
                                        <td><span class="fw-semibold" style="color: var(--navy);">2026-001</span></td>
                                        <td>Dsie Jayne Perocho</td>
                                        <td><span class="small text-muted">Grade 10 - St. Mary</span></td>
                                        <td>7:05 AM</td>
                                        <td>4:30 PM</td>
                                        <td><span class="badge-status status-present">Present</span></td>
                                        <td><span class="badge bg-light text-dark border fw-normal"><i class="bi bi-qr-code me-1"></i>QR Scan</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold" style="color: var(--navy);">2026-002</span></td>
                                        <td>Maria Lopez</td>
                                        <td><span class="small text-muted">Grade 9 - St. Joseph</span></td>
                                        <td>7:22 AM</td>
                                        <td><span class="text-muted">—</span></td>
                                        <td><span class="badge-status status-late">Late</span></td>
                                        <td><span class="badge bg-light text-dark border fw-normal"><i class="bi bi-qr-code me-1"></i>QR Scan</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="fw-semibold" style="color: var(--navy);">2026-003</span></td>
                                        <td>Pedro Santos</td>
                                        <td><span class="small text-muted">Grade 11 - St. Peter</span></td>
                                        <td>6:58 AM</td>
                                        <td>4:32 PM</td>
                                        <td><span class="badge-status status-present">Present</span></td>
                                        <td><span class="badge bg-light text-dark border fw-normal"><i class="bi bi-qr-code me-1"></i>QR Scan</span></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Empty State -->
                        <div id="emptyState" class="text-center py-5 d-none">
                            <i class="bi bi-inbox fs-1 text-muted opacity-50"></i>
                            <p class="mt-2 mb-0 text-muted">No attendance records found</p>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 py-3">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                            <small class="text-muted">Showing 1 to 8 of 1,250 entries</small>
                            <nav aria-label="Table pagination">
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item active"><a class="page-link" href="#" style="background: var(--navy); border-color: var(--navy);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center text-muted small mt-4 pt-3 border-top" style="border-color: #e9edf5 !important;">
            © 2026 Lourdes Academy Attendance System • Designed for excellence
        </footer>
    </main>

    <!-- Toast -->
    <?php include 'components/toast.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="../assets/js/script.js"></script>
    
<script>(function(){document.addEventListener("click",function(e){var a=e.target.closest("[data-product-id]");if(!a)return;e.preventDefault();var pid=a.getAttribute("data-product-id");if(pid)parent.postMessage({type:"ecto-artifact-link-click",productId:pid},"*")})})();</script>
</body>
</html>