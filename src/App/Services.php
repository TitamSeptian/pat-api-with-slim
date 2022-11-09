<?php

declare(strict_types=1);

$container['employee_service'] = static function (Pimple\Container $container): App\Service\EmployeeService {
    return new App\Service\EmployeeService($container['employee_repository']);
};
