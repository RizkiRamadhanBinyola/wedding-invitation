<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureInvitationIsSetup
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user->role === 'user' && !$user->invitation) {
            // Jangan redirect jika sudah di halaman setup
            if (!$request->is('setup-invitation') && !$request->is('setup-invitation/*')) {
                return redirect()->route('user.invitation.setup');
            }
        }

        return $next($request);
    }
}
