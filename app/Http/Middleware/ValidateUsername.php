<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateUsername
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // this whole thing just makes sure it redirects to right username if someone puts the wrong one
        $id = $request->route('id');
        $username = $request->route('username');

        $user = User::find($id);

        if (!$user || $user->username !== $username) {
            if ($user) {
                return redirect()->route('users.profile', ['id' => $user->id, 'username' => $user->username]);
            } else {
                abort(404);
            }
        }

        return $next($request);
    }
}
