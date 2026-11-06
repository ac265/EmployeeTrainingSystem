# Employee Training System

## 1. Employee Management System

It is employee_api_app.

A RESTful API-based Employee Management System developed with **PHP, Laravel, and PostgreSQL**.

This application manages employee information and provides secure REST API endpoints for integration with an independent Training Portal application.

### Project Overview

The Employee Management System is designed to manage employee records and share employee data with external applications through a REST API.

The system provides:
- Employee management (Create, Read, Update, Delete).
- RESTful API endpoints for employee data.
- Bearer Token authentication for API access.
- PostgreSQL database integration.
- A web-based employee management interface.

### Technologies

| Technology | Purpose |
|---|---|
| PHP | Backend development |
| Laravel | MVC framework |
| PostgreSQL | Database |
| Eloquent ORM | Database operations |
| Blade | Server-side views |
| Bootstrap 5 | UI styling |
| REST API | System integration |
| Bearer Token | API authentication |

### Architecture

The Employee Management System operates independently from the Training Portal.

```text
Employee Management System
          |
          v
     Laravel Backend
          |
          v
      PostgreSQL
          |
          v
       REST API
          |
     Bearer Token
          |
          v
     Training Portal
```

Each application maintains its own database. Employee information is accessed by the Training Portal through authenticated API requests rather than direct database access.

### Database Structure

#### Employees

| Column | Type | Description |
|---|---|---|
| id | BIGINT | Primary key |
| first_name | VARCHAR | Employee first name |
| last_name | VARCHAR | Employee last name |
| email | VARCHAR | Unique email address |
| department | VARCHAR | Employee department |
| created_at | TIMESTAMP | Creation date |
| updated_at | TIMESTAMP | Last update date |

### REST API Endpoints

All API endpoints require a valid Bearer Token.

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/employees` | Retrieve all employees |
| GET | `/api/employees/{id}` | Retrieve an employee |
| POST | `/api/employees` | Create an employee |
| PUT | `/api/employees/{id}` | Update an employee |
| DELETE | `/api/employees/{id}` | Delete an employee |

#### Example Request

**POST** `/api/employees`

```json
{
    "first_name": "Ozan",
    "last_name": "Özkurt",
    "email": "ozan.özkurt@ardicotomotiv.com.tr",
    "department": "Data Management"
}
```

### Example Response

```json
{
    "success": true,
    "message": "Employee created successfully.",
    "data": {
        "id": 1,
    "first_name": "Ozan",
    "last_name": "Özkurt",
    "email": "ozan.özkurt@ardicotomotiv.com.tr",
    "department": "Data Management"
    }
}
```

### Security

The API uses Bearer Token authentication to protect employee data.

Security measures include:

- Token validation through custom Laravel Middleware.
- Unauthorized requests return HTTP 401.
- Environment variables are used to store sensitive configuration.
- Laravel request validation is applied to incoming data.
- HTTPS is recommended for production environments.

### Installation

#### 1. Clone the repository

```bash
git clone https://github.com/ac265/EmployeeTrainingSystem.git
cd employee_api_app
```

#### 2. Install dependencies

```bash
composer install
```

#### 3. Configure environment variables

```bash
cp .env.example .env
```

Configure your PostgreSQL database credentials in `.env`:

```env
APP_NAME="EmployeeAPI"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=employee_database
DB_USERNAME=postgres
DB_PASSWORD=your_database_password

SESSION_DRIVER=file

EMPLOYEE_API_TOKEN=your_secure_random_token
```

Create the PostgreSQL database named `employee_database` before running migrations.

#### 4. Generate application key

```bash
php artisan key:generate
```

#### 5. Run database migrations

```bash
php artisan migrate
```

#### 6. Start the development server

```bash
php artisan serve --port=8000
```

The application will be available at:

`http://127.0.0.1:8000`

### API Authentication

Include the following header in API requests:

```http
Authorization: Bearer YOUR_API_TOKEN
Accept: application/json
```

The API token must match the `EMPLOYEE_API_TOKEN` value configured in the environment file.

### HTTP Status Codes

| Status Code | Description |
|---|---|
| 200 | Request successful |
| 201 | Resource created |
| 401 | Unauthorized |
| 404 | Resource not found |
| 422 | Validation error |

### Future Improvements

- API pagination and filtering.
- Role-based access control.
- Employee soft deletion.
- API rate limiting.
- Automated feature and integration tests.
- API documentation with OpenAPI/Swagger.

### Author
 
Full Stack Developer: Ayşenur Akyel

Developed as part of a Full Stack Software Developer technical assignment.

**Project:** Employee Management System  
**Backend:** Laravel / PHP  
**Database:** PostgreSQL
