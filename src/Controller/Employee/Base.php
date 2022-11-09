<?php

declare(strict_types=1);

namespace App\Controller\Employee;

use App\Service\EmployeeService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getEmployeeService(): EmployeeService
    {
        return $this->container->get('employee_service');
    }
}
