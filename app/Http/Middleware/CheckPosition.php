<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPosition
{
    public function handle($request, Closure $next, ...$positions)
    {
        $user = Auth::user();
        //checks if the position exists in the route group
        if ($user && in_array($user->position, $positions)) {
            return $next($request);
        }

           // If the user does not have the required position, show unauthorized access
        abort(403, 'Unauthorized access');
    }
}

