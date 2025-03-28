<?php
namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\{LoginResponse, LogoutResponse, PasswordUpdateResponse, ProfileInformationUpdatedResponse, RegisterResponse};
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
               
                if($request->wantsJson()) {
                    $user = User::where('email', $request->email)->first();
                    
                    return response()->json([
                        "message" => "You are successfully logged in",
                        "token" => $user->createToken($request->email)->plainTextToken,
                    ], 200);
                }
                return redirect()->intended(Fortify::redirects('login'));
            }
        });
     
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                $user = User::where('email', $request->email)->first();
                return $request->wantsJson()
                    ? response()->json([
                        'message' => 'Registration successful, verify your email address',
                        "token" => $user->createToken($request->email)->plainTextToken,
                        ], 200)
                    : redirect()->intended(Fortify::redirects('register'));
            }
        });

        //customized logout response
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return $request->wantsJson()
                    ? response()->json(['message' => 'Succesfully logged out'], 200)
                    : redirect(Fortify::redirects('logout', '/'));
            }
        });

         //customized profile update response
        $this->app->instance(ProfileInformationUpdatedResponse::class, new class implements ProfileInformationUpdatedResponse {
            public function toResponse($request)
            {
                return $request->wantsJson()
                    ? response()->json(['message' => 'Profile information updated successfully'], 200)
                    : back()->with('status', Fortify::PROFILE_INFORMATION_UPDATED);
            }
        });

        //customized password update response
        $this->app->instance(PasswordUpdateResponse::class, new class implements PasswordUpdateResponse {
            public function toResponse($request)
            {
                return $request->wantsJson()
                    ? response()->json(['message' => 'password updated successfully'], 200)
                    : back()->with('status', Fortify::PASSWORD_UPDATED);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // configure views
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::registerView(fn() => view('auth.register'));
        Fortify::requestPasswordResetLinkView(fn() => view('auth.forgot-password'));
        Fortify::resetPasswordView(fn($request) => view('auth.reset-password', ['request' => $request]));
        Fortify::verifyEmailView(fn() => view('auth.verify-email'));
        Fortify::confirmPasswordView(fn() => view('auth.confirm-password'));
        Fortify::twoFactorChallengeView(fn() => view('auth.two-factor-challenge'));
    
        // Update profile information
        Fortify::updateUserProfileInformationUsing(
            UpdateUserProfileInformation::class
        );

// Update passwords
        Fortify::updateUserPasswordsUsing(
            UpdateUserPassword::class
        );
    }
}
