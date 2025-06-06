<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as Responsable;
use Illuminate\Http\RedirectResponse;

class LogoutResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        // Ganti 'home' dengan nama route kamu, misalnya 'landing' atau '/'
        return redirect()->route('home');
    }
}