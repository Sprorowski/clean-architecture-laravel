<?php
namespace Tests;

use App\Infrastructure\Database\Models\UserModel;

trait AuthenticatedUser {

    public function setUpUser(array $attributes = [])
    {
        $this->logout();
      
        $this->user = UserModel::factory()->create($attributes);

        $this->login();

        return $this;
    }

    public function login()
    {
        $this->actingAs($this->user);
    }
    
    public function logout()
    {
        $this->user = null;
    }
}

