# Blog Management System

A lightweight, responsive web application for managing blog posts with full CRUD capabilities and rich-text editing.

## Features

- **Full CRUD Support:** Create, read, update, and delete blog posts.
- **Rich Text Editor:** Integrated CKEditor 4 for formatting article content.
- **Dedicated Reading View:** View complete articles with titles, timestamps, and formatted content.
- **Responsive Interface:** Modern, mobile-friendly UI built with Bootstrap 4 and Bootstrap Icons.
- **Secure Queries:** Parameterized MySQLi prepared statements to protect against SQL injection.
- **Zero Local Dependencies:** Uses CDN links for fast loading and low repository footprint.

## Tech Stack

- **Backend:** PHP 8+
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 4, Bootstrap Icons, CKEditor 4

## Project Structure

```text
blogms/
├── .gitignore
├── connection.php
├── create.php
├── database.sql
├── del.php
├── index.php
├── view.php
└── README.md
```

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or any Apache + MySQL PHP environment)
- Web browser

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/<your-username>/<your-repo-name>.git C:/xampp/htdocs/blogms
   ```

2. **Start the local server:**
   - Open XAMPP Control Panel.
   - Start **Apache** and **MySQL**.

3. **Set up the database:**
   - Open [phpMyAdmin](http://localhost/phpmyadmin).
   - Create a database named `blog_db` (or import `database.sql` directly).
   - Import the `database.sql` file provided in the repository root.

4. **Verify database connection:**
   - Check `connection.php` to ensure the credentials match your local MySQL configuration:
     ```php
     $host = 'localhost';
     $user = 'root';
     $password = '';
     $dbname = 'blog_db';
     ```

5. **Run the application:**
   - Open your browser and navigate to:
     ```
     http://localhost/blogms
     ```

## License

This project is open-source and available under the [MIT License](LICENSE).
