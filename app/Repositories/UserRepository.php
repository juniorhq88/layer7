<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements RepositoryInterface
{
    /**
     * Get all users.
     *
     * @return Collection<int, User>
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * Find a user by ID.
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Get a user by email.
     */
    public function getUserByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    /**
     * Create a new user.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Update a user.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->find($id);
        if ($user) {
            return $user->update($data);
        }

        return false;
    }

    /**
     * Delete a user.
     */
    public function delete(int $id): ?bool
    {
        $user = $this->find($id);
        if ($user) {
            return $user->delete();
        }

        return false;
    }
}
