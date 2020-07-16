<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filiere;
use App\User;

class ApiController extends Controller
{
    public function index(){
        return response()->json([
    		'name' => 'Abigail',
    		'state' => 'CA',
	]);
    }
    public function userId($id){
        $user = User::find($id);
        return response()->json($user,'200');
    }
    public function saveFiliere(Request $request){
        $filiere = new Filiere;
        $filiere->filiere = $request->filiere;
        $filiere->chef_id = $request->chef_id;
        $filiere->save();
        return response()->json($filiere,'201');
    }
    public function updateFiliere(Request $request ,$id){
        $filiere = Filiere::find($id);
        $filiere->update($request->all());
        return response()->json($filiere,'200');
    }
    public function deleteFiliere($id){
        $filiere = Filiere::find($id);
        $filiere->delete();
        return response()->json(null,204);
    }
}
