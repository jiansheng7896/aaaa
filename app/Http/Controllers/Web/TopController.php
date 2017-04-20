<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models;

class TopController extends Controller
{

    public function index(Request $request)
    {
        Models\User::where('id',2)->update([
            'email' => time(),
        ]);

        return view('web.top.index');
    }
}
