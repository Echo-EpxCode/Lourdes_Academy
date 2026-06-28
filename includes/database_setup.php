<?php
/**
 * database_setup.php
 * Auto create database and tables if they do not exist.
 */

$host = "localhost";
$username = "root";
$password = "";
$database = "laas_db";

try {

    // Connect without selecting database first
    $conn = new mysqli($host, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if database exists
    $result = $conn->query("SHOW DATABASES LIKE '$database'");

    if ($result->num_rows == 0) {

        echo "Database not found. Creating database...<br>";

        // Create database
        $sql = "CREATE DATABASE $database CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

        if ($conn->query($sql) === TRUE) {

            echo "Database created successfully.<br>";

            // Select database
            $conn->select_db($database);

            // SQL script
            $queries = [

                "CREATE TABLE admins (
                    admin_id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(50) UNIQUE NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    full_name VARCHAR(100) NOT NULL,
                    email VARCHAR(100) UNIQUE NOT NULL,
                    profile_image VARCHAR(255) DEFAULT 'default.png',
                    status ENUM('Active','Inactive') DEFAULT 'Active',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )",

                "CREATE TABLE grade_levels (
                    grade_id INT AUTO_INCREMENT PRIMARY KEY,
                    grade_name VARCHAR(20) NOT NULL,
                    grade_order TINYINT NOT NULL
                )",

                "CREATE TABLE teachers (
                    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
                    teacher_code VARCHAR(20) UNIQUE NOT NULL,
                    first_name VARCHAR(50) NOT NULL,
                    middle_name VARCHAR(50),
                    last_name VARCHAR(50) NOT NULL,
                    gender ENUM('Male','Female') NOT NULL,
                    birthdate DATE,
                    address TEXT,
                    contact_number VARCHAR(11),
                    email VARCHAR(100) UNIQUE NOT NULL,
                    department VARCHAR(50),
                    username VARCHAR(50) UNIQUE NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    profile_image VARCHAR(255) DEFAULT 'default.png',
                    status ENUM('Active','Inactive') DEFAULT 'Active',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )",

                "CREATE TABLE sections (
                    section_id INT AUTO_INCREMENT PRIMARY KEY,
                    section_name VARCHAR(50) NOT NULL,
                    grade_id INT NOT NULL,
                    school_year VARCHAR(9) NOT NULL,
                    adviser_id INT NULL,
                    FOREIGN KEY (grade_id) REFERENCES grade_levels(grade_id),
                    FOREIGN KEY (adviser_id) REFERENCES teachers(teacher_id)
                    ON DELETE SET NULL
                )",

                "CREATE TABLE students (
                    student_id INT AUTO_INCREMENT PRIMARY KEY,
                    lrn CHAR(12) UNIQUE NOT NULL,
                    first_name VARCHAR(50) NOT NULL,
                    middle_name VARCHAR(50),
                    last_name VARCHAR(50) NOT NULL,
                    gender ENUM('Male','Female') NOT NULL,
                    birthdate DATE NOT NULL,
                    address TEXT NOT NULL,
                    grade_id INT NOT NULL,
                    section_id INT NOT NULL,
                    school_year VARCHAR(9) NOT NULL,
                    parent_name VARCHAR(100) NOT NULL,
                    parent_email VARCHAR(100) NOT NULL,
                    parent_contact VARCHAR(11) NOT NULL,
                    status ENUM('Active','Inactive','Transferred') DEFAULT 'Active',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (grade_id) REFERENCES grade_levels(grade_id),
                    FOREIGN KEY (section_id) REFERENCES sections(section_id)
                )",

                "CREATE TABLE qr_codes (
                    qr_id INT AUTO_INCREMENT PRIMARY KEY,
                    student_id INT UNIQUE NOT NULL,
                    qr_value VARCHAR(100) UNIQUE NOT NULL,
                    qr_image_path VARCHAR(255) NOT NULL,
                    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    status ENUM('Active','Revoked') DEFAULT 'Active',
                    FOREIGN KEY (student_id)
                    REFERENCES students(student_id)
                    ON DELETE CASCADE
                )",

                "CREATE TABLE attendance (
                    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
                    student_id INT NOT NULL,
                    scan_date DATE NOT NULL,
                    time_in TIME NULL,
                    time_out TIME NULL,
                    status ENUM('Present','Late','Absent') NOT NULL,
                    scan_type ENUM('Time In','Time Out') NOT NULL,
                    late_minutes INT DEFAULT 0,
                    scanner_device VARCHAR(50) DEFAULT 'Main Gate',
                    remarks TEXT,
                    recorded_by INT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (student_id)
                    REFERENCES students(student_id)
                    ON DELETE CASCADE,
                    FOREIGN KEY (recorded_by)
                    REFERENCES teachers(teacher_id)
                    ON DELETE SET NULL,
                    UNIQUE KEY unique_daily (student_id, scan_date, scan_type)
                )",

                "CREATE TABLE email_logs (
                    email_id INT AUTO_INCREMENT PRIMARY KEY,
                    student_id INT NOT NULL,
                    attendance_id INT NULL,
                    recipient_email VARCHAR(100) NOT NULL,
                    subject VARCHAR(200) NOT NULL,
                    message TEXT NOT NULL,
                    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    status ENUM('Sent','Failed') NOT NULL,
                    error_message TEXT,
                    FOREIGN KEY (student_id)
                    REFERENCES students(student_id),
                    FOREIGN KEY (attendance_id)
                    REFERENCES attendance(attendance_id)
                )"
            ];

            foreach ($queries as $query) {
                if ($conn->query($query) === TRUE) {
                    echo "Table created successfully.<br>";
                } else {
                    echo "Error: " . $conn->error . "<br>";
                }
            }

            // Insert default admin
            $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);

            $insertAdmin = "
                INSERT INTO admins
                (username, password, full_name, email)
                VALUES
                (
                    'admin',
                    '$adminPassword',
                    'System Administrator',
                    'admin@laas.com'
                )
            ";

            if ($conn->query($insertAdmin) === TRUE) {
                echo "Default admin account created.<br>";
            }

            echo "<br><strong>Setup completed successfully!</strong>";

        } else {
            die("Error creating database: " . $conn->error);
        }

    }

    $conn->close();

} catch (Exception $e) {

    die("Setup Error: " . $e->getMessage());

}
?>