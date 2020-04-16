<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\MarketAuthenticationService;
use App\Services\MarketService;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';
    /**
     * @var MarketAuthenticationService
     */
    private $marketAuthenticationService;

    /**
     * Create a new controller instance.
     *
     * @param MarketAuthenticationService $marketAuthenticationService
     * @param MarketService $marketService
     */
    public function __construct(MarketAuthenticationService $marketAuthenticationService, MarketService $marketService)
    {
        $this->middleware('guest')->except('logout');
        $this->marketAuthenticationService = $marketAuthenticationService;
        parent::__construct($marketService);
    }

    public function showLoginForm(){
        $authorizationUrl = $this->marketAuthenticationService->resolveAuthorizationUrl();
        return view('auth.login')->with(['authorizationUrl' => $authorizationUrl]);
    }

    public function authorization(Request $request){
        if ($request->has('code')){
            $tokenData = $this->marketAuthenticationService->getCodeToken($request->code);
            $userData = $this->marketService->getUserInformation();
            $user = $this->registerOrUpdateUser($userData,$tokenData);
            $this->loginUser($user);
            return redirect()->intended('home');
        }
        return redirect()->route('login')->withErrors(['You canceled the authorization code']);
    }

    private function registerOrUpdateUser($userData,$tokenData){
        return User::updateOrCreate([
            'service_id' => $userData->identifier,
        ],
        [
            'grant_type' => $tokenData->grant_type,
            'access_token' => $tokenData->access_token,
            'refresh_token' => $tokenData->refresh_token,
            'token_expires_at' => $tokenData->token_expires_at
        ]);
    }

    /**
     * @param User $user
     * @param bool $remember
     */
    public function loginUser(User $user,bool $remember = true) :void {
        Auth::login($user,$remember);
        session()->regenerate();
    }
}
