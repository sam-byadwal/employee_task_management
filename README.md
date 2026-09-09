# Employee Task Management System

A web-based Employee Task Management System built with Laravel. The system provides separate Admin and Employee access with role-based authorization, employee management, task assignment, task status management, comments, and secure task access.

---

## Technology Used

* PHP
* Laravel
* MySQL
* Blade
* Tailwind CSS
* JavaScript
* Git & GitHub

---

## PHP Version

```text
PHP 8.2.12
```

## Laravel Version

```text
Laravel 12.69.2
```

---

## Features

### Admin

* Admin login and logout
* Admin dashboard
* Employee CRUD
* Activate/deactivate employees
* Assign tasks to employees
* View employee tasks
* Reassign tasks
* Create and manage tasks
* Delete tasks
* View task comments
* Manage employee access

### Employee

* Employee login and logout
* Employee dashboard
* View assigned tasks
* View task details
* Update task status
* Add comments to assigned tasks
* Employees cannot access tasks assigned to other employees

---

## Installation Steps

### 1. Clone the Repository

Clone the project from GitHub:

```bash
git clone <repository-url>
```

Then enter the project directory:

```bash
cd employee_task_management
```

### 2. Install Composer Dependencies

```bash
composer install
```

### 3. Create Environment File

Create the `.env` file from `.env.example`.

Windows:

```powershell
copy .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

## Environment Configuration

Open the `.env` file and configure the database:

```env
APP_NAME="Employee Task Management"
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_task_management
DB_USERNAME=root
DB_PASSWORD=
```

Update `DB_USERNAME` and `DB_PASSWORD` according to your local MySQL configuration.

---

## Database Setup

Create a MySQL database named:

```text
employee_task_management
```

You can create the database using phpMyAdmin or MySQL.

After creating the database, verify the database configuration in `.env`.

---

## Migration

Run the database migrations:

```bash
php artisan migrate
```

This creates the required application tables.

---

## Seeder

The project includes seed data for Admin, Employees, Tasks, and Comments.

Run:

```bash
php artisan db:seed
```

### Fresh Database

To completely recreate the database and run all seeders:

```bash
php artisan migrate:fresh --seed
```

> Warning: `migrate:fresh` deletes all existing database tables and their data.

---

## Login Credentials

### Admin

```text
Email: admin@example.com
Password: password
```

### Employee 1

```text
Email: employee1@example.com
Password: password
```

### Employee 2

```text
Email: employee2@example.com
Password: password
```

### Employee 3

```text
Email: employee3@example.com
Password: password
```

---

## Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

The application will normally be available at:

```text
http://127.0.0.1:8000
```

### Admin Login

```text
/admin/login
```

### Employee Login

```text
/employee/login
```

---

## Project Structure

```text
employee_task_management/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   └── Employee/
│   │   ├── Middleware/
│   │   └── Requests/
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Task.php
│   │   └── Comment.php
│   │
│   └── Policies/
│       └── TaskPolicy.php
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   └── views/
│       ├── admin/
│       └── employee/
│
├── routes/
│   └── web.php
│
├── storage/
│
├── .env
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

## Authorization and Security

The application uses Laravel middleware and Policy-based authorization to protect different areas of the system.

### Admin Authorization

Admin routes are protected using the `admin` middleware.

The middleware checks:

* User is authenticated
* User has the `admin` role
* User account is active

Unauthorized users cannot access Admin routes.

### Employee Authorization

Employee routes are protected using the `employee` middleware.

Employees can only access employee functionality after successful authentication.

### Task Authorization

Laravel `TaskPolicy` is used for task-level authorization.

Employees can:

* View their own assigned tasks
* Update the status of their own assigned tasks
* Add comments to their own assigned tasks

Employees cannot access or modify tasks assigned to another employee.

Authorization is checked on the server side using Laravel Policy methods such as:

```php
$this->authorize('view', $task);
```

```php
$this->authorize('updateStatus', $task);
```

```php
$this->authorize('comment', $task);
```

Therefore, simply changing a task ID in the URL cannot bypass authorization. If an employee attempts to access another employee's task, Laravel returns a `403 Forbidden` response.

Frontend button hiding is not used as the primary security mechanism. Authorization is enforced on the server.

---

## Task Comments and Deletion

Task comments have a foreign key relationship with tasks.

The comments table uses:

```php
->cascadeOnDelete();
```

Therefore, when an admin deletes a task, all comments related to that task are automatically deleted by the database.

This prevents orphan comments and maintains database consistency.

---

## Employee Deletion and Task Reassignment

Before deleting an employee, assigned tasks should be reassigned to another active employee.

The system provides an employee task view where the admin can identify and reassign assigned tasks.

The database relationship uses a restrictive delete strategy so that an employee cannot accidentally be deleted while tasks are still assigned to that employee.

This protects task data and prevents orphaned task assignments.

---

## Validation

Laravel validation is used for user input such as:

* Employee name
* Email
* Password
* Task title
* Task description
* Task assignment
* Task priority
* Task status
* Due date
* Comments

Database-level constraints and Laravel validation are used together to maintain data integrity.

---

## Database Relationships

### User → Tasks

An employee can have many assigned tasks.

```text
User
  └── hasMany(Task)
```

### Task → Employee

A task belongs to an assigned employee.

```text
Task
  └── belongsTo(User)
```

### Task → Creator

A task belongs to the user who created it.

```text
Task
  └── belongsTo(User)
```

### Task → Comments

A task can have multiple comments.

```text
Task
  └── hasMany(Comment)
```

### Comment → Task

Each comment belongs to one task.

```text
Comment
  └── belongsTo(Task)
```

### Comment → User

Each comment belongs to the user who created it.

```text
Comment
  └── belongsTo(User)
```

---

## Git

The project uses Git for version control.

Meaningful commits are used to describe project changes, for example:

```text
chore: initialize employee task management project
prevent employees from accessing other tasks
```

The main development branch used during development is:

```text
staging
```

---

## Important Commands

Install dependencies:

```bash
composer install
```

Generate application key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Run seeders:

```bash
php artisan db:seed
```

Reset database and seed:

```bash
php artisan migrate:fresh --seed
```

Clear Laravel cache:

```bash
php artisan optimize:clear
```

Start development server:

```bash
php artisan serve
```

Check routes:

```bash
php artisan route:list
```

---

## Conclusion

The Employee Task Management System demonstrates Laravel fundamentals including authentication, role-based access control, CRUD operations, Eloquent relationships, validation, authorization policies, middleware, database constraints, task management, comments, and Git-based version control.
