<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models;
use Validator;
use Auth;

class UserController extends Controller
{

    public function getLogin()
    {
        return view('web.user.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
        ]);

        if ($this->getGuard()->attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()->to(route('webTopIndex'));
        }
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['message' => '账号或密码错误']);
    }

    public function getRegister()
    {
        return view('web.user.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
            'password_confirmation' => 'required',
        ], [
            'email.required' => '用户名不能为空',
            'email.unique' => '该用户名已经存在，请更改用户名',
            'password.required' => '密码不能为空',
            'password.min' => '密码长度不能小于:min位',
            'password.max' => '密码长度不能大于:max位',
            'password_confirmation.required' => '确认密码不能为空',
            'password.confirmed' => '输入的密码不一致',
        ]);

        $user = new Models\User();
        $user->name = $request->input('email');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $this->getGuard()->login($user);

        return redirect()->to(route('webTopIndex'));
    }

    public function logout(Request $request)
    {
        $this->getGuard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    private function getGuard()
    {
        return Auth::guard();
    }
}
