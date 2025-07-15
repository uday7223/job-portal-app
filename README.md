# Job Application Portal (PHP + MySQL)

A simple full-stack job portal application built using PHP, MySQL, and vanilla JavaScript.

## 📁 Features

### Admin
- Secure login with session-based access
- Add, edit, delete job listings
- Toggle job status (Open/Closed)
- View applicants per job
- Download resumes

### Public
- View job listings
- Job detail page
- Apply to a job with resume (PDF only)
- Prevent duplicate applications (same email per job)

## ⚙️ Technologies Used
- PHP (Built-in server)
- MySQL (Workbench/XAMPP-compatible)
- HTML, CSS, JavaScript
- File uploads (resume PDF)
- Sessions for login handling

## 🚀 Setup Instructions

1. **Start MySQL** using MySQL Workbench or any MySQL server.
2. **Create the Database:**
   ```sql
   CREATE DATABASE job_portal;
   ```
3. **Import Tables:** Run the following SQL to create the required tables:
   ```sql
   -- JOBS table
   CREATE TABLE jobs (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255),
     description TEXT,
     location VARCHAR(100),
     skills VARCHAR(255),
     salary INT,
     deadline DATE,
     status VARCHAR(10) DEFAULT 'Open',
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   -- APPLICATIONS table
   CREATE TABLE applications (
     id INT AUTO_INCREMENT PRIMARY KEY,
     job_id INT,
     name VARCHAR(100),
     email VARCHAR(100),
     phone VARCHAR(20),
     resume_path VARCHAR(255),
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

4. **Run PHP Server** from project folder:
   ```bash
   cd job-portal-starter/public
   php -S localhost:8000
   ```

5. **Access URLs:**
   - Admin Login: `http://localhost:8000/../admin/login.php`
   - Public Jobs Page: `http://localhost:8000/`

## 📝 Credentials

- **Admin Username:** `admin`
- **Admin Password:** `admin123`

---

## 📂 Folder Structure

```
admin/           → Admin dashboard, login, job management  
public/          → Public job list, apply form  
includes/        → DB connection  
uploads/         → Uploaded resumes  
```

---

## ✅ Notes

- All forms use prepared statements  
- Uploads are stored safely with unique names  
- Session checks prevent unauthorized access  

---

Built with 💻 by [Your Name]
