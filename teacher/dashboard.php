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
  <!-- ===== PAGE HEADER ===== -->
  <div class="pagetitle d-flex justify-content-between align-items-start flex-wrap">
    <div>
      <h1 style="color:#0d2b5e; font-weight:600;">Teacher Dashboard</h1>
      <nav>
        <ol class="breadcrumb mb-1">
          <li class="breadcrumb-item"><a href="#" style="color:#0d2b5e; text-decoration:none;">Dashboard</a></li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </nav>
      <p class="text-muted mb-0">Welcome back! Monitor student attendance and manage your class efficiently.</p>
    </div>
    <div class="text-end">
      <span id="teacher-datetime" class="badge bg-light text-dark border" style="font-size:.85rem;"></span>
    </div>
  </div>

  <!-- ===== SECOND ROW ===== -->
  <section class="section mt-4">
    <div class="row g-4">
      <!-- Left: My Class Attendance -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-calendar-check me-2"></i>My Class Attendance</h5>
            <input type="text" id="search-attendance" class="form-control form-control-sm" placeholder="Search student..." style="max-width:200px;">
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover align-middle" id="attendance-table">
                <thead style="background:#f8fafc;">
                  <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Grade & Section</th>
                    <th>Status</th>
                    <th>Time In</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td>2026-001</td><td>Dsie Jayne Perocho</td><td>Grade 10 - St. Mary</td><td><span class="badge bg-success">Present</span></td><td>7:05 AM</td></tr>
                  <tr><td>2026-002</td><td>Maria Lopez</td><td>Grade 10 - St. Mary</td><td><span class="badge bg-warning text-dark">Late</span></td><td>7:22 AM</td></tr>
                  <tr><td>2026-003</td><td>Pedro Santos</td><td>Grade 10 - St. Mary</td><td><span class="badge bg-success">Present</span></td><td>6:58 AM</td></tr>
                </tbody>
              </table>
            </div>
            <div id="empty-attendance" class="text-center py-4" style="display:none;">
              <i class="bi bi-inbox" style="font-size:2.5rem; color:#dee2e6;"></i>
              <p class="text-muted mt-2 mb-0">No records found</p>
            </div>
            <nav class="mt-3">
              <ul class="pagination pagination-sm justify-content-end mb-0">
                <li class="page-item disabled"><a class="page-link">Previous</a></li>
                <li class="page-item active"><a class="page-link" style="background:#0d2b5e; border-color:#0d2b5e;">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">Next</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <!-- Right: Today's Class Summary -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-header bg-white border-0 pt-3">
            <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-pie-chart me-2"></i>Today's Class Summary</h5>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2"><span class="text-muted">Total Students</span><span class="fw-semibold">120</span></div>
            <div class="d-flex justify-content-between mb-2"><span class="text-muted">Present</span><span class="fw-semibold text-success">108</span></div>
            <div class="d-flex justify-content-between mb-2"><span class="text-muted">Late</span><span class="fw-semibold text-warning">8</span></div>
            <div class="d-flex justify-content-between mb-3"><span class="text-muted">Absent</span><span class="fw-semibold text-danger">4</span></div>
            
            <label class="small text-muted mb-1">Attendance Rate: 90%</label>
            <div class="progress" style="height:10px; border-radius:5px;">
              <div class="progress-bar" role="progressbar" style="width:90%; background:linear-gradient(90deg,#0d2b5e,#c9a227);" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-center mt-4">
              <div class="spinner-border spinner-border-sm text-secondary d-none" id="summary-loader" role="status"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== THIRD ROW ===== -->
  <section class="section mt-4">
    <div class="row g-4">
      <!-- Left: Recent Activities -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-header bg-white border-0 pt-3">
            <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-activity me-2"></i>Recent Attendance Activities</h5>
          </div>
          <div class="card-body" style="max-height:280px; overflow-y:auto;">
            <div class="activity-feed">
              <div class="d-flex mb-3"><div class="flex-shrink-0"><span class="badge rounded-pill bg-success p-2"><i class="bi bi-check"></i></span></div><div class="flex-grow-1 ms-3"><p class="mb-0 small">Dsie Jayne Perocho marked <strong>Present</strong> at 7:05 AM.</p><small class="text-muted">2 mins ago</small></div></div>
              <div class="d-flex mb-3"><div class="flex-shrink-0"><span class="badge rounded-pill bg-warning p-2"><i class="bi bi-clock"></i></span></div><div class="flex-grow-1 ms-3"><p class="mb-0 small">Maria Lopez marked <strong>Late</strong> at 7:22 AM.</p><small class="text-muted">15 mins ago</small></div></div>
              <div class="d-flex mb-3"><div class="flex-shrink-0"><span class="badge rounded-pill bg-success p-2"><i class="bi bi-check"></i></span></div><div class="flex-grow-1 ms-3"><p class="mb-0 small">Pedro Santos marked <strong>Present</strong> at 6:58 AM.</p><small class="text-muted">32 mins ago</small></div></div>
              <div class="d-flex mb-3"><div class="flex-shrink-0"><span class="badge rounded-pill bg-danger p-2"><i class="bi bi-x"></i></span></div><div class="flex-grow-1 ms-3"><p class="mb-0 small">Ana Reyes marked <strong>Absent</strong>.</p><small class="text-muted">1 hour ago</small></div></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Announcements -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-header bg-white border-0 pt-3">
            <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-megaphone me-2"></i>Upcoming Announcements</h5>
          </div>
          <div class="card-body">
            <div class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 py-2 announcement-item">
                <div><i class="bi bi-calendar-event text-primary me-2"></i>Faculty Meeting</div>
                <span class="badge bg-light text-dark border">Jun 30, 2026</span>
              </a>
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 py-2 announcement-item">
                <div><i class="bi bi-journal-text text-warning me-2"></i>Quarterly Examination Schedule</div>
                <span class="badge bg-light text-dark border">Jul 5, 2026</span>
              </a>
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 py-2 announcement-item">
                <div><i class="bi bi-people text-success me-2"></i>Parent-Teacher Conference</div>
                <span class="badge bg-light text-dark border">Jul 12, 2026</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Toast -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index:11">
    <div id="teacherToast" class="toast align-items-center text-white border-0" style="background:#0d2b5e;" role="alert">
      <div class="d-flex"><div class="toast-body">Welcome back, Teacher!</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>
    </div>
  </div>

  <style>
    .teacher-stat { transition: transform .2s ease, box-shadow .2s ease; }
    .teacher-stat:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(13,43,94,.12)!important; }
    .announcement-item { transition: background .2s; border-radius:8px; }
    .announcement-item:hover { background:#f8fafc; }
  </style>

  <script>
    // Date and time
    function updateTeacherTime(){
      const now = new Date();
      document.getElementById('teacher-datetime').textContent = now.toLocaleString('en-US', { weekday:'long', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
    }
    setInterval(updateTeacherTime, 60000); updateTeacherTime();

    // Animated counters
    document.querySelectorAll('.counter').forEach(el=>{
      const target = parseInt(el.dataset.target); let cur=0; const step=Math.ceil(target/40);
      const t=setInterval(()=>{ cur+=step; if(cur>=target){cur=target; clearInterval(t);} el.textContent=cur; },30);
    });

    // Search functionality
    document.getElementById('search-attendance').addEventListener('input', e=>{
      const q=e.target.value.toLowerCase(); let visible=0;
      document.querySelectorAll('#attendance-table tbody tr').forEach(tr=>{
        const show=tr.textContent.toLowerCase().includes(q);
        tr.style.display=show?'':'none'; if(show) visible++;
      });
      document.getElementById('empty-attendance').style.display = visible? 'none':'block';
    });

    // Toast on load
    window.addEventListener('load', ()=>{ const toast=new bootstrap.Toast(document.getElementById('teacherToast')); setTimeout(()=>toast.show(),800); });
  </script>
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