<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\aAuth;

class CekLoginNelayan
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
        
        $usernelayan = $request->session()->get('usernelayan');

        if(empty($usernelayan))
        {
            return redirect()->action([aAuth::class, 'login_nelayan']);
        }

        return $next($request);
    }
}

?>
