<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\EmployeeException;

final class EmployeeRepository
{
    private \PDO $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function getDb(): \PDO
    {
        return $this->database;
    }

    public function checkAndGet(int $employeeId): object
    {
        $query = 'SELECT * FROM `employee` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $employeeId);
        $statement->execute();
        $employee = $statement->fetchObject();
        if (!$employee) {
            throw new EmployeeException('Employee not found.', 404);
        }

        return $employee;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `employee` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $employee): object
    {
        $query = 'INSERT INTO `employee` (`id`, `nik`, `name`, `gender`, `allowance`, `salaryCuts`) VALUES (:id, :nik, :name, :gender, :allowance, :salaryCuts)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $employee->id);
        $statement->bindParam('nik', $employee->nik);
        $statement->bindParam('name', $employee->name);
        $statement->bindParam('gender', $employee->gender);
        $statement->bindParam('allowance', $employee->allowance);
        $statement->bindParam('salaryCuts', $employee->salaryCuts);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $employee, object $data): object
    {
        if (isset($data->nik)) {
            $employee->nik = $data->nik;
        }
        if (isset($data->name)) {
            $employee->name = $data->name;
        }
        if (isset($data->gender)) {
            $employee->gender = $data->gender;
        }
        if (isset($data->allowance)) {
            $employee->allowance = $data->allowance;
        }
        if (isset($data->salaryCuts)) {
            $employee->salaryCuts = $data->salaryCuts;
        }


        $query = 'UPDATE `employee` SET `nik` = :nik, `name` = :name, `gender` = :gender, `allowance` = :allowance, `salaryCuts` = :salaryCuts WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $employee->id);
        $statement->bindParam('nik', $employee->nik);
        $statement->bindParam('name', $employee->name);
        $statement->bindParam('gender', $employee->gender);
        $statement->bindParam('allowance', $employee->allowance);
        $statement->bindParam('salaryCuts', $employee->salaryCuts);

        $statement->execute();

        return $this->checkAndGet((int) $employee->id);
    }

    public function delete(int $employeeId): void
    {
        $query = 'DELETE FROM `employee` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $employeeId);
        $statement->execute();
    }
}
