<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineBotController extends Controller
{
    // ---ここから追加---
    public function index()
    {
        return view('linebot.index');
    }
    // ---ここまで追加---
}
