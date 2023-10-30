<?php


declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database;

use App\Domain\User\User;
use App\Domain\User\UserNotFound;
use App\Infrastructure\Database\EloquentUsers;
use App\Infrastructure\Database\Models\UserModel;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery\MockInterface;
use Tests\TestCase as TestsTestCase;

class EloquentUsersTest extends TestsTestCase
{
    private MockInterface $model;
    private EloquentUsers $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = $this->mock(UserModel::class);
        $this->repository = app(EloquentUsers::class);
    }

    public function testGivenUserEntityItShouldInsertByTheModel(): void
    {
        $user = new User(
            id: 0,
            name: '',
            email: '',
            password: '',
            createdAt: new DateTimeImmutable('2023-09-09 00:15:00')
        );
        $this->model
            ->shouldReceive('create')
            ->once()
            ->with([
                'name' => '',
                'email' => '',
                'password' => '',
            ]);

        $this->repository->create($user);
    }

    public function testGivenUserEntityItShouldBeReturnByTheModel(): void
    {
        $this->model
            ->shouldReceive('where->firstOrFail')
            ->once()
            ->andReturn(new UserModel([
                'id' => 1,
                'name' => '',
                'email' => '',
                'password' => '',
                'createdAt' => new DateTimeImmutable('2023-09-09 00:15:00')  
            ]));

        $this->repository->get(1);
    }

    public function testGivenWrongUserEntityItShouldReturnAnExceptionByTheModel(): void
    {
        $this->model
            ->shouldReceive('where->firstOrFail')
            ->once()
            ->andThrow(ModelNotFoundException::class);

        $this->expectException(UserNotFound::class);

        $this->repository->get(1);
    }
}
