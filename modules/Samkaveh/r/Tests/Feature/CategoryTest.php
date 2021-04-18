<?php

namespace Samkaveh\Category\Feature\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Samkaveh\Category\Models\Category;
use Samkaveh\User\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

        public function newUser()
        {
            return User::create([
                'name' => 'test',
                'email' => 'tes@email.com',
                'password' => bcrypt('Password@1')   
           ]);
        }


    public function test_authenticated_user_can_see_categories_index_page()
    {
        $this->withExceptionHandling();
       $this->actingAs($this->newUser());
        $this->assertAuthenticated();
       $this->get(route('dashboard'))->assertOk();
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






}