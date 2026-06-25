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
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Scanner</li>
                </ol>
            </nav>
            
            <div class="d-flex align-items-center gap-2 bg-white px-3 py-2 rounded-pill shadow-sm" style="border: 1px solid #eef1f6;">
                <i class="bi bi-calendar3" style="color: var(--gold);"></i>
               <span id="live-clock" class="badge bg-light text-dark border" style="font-size:.9rem;"></span>
            </div>
        </div>

  <!-- ===== FIRST ROW ===== -->
  <section class="section mt-4">
    <div class="row g-4">
      <!-- Left: Live Scanner -->
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4 h-100">
          <div class="card-header bg-white border-0 pt-3 pb-0">
            <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-qr-code-scan me-2"></i>Live QR Scanner</h5>
          </div>
          <div class="card-body">
            <!-- Scanner Preview -->
            <div class="position-relative">
              <div class="ratio ratio-16x9 bg-light border border-2 border-dashed rounded-3 overflow-hidden" style="border-color:#e2e8f0!important;">
                <div id="reader" class="w-100 h-100 d-flex align-items-center justify-content-center position-relative bg-dark">
                  <!-- Inactive state -->
                  <div id="camera-placeholder" class="text-center">
                    <i class="bi bi-upc-scan" style="font-size:4rem; color:#6c757d;"></i>
                    <p class="text-white-50 mt-2 mb-0">Camera is offline</p>
                  </div>
                  <!-- Scanning line -->
                  <div id="scan-line" class="position-absolute w-75" style="height:3px; background:linear-gradient(90deg,transparent,#c9a227,transparent); top:50%; left:12.5%; display:none; box-shadow:0 0 15px #c9a227; animation:scanMove 2s infinite;"></div>
                  <!-- Loader -->
                  <div id="camera-loader" class="position-absolute top-50 start-50 translate-middle" style="display:none;">
                    <div class="spinner-border text-warning" style="width:3rem; height:3rem;" role="status"></div>
                  </div>
                </div>
              </div>
              <!-- Status badge -->
              <span id="scan-status" class="position-absolute top-0 end-0 m-3 badge bg-secondary px-3 py-2"><i class="bi bi-camera-video-off me-1"></i>Camera Offline</span>
            </div>

            <!-- Action Buttons -->
            <div class="row g-2 mt-4">
              <div class="col-6 col-md-3"><button id="btn-start" class="btn w-100 btn-lg" style="background:#0d2b5e; color:#fff; border-radius:12px;"><i class="bi bi-camera-video-fill me-2"></i>Start Camera</button></div>
              <div class="col-6 col-md-3"><button id="btn-stop" class="btn w-100 btn-lg btn-outline-secondary" style="border-radius:12px;" disabled><i class="bi bi-stop-circle-fill me-2"></i>Stop Camera</button></div>
              <div class="col-6 col-md-3"><button id="btn-refresh" class="btn w-100 btn-lg btn-outline-warning" style="border-radius:12px; color:#c9a227; border-color:#c9a227;"><i class="bi bi-arrow-clockwise me-2"></i>Refresh</button></div>
              <div class="col-6 col-md-3"><button id="btn-switch" class="btn w-100 btn-lg btn-outline-secondary" style="border-radius:12px;" disabled><i class="bi bi-arrow-repeat me-2"></i>Switch</button></div>
            </div>
            <!-- <small class="text-muted d-block mt-2">Ready for html5-qrcode integration. Replace #reader content with Html5QrcodeScanner.</small> -->
          </div>
        </div>
      </div>

      <!-- Right: Latest Scan Result -->
      <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 h-100">
          <div class="card-header bg-white border-0 pt-3 pb-0">
            <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-person-badge me-2"></i>Latest Scan Result</h5>
          </div>
          <div class="card-body text-center">
            <!-- Empty state -->
            <div id="latest-empty" class="py-5">
              <i class="bi bi-person-x" style="font-size:3.5rem; color:#dee2e6;"></i>
              <p class="text-muted mt-3 mb-0">No scan recorded yet</p>
              <small class="text-muted">Start the camera to begin scanning</small>
            </div>

            <!-- Result content -->
            <div id="latest-result" style="display:none;">
              <img id="latest-photo" src="https://ui-avatars.com/api/?name=Juan+Dela+Cruz&background=0d2b5e&color=fff&size=128" class="rounded-circle shadow-sm mb-3" width="110" height="110" alt="Student">
              <h5 id="latest-name" class="mb-1" style="color:#0d2b5e;">Dsie Jayne Perocho</h5>
              <p class="text-muted small mb-3" id="latest-grade">Grade 10 - St. Mary</p>

              <div class="text-start bg-light rounded-3 p-3 mb-3">
                <div class="d-flex justify-content-between py-1"><span class="text-muted">Student ID</span><span class="fw-semibold" id="latest-id">2026-001</span></div>
                <div class="d-flex justify-content-between py-1"><span class="text-muted">Parent</span><span class="fw-semibold" id="latest-parent">Maria Dela Cruz</span></div>
                <div class="d-flex justify-content-between py-1"><span class="text-muted">Date</span><span class="fw-semibold" id="latest-date">Jun 25, 2026</span></div>
                <div class="d-flex justify-content-between py-1"><span class="text-muted">Time</span><span class="fw-semibold" id="latest-time">7:15 AM</span></div>
              </div>

              <div class="mb-3">
                <span class="text-muted small d-block mb-1">Attendance Status</span>
                <span id="latest-status" class="badge bg-success px-3 py-2" style="font-size:.9rem;">Present</span>
              </div>

              <div class="alert alert-success d-flex align-items-center justify-content-center py-2 mb-0" role="alert">
                <i class="bi bi-envelope-check-fill me-2"></i>
                <small>✓ Email Notification Sent Successfully</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== SECOND ROW ===== -->
  <section class="section mt-4">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white border-0 pt-3 pb-3 d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-journal-text me-2"></i>Attendance Activity Log</h5>
            <div class="d-flex gap-2 mt-2 mt-md-0">
              <input type="text" id="search-log" class="form-control form-control-sm" placeholder="Search records..." style="width:220px;">
            </div>
          </div>
          <div class="card-body pt-0">
            <!-- Empty state -->
            <div id="log-empty" class="text-center py-5" style="display:none;">
              <i class="bi bi-inbox" style="font-size:3rem; color:#dee2e6;"></i>
              <p class="text-muted mt-2">No attendance records found</p>
            </div>

            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0" id="activity-table">
                <thead style="background:#f8fafc;">
                  <tr>
                    <th class="sortable" data-sort="id">Student ID <i class="bi bi-arrow-down-up small"></i></th>
                    <th class="sortable" data-sort="name">Student Name <i class="bi bi-arrow-down-up small"></i></th>
                    <th>Grade/Section</th>
                    <th>Scan Date</th>
                    <th>Scan Time</th>
                    <th>Attendance Type</th>
                    <th>Email Status</th>
                    <th>Attendance Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td>2026-001</td><td>Dsie Jayne Perocho</td><td>Grade 10 - St. Mary</td><td>Jun 25, 2026</td><td>7:01 AM</td><td>Time In</td><td><span class="badge bg-primary">Sent</span></td><td><span class="badge bg-success">Present</span></td></tr>
                  <tr><td>2026-002</td><td>Maria Lopez</td><td>Grade 9 - St. Joseph</td><td>Jun 25, 2026</td><td>7:15 AM</td><td>Time In</td><td><span class="badge bg-primary">Sent</span></td><td><span class="badge bg-warning text-dark">Late</span></td></tr>
                  <tr><td>2026-003</td><td>Pedro Santos</td><td>Grade 11 - St. Peter</td><td>Jun 25, 2026</td><td>6:58 AM</td><td>Time In</td><td><span class="badge bg-primary">Sent</span></td><td><span class="badge bg-success">Present</span></td></tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
              <small class="text-muted" id="pagination-info">Showing 1 to 10 of 10 entries</small>
              <nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link">Previous</a></li><li class="page-item active"><a class="page-link" style="background:#0d2b5e; border-color:#0d2b5e;">1</a></li><li class="page-item"><a class="page-link">2</a></li><li class="page-item"><a class="page-link">Next</a></li></ul></nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Toast -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index:1080">
    <div id="scanToast" class="toast align-items-center text-white border-0" style="background:#0d2b5e;" role="alert">
      <div class="d-flex"><div class="toast-body"><i class="bi bi-check-circle-fill me-2" style="color:#c9a227;"></i>Attendance recorded successfully</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>
    </div>
  </div>

  <style>
    @keyframes scanMove { 0% { top:20%; } 50% { top:80%; } 100% { top:20%; } }
   .card { transition: transform.2s ease, box-shadow.2s ease; }
   .card:hover { transform: translateY(-2px); }
   .sortable { cursor:pointer; user-select:none; }
   .sortable:hover { color:#0d2b5e; }
   .btn-lg { padding:.7rem 1rem; font-weight:500; }
  </style>

  <script>

    // Camera controls
    const btnStart = document.getElementById('btn-start');
    const btnStop = document.getElementById('btn-stop');
    const btnSwitch = document.getElementById('btn-switch');
    const btnRefresh = document.getElementById('btn-refresh');
    const statusBadge = document.getElementById('scan-status');
    const placeholder = document.getElementById('camera-placeholder');
    const loader = document.getElementById('camera-loader');
    const scanLine = document.getElementById('scan-line');
    const reader = document.getElementById('reader');

    btnStart.addEventListener('click', () => {
      loader.style.display = 'block';
      statusBadge.className = 'position-absolute top-0 end-0 m-3 badge bg-warning text-dark px-3 py-2';
      statusBadge.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Initializing...';
      setTimeout(() => {
        loader.style.display = 'none';
        document.getElementById('camera-placeholder').style.display = 'none';
        scanLine.style.display = 'block';
        reader.querySelector('div').innerHTML = '<i class="bi bi-qr-code" style="font-size:4rem; color:#c9a227;"></i><p class="text-white mt-2 mb-0">Ready to Scan</p>';
        statusBadge.className = 'position-absolute top-0 end-0 m-3 badge bg-success px-3 py-2';
        statusBadge.innerHTML = '<i class="bi bi-play-circle me-1"></i>Ready to Scan';
        btnStart.disabled = true; btnStop.disabled = false; btnSwitch.disabled = false;
        setTimeout(simulateScan, 3000);
      }, 1500);
    });

    btnStop.addEventListener('click', () => {
      scanLine.style.display = 'none';
      reader.innerHTML = '<div id="camera-placeholder" class="text-center"><i class="bi bi-upc-scan" style="font-size:4rem; color:#6c757d;"></i><p class="text-white-50 mt-2 mb-0">Camera is offline</p></div><div id="scan-line" class="position-absolute w-75" style="height:3px; background:linear-gradient(90deg,transparent,#c9a227,transparent); top:50%; left:12.5%; display:none; box-shadow:0 0 15px #c9a227; animation:scanMove 2s infinite;"></div><div id="camera-loader" class="position-absolute top-50 start-50 translate-middle" style="display:none;"><div class="spinner-border text-warning" style="width:3rem; height:3rem;" role="status"></div></div>';
      statusBadge.className = 'position-absolute top-0 end-0 m-3 badge bg-secondary px-3 py-2';
      statusBadge.innerHTML = '<i class="bi bi-camera-video-off me-1"></i>Camera Offline';
      btnStart.disabled = false; btnStop.disabled = true; btnSwitch.disabled = true;
    });

    btnRefresh.addEventListener('click', () => location.reload());
    btnSwitch.addEventListener('click', () => {
      statusBadge.innerHTML = '<i class="bi bi-arrow-repeat me-1"></i>Switching...';
      setTimeout(() => statusBadge.innerHTML = '<i class="bi bi-play-circle me-1"></i>Ready to Scan', 800);
    });

    function simulateScan(){
      statusBadge.className = 'position-absolute top-0 end-0 m-3 badge bg-info px-3 py-2';
      statusBadge.innerHTML = '<i class="bi bi-search me-1"></i>Scanning...';
      setTimeout(() => {
        statusBadge.className = 'position-absolute top-0 end-0 m-3 badge px-3 py-2';
        statusBadge.style.background = '#c9a227'; statusBadge.style.color = '#000';
        statusBadge.innerHTML = '<i class="bi bi-qr-code me-1"></i>QR Detected';

        // Update latest result
        document.getElementById('latest-empty').style.display = 'none';
        document.getElementById('latest-result').style.display = 'block';
        const now = new Date();
        document.getElementById('latest-date').textContent = now.toLocaleDateString('en-US', { month:'short', day:'numeric', year:'numeric' });
        document.getElementById('latest-time').textContent = now.toLocaleTimeString('en-US', { hour:'2-digit', minute:'2-digit' });

        // Add to log
        const tbody = document.querySelector('#activity-table tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `<td>2026-001</td><td>Dsie Jayne Perocho</td><td>Grade 10 - St. Mary</td><td>${now.toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'})}</td><td>${now.toLocaleTimeString('en-US',{hour:'2-digit',minute:'2-digit'})}</td><td>Time In</td><td><span class="badge bg-primary">Sent</span></td><td><span class="badge bg-success">Present</span></td>`;
        tbody.prepend(newRow);

        // Toast
        new bootstrap.Toast(document.getElementById('scanToast')).show();

        setTimeout(() => {
          statusBadge.className = 'position-absolute top-0 end-0 m-3 badge bg-success px-3 py-2';
          statusBadge.innerHTML = '<i class="bi bi-check-circle me-1"></i>Ready to Scan';
        }, 2000);
      }, 1200);
    }

    // Search
    document.getElementById('search-log').addEventListener('input', e => {
      const q = e.target.value.toLowerCase();
      let visible = 0;
      document.querySelectorAll('#activity-table tbody tr').forEach(tr => {
        const show = tr.textContent.toLowerCase().includes(q);
        tr.style.display = show? '' : 'none';
        if(show) visible++;
      });
      document.getElementById('log-empty').style.display = visible? 'none' : 'block';
      document.getElementById('pagination-info').textContent = `Showing ${visible} entries`;
    });

    // Simple sort
    document.querySelectorAll('.sortable').forEach(th => {
      th.addEventListener('click', () => {
        const table = th.closest('table');
        const tbody = table.querySelector('tbody');
        const idx = Array.from(th.parentNode.children).indexOf(th);
        const rows = Array.from(tbody.querySelectorAll('tr'));
        rows.sort((a,b) => a.cells[idx].textContent.localeCompare(b.cells[idx].textContent));
        rows.forEach(r => tbody.appendChild(r));
      });
    });
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