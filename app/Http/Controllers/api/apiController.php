<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Qrcode;
use Illuminate\Support\Facades\Crypt;

class apiController extends Controller
{
    public function register(Request $request){
        $validateData = $request->validate([
            'name' =>'required',
            'email' =>'required|unique:users|ends_with:@uca.ac.ma',
            'password' => 'required|confirmed',
        ]);
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['user'=>$user, 'accessToken'=>$accessToken]);
    }
    public function login(Request $request){
        $loginData = $request->validate([
            'email' =>'required|email',
            'password' => 'required',
        ]);
        if(!auth()->attempt($loginData)){
            return response()->json(['message'=>'Le mot de passe que vous avez saisi est incorrect ou le nom d\'utilisateur entré ne correspond à aucun compte.','code'=>400]);
        }
        if( auth()->user()->type !== 'etudiant'){
            return response()->json(['message'=> 'Cette application est destinée aux étudiants ------Merci------','code'=>401]);
        }
        $emploi = DB::table('séances')->select('jour' ,'heureD','heureF','salle','enseignant','type','module')->where('emploi', 1)->get();
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['emploi' =>$emploi ,'user'=>auth()->user(), 'tokens'=>$accessToken, 'code'=>200]);
    }
    public function logout(Request $request){
        DB::table('oauth_access_tokens')->where('user_id', $request->id)->delete();
        return response()->json(['code'=> 200]);
    }


    public function emploi(Request $request){
        $emploi = DB::table('séances')->select('jour' ,'heureD','heureF','salle','enseignant','type','module')->where('emploi', 1)->get();
        return response()->json(['emploi' =>$emploi , 'code'=> 200]);
    }
    public function qrcode(Request $request){
        $id = decrypt($request->qrcode);
        $code = Qrcode::find($id);
        if($code !== null)
        {
            if ($code->valide === 1) {
                return response()->json(['message'=>'vous avez noté votre presence' , 'code'=> 200]);
            }
            return response()->json(['message'=>'vous êtes en retard' ,'code'=> 300]);
        }
        return response()->json(['message'=>'Qrcode n\'est pas valide' ,'code'=> 400]);
    }
}
?>