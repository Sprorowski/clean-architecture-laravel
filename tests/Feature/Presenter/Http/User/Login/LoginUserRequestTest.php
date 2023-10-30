<?php

namespace Tests\Feature\Presenter\Http\User\Login;

use App\Infrastructure\Database\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserRequestTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * @dataProvider dataSetToFailResponse
     */
    public function testFailResponse($data, $expected): void
    {
        $response = $this->post('/api/v1/user/login', $data, [
            'accept' => 'application/json'
        ]);

        $response->assertStatus(422);
        $response->assertJson($expected);
    }

    public static function dataSetToFailResponse(): array
    {
        return [
            'empty request' => [
                'data' => [],
                'expected' => [
                    "message" => "The email field is required. (and 1 more error)",
                    "errors" =>[
                        "email" => [
                            "The email field is required."
                        ],
                        "password" => [
                            "The password field is required."
                        ]
                    ]
                ]
            ],
            'with email and no password' => [
                'data' => [
                    'email' => 'email'
                ],
                'expected' => [
                    "message" => "The password field is required.",
                    "errors" =>[
                        "password" => [
                            "The password field is required."
                        ]
                    ]
                ]

            ],
            'with password and no email' => [
                'data' => [
                    'password' => 'password'
                ],
                'expected' => [
                    "message" => "The email field is required.",
                    "errors" =>[
                        "email" => [
                            "The email field is required."
                        ]
                    ]
                ]

            ]
        ];
    }

    public function testSuccessLogin(): void {

        UserModel::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response = $this->post('/api/v1/user/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ], [
            'accept' => 'application/json'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'token'
        ]);
    }
}
