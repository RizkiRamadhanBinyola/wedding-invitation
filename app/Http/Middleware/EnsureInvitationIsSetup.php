<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureInvitationIsSetup
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // ✅ Ganti $user->invitation menjadi $user->invitations()->exists()
        if ($user->role === 'user' && !$user->invitations()->exists()) {
            if (!$request->is('setup-invitation') && !$request->is('setup-invitation/*')) {
                return redirect()->route('user.invitation.setup');
            }
        }

        return $next($request);
    }
}
