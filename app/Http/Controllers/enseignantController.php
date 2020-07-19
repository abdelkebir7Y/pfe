<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Séance;
use App\Qrcode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
class enseignantController extends Controller
{
    public function index()
    {
        return view('enseignant.index');
    }

    public function voirEmploi($name)
    {
        $seances = DB::table('séances')->where('enseignant',$name)->get();
        return view('enseignant.voirEmploi',compact('seances'));
    }

    public function ajouterAbsence()
    {
        $name = Auth::user()->name;
        $i = Carbon::now()->dayOfWeek ; //qsdfghjklmùsdrfghjklmù*fghjn,km:drfyhjklmdfyghijklmù* 7yd hadxi +1 
        $seances = DB::table('séances')->where('enseignant',$name)->get();
        return view('enseignant.ajouterAbsence',compact('seances','i'));
    }

    public function genererCodeQr($id)
    {
        $qrcode = new Qrcode ; 
        $qrcode->séance_id = $id;
        $qrcode->id  = bin2hex(openssl_random_pseudo_bytes(40));
        $qrcode->image = public_path(Auth::user()->email.'.png');
        $contenu = encrypt($qrcode->id);
        \QRCode::text($contenu)->setOutfile($qrcode->image)->png();
        $qrcode->save();
        return redirect('/QRcode');
    }

    public function QRcode()
    {
        $image = Auth::user()->email.'.png';
        return view('enseignant.QRcode')->with('image',$image);
    }
}
