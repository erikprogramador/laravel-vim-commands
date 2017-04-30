<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    protected function signIn()
    {
        $this->user = factory(User::class)->create();
        $this->be($this->user);
        return $this;
    }
}
