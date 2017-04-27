<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public function page($template, $content = [])
    {
        return view($template, $content);
    }

    /*
     * 结果处理
     * @var string $status
     * @var string $url
     * @var string $msg
     * @var boolean $ajax
     * @var array $data
     * @access public
     * @return void
     */

    public function splash($status = 'success', $url = null , $msg = null, $ajax = false){
        $status = ($status == 'failed') ? 'error' : $status;
        //如果需要返回则ajax
        if($ajax==true||request::ajax()){
            //status: error/success
            return response::json(array(
                $status => true,
                'message'=>$msg,
                'redirect' => $url,
            ));
        }

        if($url && !$msg){//如果有url地址但是没有信息输出则直接跳转
            return redirect::action($url);
        }

        $this->setLayoutFlag('splash');
        $pagedata['msg'] = $msg;
        return $this->page('topc/splash/error.html', $pagedata);
    }

}
