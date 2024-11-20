<?php

namespace Tests\Feature;

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
}