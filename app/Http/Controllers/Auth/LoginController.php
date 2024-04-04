<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {

        return 'numero_documento';
    }
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $username = $request->get($this->username());

        $client = User::where($this->username(), $username)->where('tenantId','312312312')->first();

        $rol = RoleUser::select('role_id')->where('user_id', $client['id'])->first();

        $this->incrementLoginAttempts($request);
        if(is_null($client))
        {
            return $this->sendFailedLoginResponse($request, 'No se pudo iniciar sesión. Usuario o contraseña incorrecta');
        }


        if ($client->isblocked ===1)
        {
            return $this->sendFailedLoginResponse($request, 'No se pudo iniciar sesión. Usted no se encuentra activo.');
        }
        if($client->tenantId!=='312312312')
        {
            return $this->sendFailedLoginResponse($request, 'No se pudo iniciar sesión. Usted no se encuentra inscrito en el programa DEPORVIDA');
        }
        if ($this->attemptLogin($request))
        {
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }
    protected function sendFailedLoginResponse(Request $request, $trans = 'auth.failed')
    {
        $errors = [$this->username() => trans($trans)];
        if ($request->expectsJson())
        {
            return response()->json($errors, 422);
        }
        return redirect()->back()
               ->withInput($request->only($this->username(), 'remember'))
               ->withErrors($errors);
    }
}
