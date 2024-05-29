<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class createPresensi extends Controller
{
    public function create(Request $request) {
        return view('presensi.create');
    }
    public function storage(Request $request) {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date('Y-m-d');
         $jam_in = date('H:i:s');
        $image = $request->image;
        $lokasi = $request->lokasi;
        $folderPath = 'public/uploads/absensi';
        $formatName = $nik . "-" . $tgl_presensi;
        $imageParts = explode(";base64,", $image);
        $image_base64 = base64_decode($imageParts[1]);
        $fileName = $formatName . '.png';
        $file = $folderPath . $fileName;
        // simpan ke database
        $data = [
            'nik' => $nik,
            'tanggal_presensi' => $tgl_presensi,
            'jam_in' => $jam_in,
            'foto_in' => $fileName,
            'lokasi_in' => $lokasi
        ];
        $simpan = DB::table('presensi')->insert($data);
        if($simpan) {
            Storage::put($file, $image_base64);
            echo 1; 
        }else {
            echo 0;
        }
        
    }
}
