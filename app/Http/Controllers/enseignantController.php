<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Séance;
use Illuminate\Support\Carbon;
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
        $i = Carbon::now()->dayOfWeek+1 ; //qsdfghjklmùsdrfghjklmù*fghjn,km:drfyhjklmdfyghijklmù* 7yd hadxi +1 
        $seances = DB::table('séances')->where('enseignant',$name)->get();
        return view('enseignant.ajouterAbsence',compact('seances','i'));
    }

    public function genererCodeQr($id)
    {
        $seance = Séance::find($id);
        $file = public_path(Auth::user()->email.'.png');
        $contenu = Carbon::now();
        \QRCode::text($contenu)->setOutfile($file)->png();
        return redirect('/QRcode');
    }

    public function QRcode()
    {
        $image = Auth::user()->email.'.png';
        return view('enseignant.QRcode')->with('image',$image);
    }
}
