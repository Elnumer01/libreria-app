<?php
    namespace Tests\Unit;

    use Tests\TestCase;
    use App\Models\User;
    use App\Repositories\AuthRepository;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;


    class AuthRepositoryTest extends TestCase {

        use DatabaseTransactions;

        protected AuthRepository $authRepository;

        protected function setUp(): void
        {
            parent::setUp();
            $this->authRepository = new AuthRepository();
        }

        /** @test */
        public function it_logs_in_an_existing_user()
        {
            $user = User::factory()->create([
                'name' => 'test',
                'email' => 'loginuser@example.com',
                'password' => Hash::make('12345678'),
                'rol_id' => 1,
            ]);

            $credentials = [
                'email' => 'loginuser@example.com',
                'password' => '12345678',
            ];

            $authenticatedUser = $this->authRepository->login($credentials);

            $this->assertInstanceOf(User::class, $authenticatedUser);
            $this->assertEquals($user->id, $authenticatedUser->id);
            $this->assertTrue(Auth::check());
        }
        /** @test */
        public function it_logs_out_the_authenticated_user()
        {
            $user = User::factory()->create([
                'name' => 'test',
                'email' => 'loginuser@example.com',
                'password' => Hash::make('12345678'),
                'rol_id' => 1,
            ]);
            Auth::login($user);

            $this->assertTrue(Auth::check());

            $this->authRepository->logout();

            $this->assertFalse(Auth::check());
        }

        /** @test */
        public function it_returns_the_authenticated_user()
        {
            $user = User::factory()->create([
                'name' => 'test',
                'email' => 'loginuser@example.com',
                'password' => Hash::make('12345678'),
                'rol_id' => 1,
            ]);
            Auth::login($user);

            $authenticatedUser = $this->authRepository->getAuthenticatedUser();

            $this->assertInstanceOf(User::class, $authenticatedUser);
            $this->assertEquals($user->id, $authenticatedUser->id);
        }
    }
