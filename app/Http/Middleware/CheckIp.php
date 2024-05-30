<?php

namespace App\Http\Middleware;

use Closure;

class CheckIp
{
  /**
   * Обработка входящего запроса.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    
    $allowedIP = [
    		'109.91.146.229',
    		'89.204.138.130',
    		'46.114.225.67',
    		'176.1.19.199'
        ];
    
    if (in_array($_SERVER['REMOTE_ADDR'], $allowedIP) === true) {
        return $next($request);
    } else {
        return redirect('404');
    }
  }

}