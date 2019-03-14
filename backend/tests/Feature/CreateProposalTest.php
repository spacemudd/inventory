<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProposalTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_seeing_proposal_in_top_bar()
    {
        $user = factory(User::class)->create();

        $user->givePermissionTo('create-proposal');

        $this->actingAs($user)
            ->get('/')
            ->assertSeeText('Proposals');
    }
}
