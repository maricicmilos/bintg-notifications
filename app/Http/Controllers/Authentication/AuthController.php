<?php

namespace App\Http\Controllers\Authentication;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckAuthRequest;
use App\Http\Requests\CreateInitializeRequest;
use App\Http\Requests\SetPasswordRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show Login Form Page
     *
     * @return Factory|View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * User Credentials Authentication
     *
     * @param CheckAuthRequest $request
     * @return RedirectResponse
     */
    public function auth(CheckAuthRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_verified' => 1
        ];

        if(!Auth::attempt($credentials)) {
            return redirect()->route('auth.login')->with(['error' => Message::AUTH_BAD_CREDENTIALS]);
        }
        $user = Auth::user();

        if (strtolower($user->role->name) === 'administrator') {
            return redirect()->route('admin.dashboard');
        }

        if (strtolower($user->role->name) === 'doctor') {
            return redirect()->route('doctor.dashboard');
        }
    }

    /**
     * Show Registration Form Page
     *
     * @return Factory|View
     */
    public function registration()
    {
        return view('register');
    }

    /**
     * User Logout
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login');
    }

    /**
     * Show Account confirmation Form Page
     *
     * @param $confirmationCode
     * @return Factory|View
     */
    public function confirmation($confirmationCode){

        $authUser = User::where('confirmation_code', $confirmationCode)->firstOrFail();

        return view('account_confirmation', compact(['authUser']));

    }


    /**
     * Register password and redirect User to Dashboard
     *
     * @param SetPasswordRequest $request
     * @return RedirectResponse
     */
    public function registerPassword(SetPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->firstOrFail();

            $user->update([
                'password' => Hash::make($request->password),
                'is_verified' => 1,
                'email_verified_at' => Carbon::now()->toDateTimeString()
            ]);

            Auth::setUser($user);

            if(strtolower($user->role->name) === 'administrator') {
                return redirect()->route('admin.dashboard');
            }

            if(strtolower($user->role->name) === 'doctor') {
                return redirect()->route('doctors.notifications');
            }

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        }
    }
}
