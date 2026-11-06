# Employee Training Management System

A two-application system developed with Laravel and PostgreSQL to manage employees, trainings, and training assignments.

## Architecture

The project consists of two independent Laravel applications:

### 1. Employee API
- Manages employee records.
- Provides RESTful API endpoints for employee CRUD operations.
- Uses Bearer Token authentication to secure API access.

### 2. Training Portal
- Retrieves employee information through the Employee REST API.
- Creates, updates, and deletes trainings.
- Assigns trainings to employees.
- Tracks training completion status.

## System Architecture

```text
EmployeeTrainingSystem
│
├── employee_api_app/
│   └── Employee Management
│       └── PostgreSQL: employee_database
│
└── training_portal_app/
    └── Training Management
        └── PostgreSQL: training_database
```

The applications use separate databases and communicate exclusively through REST API requests. The Training Portal does not directly access the Employee API database.

## Development Environment

- Visual Studio Code
- Laravel Herd
- PostgreSQL

## Technologies

- PHP 8.4.24
- Laravel 13.40.0
- PostgreSQL
- REST API
- Laravel HTTP Client
- Bearer Token Authentication
- Bootstrap 5

## Requirements

- PHP 8.4.24
- Laravel 13.40.0
- Composer
- PostgreSQL

## Installation

### Prerequisites
- PHP 8.4.24
- Laravel 13.40.0
- Composer
- PostgreSQL

### 1. Clone the repository

git clone https://github.com/ac265/EmployeeTrainingSystem.git
cd EmployeeTrainingSystem

### 2. Set up Employee API

cd employee_api_app
composer install
cp .env.example .env
php artisan key:generate

Configure the PostgreSQL database and API token in `.env`.

php artisan migrate

### 3. Set up Training Portal

cd ../training_portal_app
composer install
cp .env.example .env
php artisan key:generate

Configure the PostgreSQL database and Employee API settings in `.env`.

php artisan migrate

### 4. Run the applications

Start Employee API:

cd employee_api_app
php artisan serve --port=8000

Start Training Portal in another terminal:

cd training_portal_app
php artisan serve --port=8001

## Running the Applications

Start the Employee API:

```bash
cd employee_api_app
php artisan serve --port=8000
```

Start the Training Portal in a separate terminal:

```bash
cd training_portal_app
php artisan serve --port=8001
```

## Application URLs

- Employee API: http://127.0.0.1:8000
- Employee API endpoint: http://127.0.0.1:8000/api/employees
- Training Portal: http://127.0.0.1:8001

## Security

API communication is protected using Bearer Token authentication. The Employee API validates incoming tokens through middleware. Invalid or missing tokens receive a `401 Unauthorized` response.

Each application has its own environment configuration and database.

## Project Structure

```text
EmployeeTrainingSystem/
├── employee_api_app/
├── training_portal_app/
├── screenshots
└── README.md
```

## Screenshots

### Employee Management
![Employee Management](screenshots/employee-management.png)

### Training Management
![Training Management](screenshots/training-management.png)

### Training Employees
![Training Employees](screenshots/training-emplooyes.png)

### Training Assignments
![Training Assignments](screenshots/training-assignments.png)

### Training Status
![Training Status](screenshots/training-status.png)

## Demo

[Watch Project Demo](screenshots/demo.mp4)