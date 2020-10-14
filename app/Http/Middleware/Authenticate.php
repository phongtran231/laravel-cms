<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Arr;

class Authenticate extends Middleware
{
  /**
   * @var $guards
   */
  private $guards;

  /**
   * @param \Illuminate\Http\Request $request
   * @param Closure $next
   * @param mixed ...$guards
   * @return mixed
   * @throws \Illuminate\Auth\AuthenticationException
   */
  public function handle($request, Closure $next, ...$guards)
  {
    $this->guards = $guards;
    return parent::handle($request, $next, ...$guards);
  }

  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param \Illuminate\Http\Request $request
   * @return string|null
   */
  protected function redirectTo($request)
  {
    if (!$request->expectsJson()) {
      if (Arr::get($this->guards, 0) == 'admin') {
        return route('admin.login');
      }
      return route('client.login');
    }
  }
}
