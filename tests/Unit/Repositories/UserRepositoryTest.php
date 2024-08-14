<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository;
    }

    public function test_it_can_retrieve_all_users()
    {
        User::factory()->count(5)->create();
        $users = $this->userRepository->all();
        $this->assertCount(5, $users);
    }

    public function test_it_can_find_a_user_by_id()
    {
        $user = User::factory()->create();
        $foundUser = $this->userRepository->find($user->id);
        $this->assertEquals($user->id, $foundUser->id);
    }

    public function test_it_can_create_a_user()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@ocampo.mx',
            'password' => 'password',
        ];

        $user = $this->userRepository->create($data);
        $this->assertEquals('John Doe', $user->name);
        $this->assertDatabaseHas('users', ['email' => 'johndoe@ocampo.mx']);
    }

    public function test_it_can_update_a_user()
    {
        $user = User::factory()->create();
        $data = ['name' => 'Jane Doe'];

        $updatedUser = $this->userRepository->update($user->id, $data);

        $this->assertTrue($updatedUser);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Jane Doe']);
    }

    public function test_it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $this->userRepository->delete($user->id);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
