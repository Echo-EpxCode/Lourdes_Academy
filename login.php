<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lourdes Academy Attendance System - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --navy: #0d2b5e;
      --navy-dark: #1e3a8a;
      --gold: #c9a227;
      --light: #f8fafc;
    }
    * { font-family: 'Poppins', sans-serif; }
    body { margin: 0; -webkit-font-smoothing: antialiased; }
    
    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #0d2b5e 0%, #1e3a8a 100%);
      position: relative;
      overflow: hidden;
      padding: 1.25rem;
    }
    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      z-index: 0;
    }
    .blob-1 {
      top: -120px;
      left: -100px;
      width: 320px;
      height: 320px;
      background: #c9a227;
      opacity: 0.15;
      filter: blur(100px);
    }
    .blob-2 {
      bottom: -120px;
      right: -80px;
      width: 300px;
      height: 300px;
      background: #ffffff;
      opacity: 0.10;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      background: #fff;
      border: none;
      box-shadow: 0 20px 50px rgba(0,0,0,0.25);
      border-radius: 1.5rem !important;
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .login-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 28px 60px rgba(0,0,0,0.3);
    }

    .logo-img {
      border-radius: 50%;
      border: 3px solid #c9a227;
      object-fit: cover;
      box-shadow: 0 4px 12px rgba(201,162,39,0.3);
    }

    .role-switch .nav-link {
      color: var(--navy);
      background: #f1f5f9;
      border-radius: 12px;
      font-weight: 500;
      padding: 0.65rem 1rem;
      transition: all 0.25s ease;
      border: 1px solid transparent;
    }
    .role-switch .nav-link:hover {
      background: #e2e8f0;
    }
    .role-switch .nav-link.active {
      background: linear-gradient(135deg, #0d2b5e, #1e40af);
      color: #fff;
      box-shadow: 0 6px 16px rgba(13,43,94,0.3);
    }

    .form-control {
      border-radius: 12px;
      height: 58px;
      border: 1.5px solid #e2e8f0;
      background: #fff;
      transition: all 0.2s;
    }
    .form-control:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 0.2rem rgba(201,162,39,0.18);
    }
    .form-floating > label {
      color: #64748b;
    }
    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gold);
      z-index: 5;
      pointer-events: none;
      font-size: 1.1rem;
    }

    #togglePassword {
      color: #64748b;
      z-index: 5;
    }
    #togglePassword:hover { color: var(--navy); }

    .form-check-input {
      border-color: #cbd5e1;
      width: 1.1em;
      height: 1.1em;
      margin-top: 0.15em;
    }
    .form-check-input:checked {
      background-color: var(--navy);
      border-color: var(--navy);
    }
    .form-check-input:focus {
      box-shadow: 0 0 0 0.2rem rgba(13,43,94,0.15);
      border-color: var(--navy);
    }

    #btn-login {
      background: linear-gradient(135deg, #0d2b5e, #1e40af);
      border: none;
      border-radius: 12px;
      padding: 0.85rem;
      font-weight: 600;
      letter-spacing: 0.3px;
      transition: all 0.25s ease;
    }
    #btn-login:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(13,43,94,0.35);
      background: linear-gradient(135deg, #0c2550, #1d3a9e);
    }
    #btn-login:active { transform: translateY(0); }
    #btn-login:disabled { opacity: 0.8; }

    .forgot-link {
      color: var(--gold);
      font-weight: 500;
      text-decoration: none;
      transition: color 0.2s;
    }
    .forgot-link:hover { color: #a9861e; text-decoration: underline; }

    @keyframes shake {
      0%,100%{transform:translateX(0)}
      20%,60%{transform:translateX(-8px)}
      40%,80%{transform:translateX(8px)}
    }
    .shake { animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both; }

    .toast {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    @media (max-width: 390px) {
      .login-wrapper { padding: 1rem; }
      .login-card { border-radius: 1.25rem !important; }
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div id="loginCard" class="login-card card shadow-lg rounded-4 p-4 p-md-5">
      <!-- Logo Section -->
      <div class="text-center mb-4">
        <img src="https://scontent.fdvo1-2.fna.fbcdn.net/v/t39.30808-6/272546157_107796111815001_1700017094958757330_n.png?stp=dst-png&cstp=mx849x798&ctp=s849x798&_nc_cat=103&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeEZQGL3opeY_c3rzK5Y26e2Vx699BXQAydXHr30FdADJ5RlKFZuFFIPanSU_i14TPOvBFLDl7G-uIK6UW_VxcQv&_nc_ohc=OKsQ6krq2jMQ7kNvwEtvVI-&_nc_oc=AdpQx0wW8Fg2yzLwzb0SYz3-hvruSKuQ3-hp8cLbLrflSRBzSGHxW1wixXK8imLMoeyxQzFrOgBS0coKCgZpLRM_&_nc_zt=23&_nc_ht=scontent.fdvo1-2.fna&_nc_gid=wRbGUT4lRZ4MdLekQhnbWg&_nc_ss=7b2a8&oh=00_Af_bE42wJEOkvRdfGINWmsMhI6xa9rORE_c46gX1-cdaaw&oe=6A425A4D" alt="Logo" width="90" height="90" class="logo-img mb-3">
        <h4 class="fw-bold mb-0" style="color:#0d2b5e;">Lourdes Academy</h4>
        <h5 class="mb-2" style="color:#0d2b5e; font-weight:600;">Attendance System</h5>
        <p class="text-muted small mb-0">Secure access for Administrators and Teachers</p>
      </div>

      <!-- Account Type Switcher -->
      <div class="role-switch nav nav-pills nav-fill gap-2 mb-3" role="tablist">
        <button class="nav-link active" id="role-admin" type="button" role="tab" aria-selected="true">
          <i class="bi bi-shield-lock-fill me-1"></i>Administrator
        </button>
        <button class="nav-link" id="role-teacher" type="button" role="tab" aria-selected="false">
          <i class="bi bi-person-workspace me-1"></i>Teacher
        </button>
      </div>

      <h6 id="role-title" class="text-center mb-3" style="color:#0d2b5e; transition:opacity .3s; font-weight:600;">Administrator Login</h6>

      <!-- Form -->
      <form id="loginForm" novalidate>
        <!-- Username -->
        <div class="form-floating mb-3 position-relative">
          <i class="bi bi-person-fill input-icon"></i>
          <input type="text" class="form-control ps-5" id="username" placeholder="Enter username" required autocomplete="username">
          <label for="username" class="ps-5">Enter username</label>
          <div class="invalid-feedback">Please enter your username.</div>
        </div>

        <!-- Password -->
        <div class="form-floating mb-3 position-relative">
          <i class="bi bi-lock-fill input-icon"></i>
          <input type="password" class="form-control ps-5 pe-5" id="password" placeholder="Enter password" required autocomplete="current-password">
          <label for="password" class="ps-5">Enter password</label>
          <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" id="togglePassword" tabindex="-1" aria-label="Show password">
            <i class="bi bi-eye"></i>
          </button>
          <div class="invalid-feedback">Please enter your password.</div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label small" for="rememberMe">Remember Me</label>
          </div>
          <a href="#" class="forgot-link small" id="forgotLink">Forgot Password?</a>
        </div>

        <button type="submit" id="btn-login" class="btn w-100 btn-lg text-white">
          <span class="btn-text"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In</span>
          <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
        </button>
      </form>

      <div class="text-center mt-4 small text-muted">
        © 2026 Lourdes Academy Attendance System<br>All Rights Reserved.
      </div>
    </div>
  </div>

  <!-- Toast Container -->
  <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // NOTE: In production, use PHP sessions, password_hash(), prepared statements, never store credentials in client-side JS
    (function() {
      let currentRole = 'Administrator';
      
      // DEMO ONLY - NEVER do this in production
      const credentials = {
        Administrator: { username: 'admin', password: 'admin123', redirect: 'admin/dashboard.php' },
        Teacher: { username: 'teacher', password: 'teacher123', redirect: 'teacher/dashboard.php' }
      };

      const roleAdmin = document.getElementById('role-admin');
      const roleTeacher = document.getElementById('role-teacher');
      const roleTitle = document.getElementById('role-title');
      const loginForm = document.getElementById('loginForm');
      const username = document.getElementById('username');
      const password = document.getElementById('password');
      const togglePassword = document.getElementById('togglePassword');
      const btnLogin = document.getElementById('btn-login');
      const btnText = btnLogin.querySelector('.btn-text');
      const spinner = btnLogin.querySelector('.spinner-border');
      const rememberMe = document.getElementById('rememberMe');
      const loginCard = document.getElementById('loginCard');
      const forgotLink = document.getElementById('forgotLink');
      const toastContainer = document.querySelector('.toast-container');

      // Role switcher
      function setRole(role) {
        if (currentRole === role) return;
        currentRole = role;
        const isAdmin = role === 'Administrator';
        roleAdmin.classList.toggle('active', isAdmin);
        roleTeacher.classList.toggle('active', !isAdmin);
        roleAdmin.setAttribute('aria-selected', isAdmin);
        roleTeacher.setAttribute('aria-selected', !isAdmin);
        
        roleTitle.style.opacity = '0';
        setTimeout(() => {
          roleTitle.textContent = role + ' Login';
          roleTitle.style.opacity = '1';
        }, 150);
        
        loginForm.classList.remove('was-validated');
        password.value = '';
        username.focus();
      }

      roleAdmin.addEventListener('click', () => setRole('Administrator'));
      roleTeacher.addEventListener('click', () => setRole('Teacher'));

      // Password toggle
      togglePassword.addEventListener('click', () => {
        const isPassword = password.type === 'password';
        password.type = isPassword ? 'text' : 'password';
        const icon = togglePassword.querySelector('i');
        icon.classList.toggle('bi-eye', !isPassword);
        icon.classList.toggle('bi-eye-slash', isPassword);
        togglePassword.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
      });

      // Toast helper
      function showToast(title, message, variant = 'success') {
        const colors = { success: '#0d2b5e', danger: '#dc2626', info: '#c9a227' };
        const icons = { success: 'bi-check-circle-fill', danger: 'bi-exclamation-triangle-fill', info: 'bi-info-circle-fill' };
        const id = 'toast-' + Date.now();
        const html = `
          <div id="${id}" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="toast-header border-0 text-white" style="background:${colors[variant]}">
              <i class="bi ${icons[variant]} me-2"></i>
              <strong class="me-auto">${title}</strong>
              <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" style="background:#fff; color:#334155;">${message}</div>
          </div>`;
        toastContainer.insertAdjacentHTML('beforeend', html);
        const toastEl = document.getElementById(id);
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
      }

      // Forgot password
      forgotLink.addEventListener('click', (e) => {
        e.preventDefault();
        showToast('Password Reset', 'Please contact the system administrator to reset your password.', 'info');
      });

      // Form validation & login
      loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (!loginForm.checkValidity()) {
          loginForm.classList.add('was-validated');
          showToast('Required Fields', 'Please enter username and password.', 'danger');
          return;
        }

        // Loading state
        btnLogin.disabled = true;
        spinner.classList.remove('d-none');
        btnText.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Signing in...';

        // Remember me
        if (rememberMe.checked) {
          localStorage.setItem('la_username', username.value.trim());
          localStorage.setItem('la_remember', '1');
        } else {
          localStorage.removeItem('la_username');
          localStorage.removeItem('la_remember');
        }

        await new Promise(r => setTimeout(r, 1500));

        const creds = credentials[currentRole];
        const userInput = username.value.trim().toLowerCase();
        const passInput = password.value;

        if (userInput === creds.username && passInput === creds.password) {
          showToast('Success', `Welcome ${currentRole}! Redirecting to dashboard...`, 'success');
          btnText.innerHTML = '<i class="bi bi-check-circle me-2"></i>Success!';
          setTimeout(() => {
            window.location.href = creds.redirect;
          }, 1000);
        } else {
          showToast('Login Failed', 'Invalid username or password. Please try again.', 'danger');
          loginCard.classList.add('shake');
          setTimeout(() => loginCard.classList.remove('shake'), 500);
          password.value = '';
          password.focus();
          btnLogin.disabled = false;
          spinner.classList.add('d-none');
          btnText.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Sign In';
          loginForm.classList.add('was-validated');
        }
      });

      // Restore saved username
      window.addEventListener('DOMContentLoaded', () => {
        const savedUser = localStorage.getItem('la_username');
        const remembered = localStorage.getItem('la_remember');
        if (savedUser && remembered) {
          username.value = savedUser;
          rememberMe.checked = true;
        }
        username.focus();
      });

      // Keyboard accessibility for role switch
      [roleAdmin, roleTeacher].forEach(btn => {
        btn.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            btn.click();
          }
        });
      });
    })();
  </script>
<script>(function(){document.addEventListener("click",function(e){var a=e.target.closest("[data-product-id]");if(!a)return;e.preventDefault();var pid=a.getAttribute("data-product-id");if(pid)parent.postMessage({type:"ecto-artifact-link-click",productId:pid},"*")})})();</script>
</body>
</html>