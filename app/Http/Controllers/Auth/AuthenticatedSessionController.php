<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Enums\UserRole;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $username = $profileData->name;

         $notification = array(
            'message' => 'User '.$username.' Logged in Successfully',
            'alert-type' => 'info' 
        );

        $url = '';
        if ($request->user()->role === 'admin') {
            $url = route("admin.dashboard");
        } elseif ($request->user()->role === 'user') {
            $url = route("dashboard");
        }

        return redirect()->intended($url)->with($notification);
        //return redirect()->intended(route('dashboard', absolute: true));

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
