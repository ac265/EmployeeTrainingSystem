<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Training Portal</a>
        </div>
    </nav>

    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Çalışanlar</h2>
                <p class="text-muted">Eğitim atamak için çalışan seçin.</p>
            </div>
        </div>

        @if (isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
        @endif

        @if (count($employees) > 0)
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Ad Soyad</th>
                                    <th>E-posta</th>
                                    <th>Departman</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>
                                            {{ $employee['first_name'] }}
                                            {{ $employee['last_name'] }}
                                        </td>
                                        <td>{{ $employee['email'] }}</td>
                                        <td>{{ $employee['department'] }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('employees.assign-training') }}"
                                                class="d-flex gap-2">

                                                @csrf

                                                <input type="hidden" name="employee_id" value="{{ $employee['id'] }}">

                                                <select name="training_id" class="form-select form-select-sm" required>

                                                    <option value="">Select Training</option>

                                                    @foreach ($trainings as $training)
                                                        <option value="{{ $training->id }}">
                                                            {{ $training->title }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Assign
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                Henüz kayıtlı çalışan bulunamadı.
            </div>
        @endif
    </div>

</body>

</html>
