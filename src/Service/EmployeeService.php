<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\EmployeeException;
use App\Repository\EmployeeRepository;

final class EmployeeService
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function checkAndGet(int $employeeId): object
    {
        return $this->employeeRepository->checkAndGet($employeeId);
    }

    public function getAll(): array
    {
        return $this->employeeRepository->getAll();
    }

    public function getOne(int $employeeId): object
    {
        return $this->checkAndGet($employeeId);
    }

    public function create(array $input): object
    {
        $employee = json_decode((string) json_encode($input), false);

        return $this->employeeRepository->create($employee);
    }

    public function update(array $input, int $employeeId): object
    {
        $employee = $this->checkAndGet($employeeId);
        $data = json_decode((string) json_encode($input), false);
        $dataObject = (object) $data;
        return $this->employeeRepository->update($employee, $dataObject);
    }

    public function delete(int $employeeId): void
    {
        $this->checkAndGet($employeeId);
        $this->employeeRepository->delete($employeeId);
        // return json_encode(['message' => 'Employee deleted', 'status' => 200]);
    }
}
