<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_category_management(): void
    {
        $this->get(route('all.category'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_create_categories(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('store.category'), [
                'category_name' => 'Electronics',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categories', [
            'category_name' => 'Electronics',
            'user_id' => $user->id,
        ]);
    }

    public function test_category_names_must_be_unique(): void
    {
        $user = User::factory()->create();

        Category::create([
            'category_name' => 'Electronics',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->from(route('all.category'))
            ->post(route('store.category'), [
                'category_name' => 'Electronics',
            ])
            ->assertRedirect(route('all.category'))
            ->assertSessionHasErrors('category_name');

        $this->assertDatabaseCount('categories', 1);
    }

    public function test_categories_can_be_soft_deleted_and_restored(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'category_name' => 'Electronics',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->delete(route('categories.softdelete', $category))
            ->assertSessionHas('success');

        $this->assertSoftDeleted($category);

        $this->actingAs($user)
            ->get(route('category.restore', $category))
            ->assertRedirect(route('all.category'))
            ->assertSessionHas('success');

        $this->assertNotSoftDeleted($category->fresh());
    }
}
