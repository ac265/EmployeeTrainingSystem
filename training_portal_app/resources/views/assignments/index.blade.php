<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Training Assignments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('trainings.index') }}">Training Portal</a>
        </div>
    </nav>

    <div class="container py-5">
        <a href="{{ route('trainings.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
            Back to Trainings
        </a>

        <h2>{{ $training->title }}</h2>
        <p class="text-muted">{{ $training->description }}</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">Assign Training</div>
            <div class="card-body">
                <form method="POST" action="{{ route('assignments.store', $training) }}">
                    @csrf

                    <div class="row g-2">
                        <div class="col-md-9">
                            <select name="employee_id" class="form-select" required>
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee['id'] }}">
                                        {{ $employee['first_name'] }}
                                        {{ $employee['last_name'] }}
                                        — {{ $employee['department'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button class="btn btn-primary w-100">Assign Training</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header fw-bold">Assigned Employees</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Assigned At</th>
                                <th>Status</th>
                                <th>Completed At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignments as $assignment)
                                @php
                                    $employee = collect($employees)->firstWhere('id', $assignment->employee_id);
                                @endphp

                                <tr>
                                    <td>
                                        {{ $employee ? $employee['first_name'] . ' ' . $employee['last_name'] : 'Employee #' . $assignment->employee_id }}
                                    </td>

                                    <td>{{ $assignment->assigned_at?->format('d.m.Y') }}</td>

                                    <td>
                                        @if ($assignment->status === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Assigned</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $assignment->completed_at?->format('d.m.Y H:i') ?? '-' }}
                                    </td>

                                    <td>
                                        <form method="POST" action="{{ route('assignments.status', $assignment) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="status"
                                                value="{{ $assignment->status === 'completed' ? 'assigned' : 'completed' }}">

                                            <button class="btn btn-sm btn-success w-100">
                                                {{ $assignment->status === 'completed' ? 'Mark Assigned' : 'Mark Completed' }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('assignments.destroy', $assignment) }}"
                                            class="d-inline" onsubmit="return confirm('Remove this assignment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger w-100">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No employees assigned yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
