<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <h2 class="mb-4">Employee Management System</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">Add New Employee</div>

            <div class="card-body">
                <form method="POST" action="{{ route('employees.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-3">
                            <input name="first_name" class="form-control" placeholder="First Name" required>
                        </div>

                        <div class="col-md-3">
                            <input name="last_name" class="form-control" placeholder="Last Name" required>
                        </div>

                        <div class="col-md-3">
                            <input name="email" type="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="col-md-3">
                            <input name="department" class="form-control" placeholder="Department" required>
                        </div>
                    </div>

                    <button class="btn btn-primary mt-3">
                        Add Employee
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Employee List</div>

            <div class="card-body table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>

                                <td>
                                    {{ $employee->first_name }}
                                    {{ $employee->last_name }}
                                </td>

                                <td>{{ $employee->email }}</td>

                                <td>{{ $employee->department }}</td>

                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="collapse"
                                        data-bs-target="#edit{{ $employee->id }}">
                                        Edit
                                    </button>

                                    <form method="POST" action="{{ route('employees.destroy', $employee) }}"
                                        class="d-inline" onsubmit="return confirm('Delete employee?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <tr class="collapse" id="edit{{ $employee->id }}">
                                <td colspan="5">
                                    <form method="POST" action="{{ route('employees.update', $employee) }}"
                                        class="row g-2">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-3">
                                            <input name="first_name" class="form-control"
                                                value="{{ $employee->first_name }}" required>
                                        </div>

                                        <div class="col-md-3">
                                            <input name="last_name" class="form-control"
                                                value="{{ $employee->last_name }}" required>
                                        </div>

                                        <div class="col-md-3">
                                            <input name="email" type="email" class="form-control"
                                                value="{{ $employee->email }}" required>
                                        </div>

                                        <div class="col-md-2">
                                            <input name="department" class="form-control"
                                                value="{{ $employee->department }}" required>
                                        </div>

                                        <div class="col-md-1">
                                            <button class="btn btn-success">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No employees found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
