<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class EmployeeApiService
{
    public function getEmployees(): array
    {
        $response = Http::withToken(config('services.employee_api.token'))
            ->acceptJson()
            ->timeout(10)
            ->get(config('services.employee_api.url') . '/employees');

        if (!$response->successful()) {
            throw new RuntimeException('Employee API request failed.');
        }

        return $response->json('data', []);
    }
}
