<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/login';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        // HAPUS ATAU KOMENTARI BAGIAN INI:
        // $this->configureRateLimiting(); // Jika ada method ini yang di atas, biarkan saja
        // $this->forRequestsThatRequireEmailVerification(); // Hapus atau komentari baris ini
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        // ... (biarkan kode ini tetap ada jika ada)
    }

    /**
     * Configure the routes for requests that require e-mail verification.
     *
     * @return void
     */
    /*
    // Komentari seluruh method ini jika ada
    protected function forRequestsThatRequireEmailVerification()
    {
        Route::middleware(['auth'])
            ->group(function () {
                Route::get('/email/verify', function () {
                    return view('auth.verify-email');
                })->name('verification.notice');

                Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Http\Request $request, $id, $hash) {
                    $user = \App\Models\User::find($id); // Atau Pengguna::find($id) jika Anda pakai model Pengguna
                    if (! $user || ! \Illuminate\Support\Facades\URL::hasValidSignature($request)) {
                        abort(401);
                    }
                    if (! $user->hasVerifiedEmail()) {
                        $user->markEmailAsVerified();
                        event(new \Illuminate\Auth\Events\Verified($user));
                    }
                    return redirect()->intended(RouteServiceProvider::HOME)->with('status', 'Email Anda berhasil diverifikasi!');
                })->name('verification.verify');

                Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
                    $request->user()->sendEmailVerificationNotification();
                    return back()->with('status', 'Tautan verifikasi baru telah dikirim ke alamat email Anda!');
                })->middleware(['throttle:6,1'])->name('verification.send');
            });
    }
    */
}