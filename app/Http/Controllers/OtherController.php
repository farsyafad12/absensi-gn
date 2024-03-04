<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function version()
    {
        $judul = 'Data Histori Version  |  SIT Gema Nurani';

        return view('other-page/version', ['title' => $judul]);
    }
}
