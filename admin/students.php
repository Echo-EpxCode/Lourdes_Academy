<?php
  session_start();
?>

<!-- // ===== SESSION MESSAGES ===== -->
<?php if (isset($_SESSION['success_msg'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success_msg']; ?>
    </div>
    <?php unset($_SESSION['success_msg']); ?>
<?php endif; ?>


<?php
// ===== BACKEND PLACEHOLDER - Native PHP MySQLi =====
require_once '../includes/database.php';
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }


// Handle Form Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    // Sanitize inputs
    $lrn = trim($_POST['lrn'] ?? '');
    $birthdate = $_POST['birthdate'] ?? '';
    $first_name = trim($_POST['first_name'] ?? '');
    $middle_name = trim($_POST['middle_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $grade_id = $_POST['grade_id'] ?? null;

    $section_id = $_POST['section_id'] ?? null;

    $parent_name = trim($_POST['parent_name'] ?? '');
    $parent_email = trim($_POST['parent_email'] ?? '');
    $parent_contact = trim($_POST['parent_contact'] ?? '');
    $school_year = trim($_POST['school_year'] ?? '');

    // ===== BACKEND VALIDATION =====
    $errors = [];
    if (!preg_match('/^\d{12}$/', $lrn)) $errors[] = "LRN must be exactly 12 digits";
    if (!filter_var($parent_email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid parent email";
    if (!preg_match('/^09\d{9}$/', $parent_contact)) $errors[] = "Contact must be 11 digits starting with 09";
   
    if (empty($errors)) {

        if ($action === 'create') {

            // Check if LRN already exists
            $check = $conn->prepare("SELECT student_id FROM students WHERE lrn = ?");
            $check->bind_param("s", $lrn);
            $check->execute();
            $result = $check->get_result();

            if ($result->num_rows > 0) {
                $error_msg = "LRN already exists. Please use a different LRN.";
            } else {
                $stmt = $conn->prepare("
                    INSERT INTO students (
                        lrn, first_name, middle_name, last_name, gender, birthdate,
                        address, grade_id, section_id, school_year,
                        parent_name, parent_email, parent_contact, status
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");

                $stmt->bind_param(
                    "sssssssiiissss",
                    $lrn,
                    $first_name,
                    $middle_name,
                    $last_name,
                    $gender,
                    $birthdate,
                    $address,
                    $grade_id,
                    $section_id,
                    $school_year,
                    $parent_name,
                    $parent_email,
                    $parent_contact,
                    $status
                );

                try {
                    if ($stmt->execute()) {
                        $_SESSION['success_msg'] = "Student registered successfully!";
                        header("Location: students.php");
                        exit();
                    } else {
                        $error_msg = "Failed to register student.";
                    }
                } catch (mysqli_sql_exception $e) {
                    if ($e->getCode() == 1062) {
                        $error_msg = "LRN already exists. Please use a different LRN.";
                    } else {
                        throw $e;
                    }
                }

                $stmt->close();
            }

            $check->close();
        }

        elseif ($action === 'update') {

            $stmt = $conn->prepare("
                UPDATE students
                SET first_name = ?, middle_name = ?, last_name = ?, gender = ?, birthdate = ?,
                    address = ?, grade_id = ?, section_id = ?, school_year = ?,
                    parent_name = ?, parent_email = ?, parent_contact = ?, status = ?
                WHERE lrn = ?
            ");

            $stmt->bind_param(
                "ssssssiiisssss",
                $first_name,
                $middle_name,
                $last_name,
                $gender,
                $birthdate,
                $address,
                $grade_id,
                $section_id,
                $school_year,
                $parent_name,
                $parent_email,
                $parent_contact,
                $status,
                $lrn
            );

            if ($stmt->execute()) {
                $_SESSION['success_msg'] = "Student updated successfully!";
                header("Location: students.php");
                exit();
            } else {
                $error_msg = "Failed to update student: " . $stmt->error;
            }

            $stmt->close();
        }

        elseif ($action === 'delete') {

            $stmt = $conn->prepare("DELETE FROM students WHERE lrn = ?");
            $stmt->bind_param("s", $lrn);

            if ($stmt->execute()) {
                $_SESSION['success_msg'] = "Student deleted successfully!";
                header("Location: students.php");
                exit();
            } else {
                $error_msg = "Failed to delete student: " . $stmt->error;
            }

            $stmt->close();
        }

    } else {
        $error_msg = implode(", ", $errors);
    }

}

// ===== FETCH STUDENTS PLACEHOLDER =====
$result = $conn->query("SELECT * FROM students ORDER BY created_at DESC");
$students = $result->fetch_all(MYSQLI_ASSOC);
?>


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
    <!-- <?php //include 'components/loader.php'; ?> -->

    <!-- Sidebar Backdrop (mobile) -->
    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

    <!-- ===== TOP NAVBAR ===== -->
    <?php include 'components/navbar.php'; ?>

    <!-- ===== SIDEBAR ===== -->
    <?php include 'components/sidebar.php'; ?>

    <!-- ===== MAIN CONTENT ===== -->
<main id="main" class="main">

  <!-- ===== PAGE HEADER ===== -->
  <div class="pagetitle">
    <h1 style="color:#0d2b5e; font-weight:600;">Student Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#" style="color:#0d2b5e; text-decoration:none;">Dashboard</a></li>
        <li class="breadcrumb-item active">Students</li>
      </ol>
    </nav>
  </div>

    <!-- Success Alert -->
    <?php if (isset($_SESSION['success_msg'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        <?= htmlspecialchars($_SESSION['success_msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['success_msg']); ?>
    <?php endif; ?>

    <!-- Error Alert -->
    <?php if (!empty($error_msg)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <?= htmlspecialchars($error_msg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

  <!-- ===== ROW 1 - ACTION BUTTON ===== -->
  <section class="section">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0" style="color:#0d2b5e;">Manage Students</h5>
      <button type="button" class="btn text-white px-4" style="background:#0d2b5e; border-radius:10px;" data-bs-toggle="modal" data-bs-target="#registerStudentModal">
        <i class="bi bi-plus-lg me-2"></i>Register Student
      </button>
    </div>
  </section>

  <!-- ===== ROW 2 - STUDENTS TABLE ===== -->
  <section class="section">
    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-header bg-white border-0 pt-3 pb-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
          <h5 class="card-title mb-0" style="color:#0d2b5e;"><i class="bi bi-people-fill me-2"></i>Student Records</h5>
          <div class="d-flex gap-2">
            <div class="input-group input-group-sm" style="width:250px;">
              <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
              <input type="text" id="searchStudents" class="form-control bg-light border-start-0" placeholder="Search students...">
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle" id="studentsTable">
            <thead style="background:#f8fafc;">
              <tr>
                <th>LRN</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Parent / Guardian</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($students)): ?>
              <tr id="empty-state">
                <td colspan="8" class="text-center py-5">
                  <i class="bi bi-inbox" style="font-size:3rem; color:#dee2e6;"></i>
                  <p class="text-muted mt-2 mb-0">No student records found</p>
                  <small class="text-muted">Click "Register Student" to add your first student</small>
                </td>
              </tr>
              <?php else: ?>
                <?php foreach($students as $student): 
                  $full_name = $student['last_name'] . ', ' . $student['first_name'] . ' ' . $student['middle_name'];
                ?>
                <tr>
                  <td><span class="fw-semibold"><?= htmlspecialchars($student['lrn']) ?></span></td>
                  <td><?= htmlspecialchars($full_name) ?></td>
                  <td><?= htmlspecialchars($student['gender']) ?></td>
                  <td><?= htmlspecialchars($student['parent_name']) ?></td>
                  <td><small><?= htmlspecialchars($student['parent_email']) ?></small></td>
                  <td><?= htmlspecialchars($student['parent_contact']) ?></td>
                  <td><span class="badge bg-success"><?= htmlspecialchars($student['status']) ?></span></td>
                  <td class="text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary btn-view" data-lrn="<?= $student['lrn'] ?>" title="View"><i class="bi bi-eye"></i></button>
                      <button class="btn btn-outline-warning btn-edit" data-lrn="<?= $student['lrn'] ?>" title="Edit"><i class="bi bi-pencil"></i></button>
                      <button class="btn btn-outline-danger btn-delete" data-lrn="<?= $student['lrn'] ?>" data-name="<?= htmlspecialchars($full_name) ?>" title="Delete"><i class="bi bi-trash"></i></button>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== REGISTER STUDENT MODAL ===== -->
<div class="modal fade" id="registerStudentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header" style="background:#0d2b5e; color:white; border-radius:1rem 1rem 0 0;">
        <h5 class="modal-title"><i class="bi bi-person-plus me-2"></i>Register New Student</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form id="studentForm" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="action" value="create">

        <div class="modal-body p-4" style="max-height:70vh; overflow-y:auto;">
          <!-- Personal Information -->
          <h6 class="mb-3" style="color:#0d2b5e;">
            <i class="bi bi-person-badge me-2"></i>Personal Information
          </h6>

          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">LRN <span class="text-danger">*</span></label>
              <input type="text" name="lrn" class="form-control" placeholder="12-digit LRN" pattern="\d{12}" maxlength="12" required>
              <div class="invalid-feedback">LRN must be exactly 12 digits</div>
              <small class="text-muted">Learner Reference Number</small>
            </div>

            <div class="col-md-6">
              <label class="form-label">Birthdate <span class="text-danger">*</span></label>
              <input type="date" name="birthdate" class="form-control" required>
              <div class="invalid-feedback">Birthdate is required</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">First Name <span class="text-danger">*</span></label>
              <input type="text" name="first_name" class="form-control" placeholder="Juan" required>
              <div class="invalid-feedback">First name required</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">Middle Name</label>
              <input type="text" name="middle_name" class="form-control" placeholder="Santos">
            </div>

            <div class="col-md-4">
              <label class="form-label">Last Name <span class="text-danger">*</span></label>
              <input type="text" name="last_name" class="form-control" placeholder="Dela Cruz" required>
              <div class="invalid-feedback">Last name required</div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Gender <span class="text-danger">*</span></label>
              <select name="gender" class="form-select" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <div class="invalid-feedback">Please select gender</div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Address <span class="text-danger">*</span></label>
              <input type="text" name="address" class="form-control" placeholder="Complete address" required>
              <div class="invalid-feedback">Address required</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">Grade Level <span class="text-danger">*</span></label>
              <select name="grade_id" class="form-select" required>
                <option value="">Select Grade Level</option>
                <option value="1">Grade 1</option>
                <option value="2">Grade 2</option>
                <option value="3">Grade 3</option>
                <option value="4">Grade 4</option>
                <option value="5">Grade 5</option>
                <option value="6">Grade 6</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
                <option value="11">Grade 11</option>
                <option value="12">Grade 12</option>
              </select>
              <div class="invalid-feedback">Please select grade level</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">Section <span class="text-danger">*</span></label>
              <select name="section_id" class="form-select" required>
                <option value="">Select Section</option>
                <!-- Load dynamically based on selected grade -->
                <option value="1">St. Mary</option>
                <option value="2">St. Joseph</option>
                <option value="3">St. John</option>
                <option value="4">St. Peter</option>
                <option value="5">St. Paul</option>
                <option value="6">St. Luke</option>
                <option value="7">St. Matthew</option>
                <option value="8">St. Mark</option>
                <option value="9">St. James</option>
                <option value="10">St. Michael</option>
              </select>
              <div class="invalid-feedback">Please select section</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">School Year <span class="text-danger">*</span></label>
              <input type="text" name="school_year" class="form-control" placeholder="2025-2026" pattern="\d{4}-\d{4}" required>
              <div class="invalid-feedback">Use format 2025-2026</div>
            </div>
          </div>

          <!-- Parent/Guardian Information -->
          <h6 class="mb-3" style="color:#0d2b5e;">
            <i class="bi bi-people me-2"></i>Parent / Guardian Information
          </h6>

          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Parent / Guardian Name <span class="text-danger">*</span></label>
              <input type="text" name="parent_name" class="form-control" placeholder="Full name" required>
              <div class="invalid-feedback">Parent name required</div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" name="parent_email" class="form-control" placeholder="parent@email.com" required>
              <div class="invalid-feedback">Valid email required</div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Contact Number <span class="text-danger">*</span></label>
              <input type="tel" name="parent_contact" class="form-control" placeholder="09171234567" pattern="09\d{9}" maxlength="11" required>
              <div class="invalid-feedback">Must be 11 digits starting with 09</div>
            </div>
          </div>
        </div>

        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="reset" class="btn btn-outline-secondary">Clear</button>
          <button type="submit" class="btn text-white" style="background:#0d2b5e;" id="btnSave">
            <span class="btn-text"><i class="bi bi-check-lg me-1"></i>Save Student</span>
            <span class="spinner-border spinner-border-sm ms-2 d-none"></span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded-4">
        <div class="modal-body text-center p-4">
          <i class="bi bi-exclamation-triangle text-danger" style="font-size:3rem;"></i>
          <h5 class="mt-3">Delete Student?</h5>
          <p class="text-muted" id="deleteText">This action cannot be undone.</p>
          <form method="POST" id="deleteForm">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="lrn" id="deleteLrn">
            <div class="d-flex gap-2 justify-content-center mt-3">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Frontend Validation
    (function() {
      const form = document.getElementById('studentForm');
      form.addEventListener('submit', function(e) {
        // LRN validation
        const lrn = form.lrn.value;
        if (!/^\d{12}$/.test(lrn)) {
          e.preventDefault(); e.stopPropagation();
          form.lrn.classList.add('is-invalid');
          return;
        }
        // Contact validation
        const contact = form.parent_contact.value;
        if (!/^09\d{9}$/.test(contact)) {
          e.preventDefault(); e.stopPropagation();
          form.parent_contact.classList.add('is-invalid');
          return;
        }
        
        if (!form.checkValidity()) {
          e.preventDefault(); e.stopPropagation();
        } else {
          // Show loading
          const btn = document.getElementById('btnSave');
          btn.disabled = true;
          btn.querySelector('.btn-text').innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Saving...';
          btn.querySelector('.spinner-border').classList.remove('d-none');
        }
        form.classList.add('was-validated');
      });

      // LRN input - digits only
      form.lrn.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0,12);
      });
      
      // Contact input - digits only
      form.parent_contact.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0,11);
      });
    })();

    // Search functionality
    document.getElementById('searchStudents').addEventListener('input', function(e) {
      const q = e.target.value.toLowerCase();
      document.querySelectorAll('#studentsTable tbody tr').forEach(tr => {
        if (tr.id === 'empty-state') return;
        tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
      });
    });

    // Delete button
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function() {
        document.getElementById('deleteLrn').value = this.dataset.lrn;
        document.getElementById('deleteText').textContent = `Delete ${this.dataset.name}? This cannot be undone.`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
      });
    });

    // Edit button - populate modal (placeholder)
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', function() {
        // TODO: Fetch student data via AJAX and populate form
        // For now, just open modal
        alert('Edit functionality: Load student ' + this.dataset.lrn + ' data here');
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