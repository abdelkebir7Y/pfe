<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Qrcode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;

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
            return response()->json(['message'=> 'Cette application est destinée aux étudiants\n ------Merci------','code'=>401]);
        }
        $user =DB::table('users')
            ->join('etudiants', 'users.email', '=', 'etudiants.email')
            ->select('users.id', 'users.email', 'users.name', 'etudiants.classe','etudiants.groupe')
            ->get();
        $emploi = DB::table('séances')->select('jour' ,'heureD','heureF','salle','enseignant','type','module')->where('emploi', 1)->get();
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['emploi' =>$emploi ,'user'=>$user[0], 'tokens'=>$accessToken, 'code'=>200]);
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
        
        $etudiant_id = DB::table('etudiants')
            ->join('users', 'etudiants.email', '=', 'users.email')
            ->where('users.id' , $request->id)
            ->select('etudiants.id')
            ->get();
        $etudiant_id = $etudiant_id[0]->id;
        $value = Cache::get($id);
        unset($value[$etudiant_id]); 
        Cache::put($id, $value,6000);

        $code = Qrcode::find($id);
        if($code !== null)
        {
            if ($code->valide === 1) {
                return response()->json(['message'=>'Vous avez noté votre présence', 'code'=> 200]);
            }
            return response()->json(['message'=>'Vous êtes en retard' ,'code'=> 300]);
        }
        return response()->json(['message'=>'Qrcode n\'est pas valide' ,'code'=> 400]);
    }



    public function changePassword(Request $request){
        $loginData = $request->validate([
            'email' =>'required|email',
            'password' => 'required',
        ]);
        if(!auth()->attempt($loginData)){
            return response()->json(['message'=>'Le mot de passe que vous avez saisi est incorrect','code'=>400]);
        }
        $id = DB::table('users')->where('email', $request->email)->value('id');
        $user = User::find($id);
        $user->password = Hash::make($request->nPassword);
        $user->save();
        return response()->json(['code'=>200]);
    }
}
?>