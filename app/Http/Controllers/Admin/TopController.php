<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Models;
use App\Repositories;

class TopController extends BaseController
{

    public function index(Request $request)
    {
        return $this->page('admin.top.index');
    }
}
