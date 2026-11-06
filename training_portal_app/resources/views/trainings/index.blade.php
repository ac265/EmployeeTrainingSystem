<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Training Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('trainings.index') }}">Training Portal</a>
            <a href="{{ route('employees.index') }}" class="btn btn-outline-light btn-sm">Employees</a>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="mb-4">Training Management</h2>

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
            <div class="card-header fw-bold">Create Training</div>
            <div class="card-body">
                <form method="POST" action="{{ route('trainings.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <button class="btn btn-primary">Create Training</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header fw-bold">Training List</div>
            <div class="card-body">
                @forelse($trainings as $training)
                    <div class="border rounded p-3 mb-3">
                        <form method="POST" action="{{ route('trainings.update', $training) }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $training->title }}" required>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control"
                                        value="{{ $training->description }}">
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="btn btn-success w-100">Update</button>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <a href="{{ route('assignments.index', $training) }}"
                                        class="btn btn-primary w-100">
                                        Assignments ({{ $training->employee_trainings_count }})
                                    </a>
                                </div>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('trainings.destroy', $training) }}" class="mt-2"
                            onsubmit="return confirm('Delete this training and its assignments?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100">Delete</button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted mb-0">No trainings found.</p>
                @endforelse
            </div>
        </div>
    </div>

</body>

</html>
