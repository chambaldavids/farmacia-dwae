<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Autentica o utilizador (login).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))
            ->with('sucesso', 'Sessão iniciada com sucesso.');
    }

    /**
     * Termina a sessão do utilizador (logout).
     */
    public function destroy(): RedirectResponse
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('sucesso', 'Sessão terminada.');
    }
}
