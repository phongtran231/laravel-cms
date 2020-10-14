<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Entities\Admin;

class LoginController extends AbstractController
{
  public function __construct()
  {
    $this->middleware('guest:admin')->except('logout');
  }

  public function login(Request $request)
  {
    if ($request->isMethod(Request::METHOD_GET)) {
      return view('admin::login.index');
    }
    if ($request->isMethod(Request::METHOD_POST)) {
      try {
        $rules = [
          'username' => 'required',
          'password' => 'required',
        ];
        $messages = [
          'username.required' => __('backend/login.username_required'),
          'password.required' => __('backend/login.password_required'),
        ];
        $this->validate($request, $rules, $messages);
        $userName = $request->input('username');
        $password = $request->input('password');
        $user = Admin::where(function (Builder $builder) use ($userName) {
          $builder->where('user_name', $userName)->orWhere('email', $userName);
        })->whereActive(true)->first(['id', 'password']);
        if ($user) {
          if (Hash::check($password, $user->password)) {
            $this->guard()->loginUsingId($user->id, $request->input('remember'));
            return redirect()->route('admin.dashboard');
          }
        }
        return redirect()->back()->withInput($request->input())->withErrors([
          'error' => __('backend/login.login_fail'),
        ]);
      } catch (ValidationException $e) {
        return redirect()->back()->withInput($request->input())->withErrors($e->validator->getMessageBag());
      }
    }
  }

  public function logout()
  {
    $this->guard()->logout();
  }

  protected function guard()
  {
    return auth()->guard('admin');
  }
}
