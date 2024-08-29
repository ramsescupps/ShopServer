<?php

declare(strict_types=1);

namespace Tests\Ad;

use App\Models\Admin;
use App\Models\Permission;
use Database\Factories\AdminFactory;
use Tests\Api\AbstractApiTest;

abstract class AbstractAdminTest extends AbstractApiTest
{

    const URI = '/v1/Admin/';

    /**
     * @param array<string, mixed> $attributes
     * @return Admin
     */
    protected function createAdmin(array $attributes = [])
    {
        $admin = AdminFactory::new()->createOne($attributes);
        return $admin->refresh();
    }

    /**
     * @param string $name
     * @return Permission
     */
    protected function createPermission(string $name)
    {
        return Permission::create([
            'name' => $name,
            'guard_name' => 'admin',
            'moderator' => 'admin',
        ]);
    }
}