<?php

declare(strict_types=1);

namespace Tests\Ad\Permission;

class ReadPagePermissionTest extends AbstractPermissionTest
{
    protected function path(): string
    {
        return "PermissionPage";
    }

    public function testReadPagePermission()
    {
        $permission = $this->createPermission('ReadPagePermission');
        $admin = $this->createAdmin();
        $item = $this->makeItem($admin);
        $item->save();

        $user = $this->createUser();
        $this->actingAs($user);

        $data = [
            'pagination' => [
                'page' => 1,
                'perPage' => 10,
            ],
            'sort' => [
                'field' => 'id',
                'order' => 'desc',
            ],
            'filter' => [],
        ];
        $response = $this->json('GET', $this->makeURI(), $data)
            ->assertStatus(401);

        $this->actingAs($admin, 'admin');

        $response = $this->json('GET', $this->makeURI(), $data)
            ->assertStatus(403);
        $response->assertSeeText($permission->name);

        $admin->givePermissionTo($permission);
        $response = $this->json('GET', $this->makeURI(), $data)
            ->assertStatus(200);
        $this->seePage(self::structure(), $response);
        $response->assertJsonCount(2, 'page.data');


        $data['filter'] = [];
        $data['filter']['name'] = $item->name;
        $response = $this->json('GET', $this->makeURI(), $data)
            ->assertStatus(200);
        $this->seePage(self::structure(), $response);
        $response->assertJsonPath('page.data.0.name', $item->name);

    }
}