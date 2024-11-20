<?php

namespace Tests\Feature;

use App\Models\Link;
use Database\Seeders\LinkSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LinkEndpointsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();
        $this->seed(LinkSeeder::class);
    }

    public function test_can_create_a_link(): void {
        $newLinkTarget = [
            'target' => "https://spot2.mx/?utm_campaign=Consideracion_Search_BrandTerms_Nacional&utm_source=google&utm_medium=cpc&utm_medium=spot&utm_source=adwords&utm_term=spot2&utm_campaign=Consideracion_Search_BrandTerms_Nacional&hsa_acc=7664772558&hsa_cam=20461161483&hsa_grp=156410161150&hsa_ad=670194314046&hsa_src=g&hsa_tgt=kwd-569127776100&hsa_kw=spot2&hsa_mt=b&hsa_net=adwords&hsa_ver=3&gad_source=1"
        ];

        $response = $this->postJson('/api/v1/links', $newLinkTarget);

        $this->assertDatabaseCount('links', 4);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $jsonResponse) =>
                $jsonResponse->hasAll(['status', 'data'])
                    ->has('data', fn (AssertableJson $linkObject) =>
                        $linkObject->hasAll([
                            'id',
                            'target_url',
                            'slug',
                            'redirect_url',
                            'updated_at',
                            'created_at'
                        ])
                    )
            );
    }

    public function test_can_return_all_links(): void {
        $response = $this->get('api/v1/links');

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $jsonResponse) =>
                $jsonResponse->hasAll(['status', 'data'])
                    ->has('data', 3)
                    ->has('data.0', fn (AssertableJson $linkObject) =>
                        $linkObject->hasAll([
                            'id',
                            'target_url',
                            'slug',
                            'redirect_url',
                            'updated_at',
                            'created_at'
                        ])
                    )
            );
    }

    public function test_can_delete_a_link(): void {
        $linkToDelete = Link::factory()->create();

        $this->assertDatabaseCount('links', 4);

        $linkId = $linkToDelete['id'];

        $response = $this->delete('api/v1/links/'.$linkId);

        $this->assertDatabaseCount('links', 3);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'status' => "success",
                'data' => $linkId
            ]);
    }

    public function test_will_fail_with_a_404_if_link_to_delete_is_not_found(): void {
        $response = $this->delete('api/v1/links/abc123');

        $response
            ->assertStatus(404)
            ->assertJson(fn (AssertableJson $jsonResponse) =>
                $jsonResponse->hasAll(['status', 'error'])
                    ->has('error', fn (AssertableJson $errorObject) =>
                        $errorObject->hasAll(['code', 'message'])
                    )
            );
    }
}
