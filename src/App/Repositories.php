<?php

declare(strict_types=1);

$container['employee_repository'] = static function (Pimple\Container $container): App\Repository\EmployeeRepository {
    return new App\Repository\EmployeeRepository($container['db']);
};
