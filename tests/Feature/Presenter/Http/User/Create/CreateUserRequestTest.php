<?php

namespace Tests\Feature\Presenter\Http\User\Login;

use App\Infrastructure\Database\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AuthenticatedUser;
use Tests\TestCase;

class CreateUserRequestTest extends TestCase
{

    use RefreshDatabase;
    use AuthenticatedUser;

    public function setUp() : void {
        parent::setUp();
        
        $this->setUpUser();
    }

    public function testSuccessResponse(): void
    {
        $response = $this->post('/api/v1/user', [
            "name" => "teste",
            "email" => "teste",
            "password" => "teste"
        ], [
            'accept' => 'application/json'
        ]);

        $response->assertStatus(201);
    }

        /**
     * @dataProvider dataSetToFailResponse
     */
    public function testFailResponse($data, $expected): void
    {
        $response = $this->post('/api/v1/user', $data, [
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
                    "message" => "The name field is required. (and 2 more errors)",
                    "errors" =>[
                        "email" => [
                            "The email field is required."
                        ],
                        "password" => [
                            "The password field is required."
                        ],
                        "name" => [
                            "The name field is required."
                        ]
                    ]
                ]
            ],
            'with email and no password' => [
                'data' => [
                    'email' => 'email'
                ],
                'expected' => [
                    "message" => "The name field is required. (and 1 more error)",
                    "errors" =>[
                        "name" => [
                            "The name field is required."
                        ],
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
                    "message" => "The name field is required. (and 1 more error)",
                    "errors" =>[
                        "name" => [
                            "The name field is required."
                        ],
                        "email" => [
                            "The email field is required."
                        ]
                    ]
                ]
            ],
            'with name no password and no email' => [
                'data' => [
                    'name' => 'name'
                ],
                'expected' => [
                    "message" => "The email field is required. (and 1 more error)",
                    "errors" =>[
                        "password" => [
                            "The password field is required."
                        ],
                        "email" => [
                            "The email field is required."
                        ]
                    ]
                ]

            ]
        ];
    }
}
