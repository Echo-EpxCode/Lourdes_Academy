    <aside id="sidebar" class="sidebar">
        <button id="sidebarCollapse" class="toggle-btn d-none d-lg-grid" aria-label="Collapse sidebar">
            <i class="bi bi-chevron-left"></i>
        </button>
        <div class="sidebar-inner">
            <ul class="nav flex-column">
                  <li class="nav-item">
                  <a href="dashboard.php"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                  </a>
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'students.php' ? 'active' : ''; ?>">
                              <i class="bi bi-people-fill"></i>
                              <span>My Students</span>
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'teachers.php' ? 'active' : ''; ?>">
                              <i class="bi bi-person-workspace"></i>
                              <span>Attendance</span>
                        </a>
                  </li>
                  <li class="nav-item">
                  <a href="scanner.php"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'scanner.php' ? 'active' : ''; ?>">
                        <i class="bi bi-qr-code-scan"></i>
                        <span>Scanner</span>
                  </a>
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : ''; ?>">
                              <i class="bi bi-file-earmark-bar-graph"></i>
                              <span>Reports</span>
                        </a>
                  </li>
            </ul>

            <div class="px-3 mt-4 d-none d-lg-block" id="sidebarHint">
                <div class="p-3 rounded-3" style="background: linear-gradient(135deg, #f5f7fb, #eef2f9); border: 1px dashed #d6ddea;">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="bi bi-lightning-charge-fill" style="color: var(--gold);"></i>
                        <strong style="font-size: .85rem; color: var(--navy);">Quick Scan</strong>
                    </div>
                    <p class="small text-muted mb-2" style="line-height: 1.4;">Open scanner to log attendance instantly</p>
                    <button class="btn btn-sm w-100" style="background: var(--navy); color: #fff; border-radius: .6rem;">Open Scanner</button>
                </div>
            </div>
        </div>
    </aside>