<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureInvitationIsSetup
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Cek jika user berperan 'user' dan belum punya undangan
        if ($user && $user->role === 'user' && !$user->invitations()->exists()) {
            return redirect()->route('user.invitation.setup')
                ->with('error', 'Silakan setup undangan terlebih dahulu.');
        }

        return $next($request);
    }
}
