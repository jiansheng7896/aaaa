<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Gregwar\Captcha;
use Session;
use Request;

class SystemController extends Controller
{

    public function getCaptcha()
    {
        // 验证码类型
        $type = Request::input('type', 'login');

        $phraseBuilder = new Captcha\PhraseBuilder();
        $phrase = $phraseBuilder->build(4);
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new Captcha\CaptchaBuilder($phrase);
        $builder->setBackgroundColor(255,255,255);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(1);
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);

        //把内容存入session
        Session::flash('captcha.' . $type, $phrase);

        return response($builder->output())
            ->header('Cache-Control', 'no-cache, must-revalidate')
            ->header('Content-Type', 'image/jpeg');
    }
}
