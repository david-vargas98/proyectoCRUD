<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //Lógica del bloqueo:
        Fortify::authenticateUsing(function (Request $request) {
            //Se busca al usuario en la base de datos utilizando el correo electrónico proporcionado en la solicitud de inicio de sesión.
            $user = User::where('email', $request->email)->first();

            if ($user) {
                //Se verifica si el usuario está bloqueado llamando a la función $this->userIsLocked() y se le pasa el usuario
                if ($this->userIsLocked($user)) {
                    //Si el usuario está bloqueado, se muestra un mensaje de bloqueo
                    session()->flash('lockout_message', 'Superaste los 3 intentos de inicio de sesión, la cuenta se bloqueó, consulte al área de TI.');
                    return null; //Se devuelve null
                }
                //Si el usuario no está bloqueado, se verifica si la contraseña proporcionada coincide con la contraseña almacenada utilizando Hash::check
                if (Hash::check($request->password, $user->password)) {
                    //Si la contraseña es correcta, se restablecen los intentos fallidos y se devuelve el usuario autenticado
                    $user->attempts = 0;
                    $user->save();

                    return $user;
                }

                //Si la contraseña es incorrecta, se incrementa el contador de intentos fallidos del usuario en la base de datos
                $user->increment('attempts');
                $user->save();
            }
            //Si no se encuentra un usuario con el correo electrónico proporcionado, se retorna null
            return null;
        });
    }

    // Método para verificar si el usuario está bloqueado
    protected function userIsLocked($user)
    {
        //Se retoena un booleano, si los intentos son 3 o más es true, sino, false
        return $user->attempts >= 3;
    }
}
