<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test API V1 get list users success
     *
     * @return void
     */
    public function test_get_list_users_success()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->get('/user/userlist');

        $response->assertOk()
                 ->assertSeeText('data')
                 ->assertSeeText('pagination');
    }

    /**
     * Test API V1 get list users failed
     *
     * @return void
     */
    public function test_get_list_users_failed()
    {
        $response = $this->get('/user/userlist');

        $response->assertUnauthorized();
    }
}
