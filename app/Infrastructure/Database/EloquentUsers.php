<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Domain\User\User;
use App\Domain\User\UserNotFound;
use App\Domain\User\Users;
use App\Infrastructure\Database\Models\UserModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentUsers implements Users
{
    public function __construct(
        private readonly UserModel $model
    ) {
    }

    /**
     * @throws UserNotFound
     */
    public function get(int $id): User
    {
        try {
            $user = $this->model->findOrFail($id);
        } catch (ModelNotFoundException) {
            throw new UserNotFound($id);
        }

        return User::fromArray($user->toArray());
    }

    public function create(User $user): void
    {
        $this->model->create($user->toArray());
    }
}
