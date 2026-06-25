  document.addEventListener('DOMContentLoaded', function() {
            // ===== LOADER =====
            setTimeout(() => {
                document.getElementById('loader').classList.add('hide');
            }, 650);

            // ===== TOAST =====
            const toastEl = document.getElementById('lateToast');
            const toast = new bootstrap.Toast(toastEl);
            setTimeout(() => toast.show(), 900);

            // ===== LIVE CLOCK =====
            function updateClock() {
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const dateStr = now.toLocaleDateString('en-US', options);
                let hours = now.getHours();
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12 || 12;
                document.getElementById('liveClock').textContent = `${dateStr} - ${hours}:${minutes} ${ampm}`;
            }
            updateClock();
            setInterval(updateClock, 30000);

            // ===== SIDEBAR TOGGLE =====
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            const backdrop = document.getElementById('sidebarBackdrop');
            const mobileToggle = document.getElementById('mobileToggle');
            const collapseBtn = document.getElementById('sidebarCollapse');
            const sidebarHint = document.getElementById('sidebarHint');

            mobileToggle.addEventListener('click', () => {
                sidebar.classList.add('show');
                backdrop.classList.add('show');
                document.body.style.overflow = 'hidden';
            });

            function closeMobileSidebar() {
                sidebar.classList.remove('show');
                backdrop.classList.remove('show');
                document.body.style.overflow = '';
            }
            backdrop.addEventListener('click', closeMobileSidebar);

            if (collapseBtn) {
                collapseBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                    main.classList.toggle('expanded');
                    if (sidebarHint) {
                        sidebarHint.classList.toggle('d-none');
                    }
                });
            }

            // ===== ACTIVE MENU =====
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {

                  document.querySelectorAll('.sidebar .nav-link')
                        .forEach(l => l.classList.remove('active'));

                  this.classList.add('active');

                  if (window.innerWidth < 992) {
                        closeMobileSidebar();
                  }
            });
            });

            // ===== ATTENDANCE SEARCH =====
            const attendanceSearch = document.getElementById('attendanceSearch');
            const tbody = document.getElementById('attendanceTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const emptyState = document.getElementById('emptyState');

            function filterAttendance() {
                const term = attendanceSearch.value.toLowerCase().trim();
                let visible = 0;
                rows.forEach(row => {
                    const match = row.innerText.toLowerCase().includes(term);
                    row.style.display = match ? '' : 'none';
                    if (match) visible++;
                });
                emptyState.classList.toggle('d-none', visible > 0);
            }
            attendanceSearch.addEventListener('input', filterAttendance);

            // ===== ANIMATED COUNTERS =====
            const counters = document.querySelectorAll('.stat-value');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'), 10);
                const duration = 1600;
                const startTime = performance.now();
                function animate(now) {
                    const elapsed = now - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(eased * target);
                    counter.textContent = current.toLocaleString();
                    if (progress < 1) {
                        requestAnimationFrame(animate);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                }
                requestAnimationFrame(animate);
            });

            // Close sidebar on resize to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) {
                    closeMobileSidebar();
                }
            });
        });

            // Real-time clock
    function updateClock(){
      const now = new Date();
      document.getElementById('live-clock').textContent = now.toLocaleString('en-US', { weekday:'short', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit', second:'2-digit' });
    }
    setInterval(updateClock,1000); updateClock();