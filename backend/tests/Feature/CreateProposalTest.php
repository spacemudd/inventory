<?php

namespace Tests\Feature;

use App\Models\Proposal;
use App\Models\Tenant;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProposalTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user->givePermissionTo('create-proposal');

        $tenant_id = Tenant::create()->id;
        $this->user->update(['tenant_id' => $tenant_id]);
    }

    public function test_user_can_see_proposal_in_top_bar()
    {
        $this->actingAs($this->user)
            ->get('/home')
            ->assertSeeText('Proposals');
    }

    public function test_user_can_store_proposal()
    {
        $url = route('proposals.store');
        $data = [
            'client_name' => $this->faker->name,
            'client_number' => null,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'cr_number' => (string) $this->faker->randomNumber(5),
            'supervisor_id' => factory(User::class)->create()->id,
        ];

        $this->actingAs($this->user)
            ->post($url, $data)
            ->assertSuccessful();

        $this->assertDatabaseHas('proposals', $data);
    }

    public function test_user_can_view_all_proposals()
    {
        $proposal = factory(Proposal::class, 2)->create([
            'tenant_id' => $this->user->tenant_id,
        ]);

        $url = route('proposals.index');

        $this->actingAs($this->user)
            ->get($url)
            ->assertSuccessful();
    }
}
