    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid px-3">
            <button class="nav-icon-btn d-lg-none me-1" id="mobileToggle" aria-label="Toggle menu">
                <i class="bi bi-list fs-4"></i>
            </button>
            
            <a class="navbar-brand d-flex align-items-center gap-2 me-3" href="#">
                <div class="">
                    <img 
                    src="https://scontent.fdvo1-2.fna.fbcdn.net/v/t39.30808-6/272546157_107796111815001_1700017094958757330_n.png?stp=dst-png&cstp=mx849x798&ctp=s849x798&_nc_cat=103&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeEZQGL3opeY_c3rzK5Y26e2Vx699BXQAydXHr30FdADJ5RlKFZuFFIPanSU_i14TPOvBFLDl7G-uIK6UW_VxcQv&_nc_ohc=OKsQ6krq2jMQ7kNvwEtvVI-&_nc_oc=AdpQx0wW8Fg2yzLwzb0SYz3-hvruSKuQ3-hp8cLbLrflSRBzSGHxW1wixXK8imLMoeyxQzFrOgBS0coKCgZpLRM_&_nc_zt=23&_nc_ht=scontent.fdvo1-2.fna&_nc_gid=wRbGUT4lRZ4MdLekQhnbWg&_nc_ss=7b2a8&oh=00_Af_bE42wJEOkvRdfGINWmsMhI6xa9rORE_c46gX1-cdaaw&oe=6A425A4D"
                    alt="Logo"
                    width="40"
                    height="40"
                    class="rounded-circle border border-2 border-primary">      
                </div>
                <div class="d-none d-sm-block">
                    <div class="brand-text fw-semibold" style="font-size: .98rem;">Lourdes Academy</div>
                    <div class="text-muted d-none d-md-block" style="font-size: .72rem; margin-top: -2px;">Attendance System</div>
                </div>
            </a>

            <div class="ms-auto d-flex align-items-center gap-1 gap-sm-2">
                <!-- Notifications -->
                <button class="nav-icon-btn" aria-label="Notifications">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="badge-notif">3</span>
                </button>

                <!-- Admin Profile -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle ps-1 pe-2 py-1 rounded-3" data-bs-toggle="dropdown" aria-expanded="false" style="transition: background .2s;" onmouseover="this.style.background='#f5f7fb'" onmouseout="this.style.background='transparent'">
                        <img src="https://ui-avatars.com/api/?name=Admin+Jonefer&background=0d2b5e&color=fff&bold=true&size=72" width="38" height="38" class="rounded-circle" alt="Admin">
                        <div class="d-none d-md-block text-start ms-2 me-1">
                            <div class="fw-semibold lh-1" style="color: var(--navy); font-size: .88rem;">Admin</div>
                            <div class="text-muted" style="font-size: .7rem;">Administrator</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../index.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            <!-- <a href="#" class="btn-logout d-none d-lg-inline-flex align-items-center gap-1 ms-1">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a> -->
            </div>
        </div>
    </nav>