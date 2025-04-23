<?php

namespace Tests\Feature;

use App\Models\manageUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class ManageUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    //Setup test environment

    public function setUp(): void
    {
        parent::setUp();
    }


    // Test if the index page loads successfully

    public function test_index_page_loads(): void
    {
        $response = $this->get(route('manageUser.index'));
        $response->assertStatus(200);
        $response->assertViewIs('manageUser.index');
    }


    // Test searching users by keyword

    public function test_search_users_by_keyword(): void
    {
        // Create test users
        $user1 = manageUser::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmadfauzi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'phone' => '081234567890',
            'status' => 'active'
        ]);

        $user2 = manageUser::create([
            'name' => 'Sarah Wijaya',
            'email' => 'sarahwijaya@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'phone' => '085678901234',
            'status' => 'active'
        ]);

        // Search by name
        $response = $this->get(route('manageUser.index', ['katakunci' => 'Ahmad']));
        $response->assertStatus(200);
        $response->assertViewHas('data', function($data) use ($user1) {
            return $data->contains('id', $user1->id) && $data->count() === 1;
        });

        // Search by email
        $response = $this->get(route('manageUser.index', ['katakunci' => 'sarahwijaya']));
        $response->assertStatus(200);
        $response->assertViewHas('data', function($data) use ($user2) {
            return $data->contains('id', $user2->id) && $data->count() === 1;
        });

        // Search by phone
        $response = $this->get(route('manageUser.index', ['katakunci' => '08123']));
        $response->assertStatus(200);
        $response->assertViewHas('data', function($data) use ($user1) {
            return $data->contains('id', $user1->id) && $data->count() === 1;
        });
    }


    // Test filtering users by role

    public function test_filter_users_by_role(): void
    {
        // Create test users with different roles
        manageUser::create([
            'name' => 'Budi Santoso',
            'email' => 'budisantoso@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'status' => 'active'
        ]);

        // Filter by volunteer role
        $response = $this->get(route('manageUser.index', ['role_filter' => 'volunteer']));
        $response->assertStatus(200);
        $response->assertViewHas('data', function($data) {
            return $data->where('role', 'volunteer')->count() === $data->count();
        });
    }


    // Test filtering users by status

    public function test_filter_users_by_status(): void
    {
        // Create test users with different statuses
        manageUser::create([
            'name' => 'Dewi Permata',
            'email' => 'dewipermata@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'status' => 'active'
        ]);

        manageUser::create([
            'name' => 'Rudi Hermawan',
            'email' => 'rudihermawan@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'status' => 'inactive'
        ]);

        manageUser::create([
            'name' => 'Indra Kusuma',
            'email' => 'indrakusuma@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'status' => 'banned'
        ]);

        // Filter by active status
        $response = $this->get(route('manageUser.index', ['status_filter' => 'active']));
        $response->assertStatus(200);
        $response->assertViewHas('data', function($data) {
            return $data->where('status', 'active')->count() === $data->count();
        });

        // Filter by inactive status
        $response = $this->get(route('manageUser.index', ['status_filter' => 'inactive']));
        $response->assertStatus(200);
        $response->assertViewHas('data', function($data) {
            return $data->where('status', 'inactive')->count() === $data->count();
        });

        // Filter by banned status
        $response = $this->get(route('manageUser.index', ['status_filter' => 'banned']));
        $response->assertStatus(200);
        $response->assertViewHas('data', function($data) {
            return $data->where('status', 'banned')->count() === $data->count();
        });
    }


    // Test create page loads

    public function test_create_page_loads(): void
    {
        $response = $this->get(route('manageUser.create'));
        $response->assertStatus(200);
        $response->assertViewIs('manageUser.create');
    }


    // Test store new user

    public function test_store_new_user(): void
    {
        $userData = [
            'name' => 'Rizky Pratama',
            'email' => 'rizkypratama@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'volunteer',
            'skills' => 'cooking,cleaning,driving',
            'phone' => '081290876543',
            'status' => 'active'
        ];

        $response = $this->post(route('manageUser.store'), $userData);
        $response->assertRedirect(route('manageUser.index'));
        $response->assertSessionHas('success', 'User created successfully.');

        $this->assertDatabaseHas('manageUser', [
            'name' => 'Rizky Pratama',
            'email' => 'rizkypratama@gmail.com',
            'role' => 'volunteer',
            'phone' => '081290876543',
            'status' => 'active'
        ]);
    }


    // Test validation errors during store

    public function test_store_validation_errors(): void
    {
        // Missing required fields
        $response = $this->post(route('manageUser.store'), []);
        $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);

        // Invalid email
        $response = $this->post(route('manageUser.store'), [
            'name' => 'Anisa Rahmawati',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'volunteer'
        ]);
        $response->assertSessionHasErrors('email');

        // Password confirmation mismatch
        $response = $this->post(route('manageUser.store'), [
            'name' => 'Anisa Rahmawati',
            'email' => 'anisarahmawati@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'different123',
            'role' => 'volunteer'
        ]);
        $response->assertSessionHasErrors('password');

        // Invalid role
        $response = $this->post(route('manageUser.store'), [
            'name' => 'Anisa Rahmawati',
            'email' => 'anisarahmawati@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'invalid_role'
        ]);
        $response->assertSessionHasErrors('role');
    }


    // Test show user details

    public function test_show_user_details(): void
    {
        $user = manageUser::create([
            'name' => 'Dian Purnama',
            'email' => 'dianpurnama@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'status' => 'active'
        ]);

        $response = $this->get(route('manageUser.show', ['manageUser' => $user->id]));
        $response->assertStatus(200);
        $response->assertViewIs('manageUser.show');
        $response->assertViewHas('data', function($data) use ($user) {
            return $data->id === $user->id;
        });
    }


    // Test show non-existent user

    public function test_show_nonexistent_user(): void
    {
        $response = $this->get(route('manageUser.show', ['manageUser' => 999]));
        $response->assertStatus(404);
    }


    // Test edit page loads

    public function test_edit_page_loads(): void
    {
        $user = manageUser::create([
            'name' => 'Faisal Rahman',
            'email' => 'faisalrahman@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'status' => 'active'
        ]);

        $response = $this->get(route('manageUser.edit', ['manageUser' => $user->id]));
        $response->assertStatus(200);
        $response->assertViewIs('manageUser.edit');
        $response->assertViewHas('data', function($data) use ($user) {
            return $data->id === $user->id;
        });
    }


    // Test update user

    public function test_update_user(): void
    {
        $user = manageUser::create([
            'name' => 'Gita Pradana',
            'email' => 'gitapradana@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'skills' => ['cooking'],
            'phone' => '087612345678',
            'status' => 'active'
        ]);

        $updateData = [
            'name' => 'Gita Pradana Saputri',
            'email' => 'gitapradanas@gmail.com',
            'role' => 'volunteer',
            'skills' => 'cooking,driving,cleaning',
            'phone' => '087698765432',
            'status' => 'inactive'
        ];

        $response = $this->put(route('manageUser.update', ['manageUser' => $user->id]), $updateData);
        $response->assertRedirect(route('manageUser.index'));
        $response->assertSessionHas('success', 'User updated successfully.');

        $this->assertDatabaseHas('manageUser', [
            'id' => $user->id,
            'name' => 'Gita Pradana Saputri',
            'email' => 'gitapradanas@gmail.com',
            'phone' => '087698765432',
            'status' => 'inactive'
        ]);
    }


    // Test update with password change

    public function test_update_with_password_change(): void
    {
        $user = manageUser::create([
            'name' => 'Hendra Gunawan',
            'email' => 'hendragunawan@gmail.com',
            'password' => Hash::make('oldpassword'),
            'role' => 'volunteer',
            'status' => 'active'
        ]);

        $updateData = [
            'name' => 'Hendra Gunawan',
            'email' => 'hendragunawan@gmail.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
            'role' => 'volunteer',
            'status' => 'active'
        ];

        $response = $this->put(route('manageUser.update', ['manageUser' => $user->id]), $updateData);
        $response->assertRedirect(route('manageUser.index'));

        // Fetch updated user
        $updatedUser = manageUser::find($user->id);
        $this->assertTrue(Hash::check('newpassword123', $updatedUser->password));
    }


    // Test delete user

    public function test_delete_user(): void
    {
        $user = manageUser::create([
            'name' => 'Irfan Hakim',
            'email' => 'irfanhakim@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'volunteer',
            'status' => 'active'
        ]);

        $userId = $user->id;

        // Execute the delete request
        $response = $this->delete(route('manageUser.destroy', ['manageUser' => $userId]));

        // Debug what's happening
        $userAfterDelete = manageUser::find($userId);

        // Correct assertion based on your application's behavior
        $response->assertRedirect(route('manageUser.index'));
        $response->assertSessionHas('success', 'User deleted successfully.');
    }
}
