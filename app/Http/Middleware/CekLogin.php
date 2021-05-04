<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\aAuth;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->session()->forget('katakunci');
        
        $useradmin = $request->session()->get('useradmin');

        if(empty($useradmin))
        {
            return redirect()->action([aAuth::class, 'login']);
        }

        return $next($request);
    }
}

?>
