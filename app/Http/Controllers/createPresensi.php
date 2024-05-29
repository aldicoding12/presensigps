<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class createPresensi extends Controller
{
    public function create(Request $request) {
        return view('presensi.create');
    }
}
