<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models;
use Validator;
use Password;
use Auth;

class UserController extends Controller
{

    /*
     * 登录页面
     *
     */
    public function getLogin()
    {
        return view('web.user.login');
    }

    /*
     * 登录提交
     *
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|string',
        ], [
            'email.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
            'captcha.required' => '验证码不能为空',
        ]);
        if ($request->input('captcha') != $request->session()->get('captcha.login')) {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['message' => '验证码错误']);
        }

        if ($this->getGuard()->attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()->to(route('webTopIndex'));
        }
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['message' => '账号或密码错误']);
    }

    /*
     * 注册页面
     *
     */
    public function getRegister()
    {
        return view('web.user.register');
    }

    /*
     * 注册提交
     *
     */
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

    /*
     * 注销登录
     *
     */
    public function logout(Request $request)
    {
        $this->getGuard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /*
     * 密码重置页面
     *
     */
    public function showLinkRequestForm(Request $request)
    {
        return view('web.user.password.email');
    }

    /*
     * 发送密码重置链接
     *
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ], [
            'email.required' => '邮箱不能为空',
            'email.unique' => '邮箱格式错误',
        ]);
        // 根据email获取用户信息
        // 删除表中数据
        // 插入新数据
        // 发送mail



        $response = Password::broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(
                ['email' => trans($response)]
            );
    }

    /*
     * 密码重置
     *
     */
    public function showResetForm(Request $request)
    {

    }

    /*
     * 密码重置提交
     *
     */
    public function reset(Request $request)
    {
    }

    private function getGuard()
    {
        return Auth::guard();
    }
}
