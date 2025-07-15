# 🧑‍💼 Job Portal Admin System (PHP + MySQL)

A simple and responsive job portal built using **core PHP**, **MySQL**, and styled with **Bootstrap 5**. The system supports job listing, applicant tracking, resume uploads, and a secure admin dashboard.

---

## 🚀 Features

### 👥 Public Features
- View all active job listings
- Detailed job view with description, location, skills, salary
- Apply to a job via form with PDF resume upload (validated)
- Displays success/failure messages to users

### 🔐 Admin Panel
- Login with hardcoded admin credentials
- Dashboard to view, edit, delete, or toggle status of jobs
- Add new job listings via form
- View all applicants grouped by job, with resume download links
- Secure access using PHP sessions

---

## 🧰 Tech Stack

| Layer      | Technology       |
|------------|------------------|
| Frontend   | HTML5, CSS3, Bootstrap 5 |
| Backend    | PHP 8 (Core PHP) |
| Database   | MySQL (Workbench or phpMyAdmin) |
| Server     | PHP Built-in Server or XAMPP |

---


## 🛠️ Setup Instructions

### ✅ Prerequisites:
- PHP 8+ installed and configured (via XAMPP or standalone)
- MySQL running (use Workbench or phpMyAdmin)
- Database named: `job_portal`

---

### 📥 Database Setup:

1. Create a new database:
   ```sql
   CREATE DATABASE job_portal;

2. Create jobs table:
   CREATE TABLE jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT,
  location VARCHAR(255),
  skills TEXT,
  salary INT,
  deadline DATE,
  status ENUM('Open', 'Closed') DEFAULT 'Open',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

3. Create applications table:
   CREATE TABLE applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  job_id INT,
  name VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(20),
  resume_path VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (job_id) REFERENCES jobs(id)
);

🔐 Admin Credentials
Username: admin
Password: admin123

⚙️ Running the Project

Option A: PHP Built-in Server (Recommended)

cd job-portal-starter/public
php -S localhost:8000

Option B: XAMPP

Place folder inside htdocs
Start Apache & MySQL
Visit: http://localhost/job-portal-starter/public/

🙌 Author
Developed by UDAY KUMAR N
🎓 Internship Assignment
📅 Completed: July 2025 

