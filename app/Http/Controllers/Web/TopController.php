<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Auth;
use App\Models;
use App\Repositories;

class TopController extends BaseController
{

    public function index(Request $request)
    {

        app(Repositories\User::class)->getName('lee');


        app(Repositories\User::class)->getName('lee');


        app(Repositories\User::class)->getName('lee');


        app(Repositories\User::class)->getName('lee');


        return $this->page('web.top.index');
    }

    public function single(Request $request)
    {


        return $this->page('web.top.single');
    }
}
