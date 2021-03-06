<?php

namespace Samkaveh\Category\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Samkaveh\Category\Models\Category;
use Samkaveh\RolePermission\Database\Seeds\RolePermissionSeeder;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

        public function newUser()
        {
            $user =  User::create([
                'name' => 'test',
                'email' => 'test21@mail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Password@1')   
           ]);

            $this->seed(RolePermissionSeeder::class);           
            $user->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
            return $user;
        }


    public function test_authenticated_user_holder_permission_categories_can_see_categories_index_page()
    {   

        $this->actionAsAdmin();
        // $this->newUser();
        // $this->withoutMiddleware(['auth','web']);
        $this->get(route('categories.index'))->assertOk();
        
    }


    public function test_authenticated_user_can_see_categories_index_page()
    {
       $this->actingAs(User::factory()->make());
       $this->seed(RolePermissionSeeder::class);
       auth()->user()->givePermissionTo('manage categories');
       $this->get(route('categories.index'))->assertStatus(200);
    }

    public function test_authenticated_user_can_create_new_category()
    {
       $this->actingAs($this->newUser());
        $this->assertAuthenticated();
       $this->post(route('categories.store'),[
            'title' => 'test',
            'slug' => 'test',

       ])->assertOk();
        $this->assertEquals(1,Category::all());
    }

    private function actionAsAdmin()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(RolePermissionSeeder::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }

}