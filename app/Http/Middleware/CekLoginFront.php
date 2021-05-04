<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\fAuth;

class CekLoginFront
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
        // $kodepelanggan = $request->session()->get('kodepelanggan');
        $kodepelanggan = session('kodepelanggan');

        if(empty($kodepelanggan))
        {
            return redirect()->action([fAuth::class, 'login']);
        }

        return $next($request);
    }
}

?>
