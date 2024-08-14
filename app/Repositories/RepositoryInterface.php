<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function all(): Collection;

    /**
     * Find a record by its ID.
     */
    public function find(int $id);

    /**
     * Create a new record.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data);

    /**
     * Update an existing record.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a record.
     */
    public function delete(int $id): ?bool;
}
