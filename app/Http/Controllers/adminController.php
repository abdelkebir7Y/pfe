<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\etudiant;
use App\enseignant;
use App\Filiere;
use App\HTTP\Requests\createCompte;
class adminController extends Controller
{
    
    public function index()
    {
        return view('admin.index');
    }

    public function compteEtudiant()
    {
        $etudiants = etudiant::all();
        return view('admin.etudiant')->with('etudiants',$etudiants);
    }

    public function creerEtudiant()
    {
        $filieres = DB::table('filieres')
        ->orderBy('filiere')
        ->get();
        return view('admin.creerEtudiant',compact('filieres'));
    }

    public function chercherClasseGroupe(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        if ($select == 'filiere') {
            $data = DB::table('groupes')
            ->join('classes', 'groupes.classe', '=', 'classes.classe')
            ->where($select,$value)
            ->groupBy('groupes.'.$dependent)
            ->get();
            $output = '<option value="">sélectionner une '.ucfirst($dependent).'</option>';
        } else {
            $data = DB::table('groupes')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
            $output = '<option value="">sélectionner un '.ucfirst($dependent).'</option>';
        }
        
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
    public function stockerEtudiant(createCompte $request)
    {
        $etudiant = new etudiant;
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->nApogee = $request->nApogee;
        $etudiant->email = $request->email;
        $etudiant->filiere = $request->filiere;
        $etudiant->classe = $request->classe;
        $etudiant->groupe = $request->groupe;
        
        User::create([
            'name' => $request->nom.' '.$request->prenom,
            'email' => $request->email,
            'type'=> $request->type,
            'password' => Hash::make($request->nApogee),
        ]);

        $etudiant->save();
        $request->session()->flash('success','"'.$request->nom.' '.$request->prenom.'" a été ajouté avec succès');
        return redirect('/comptes-etudiants');
    }

    public function voirEtudiant($id)
    {
        $etudiant = etudiant::find($id);
        return view('admin.voirEtudiant')->with('etudiant',$etudiant);
    }

    public function éditerEtudiant($id)
    {
        $etudiant = etudiant::find($id);
        $filieres = DB::table('filieres')
        ->orderBy('filiere')
        ->get();
        return view('admin.éditerEtudiant',compact('etudiant','filieres'));
    }

    public function modifierEtudiant(Request $request, $id)
    {
        $etudiant = etudiant::find($id);
        $id = DB::table('users')->where('email', $etudiant->email)->value('id');

        $messages = [
            'email.ends_with'  => 'svp utilisez une adresse émail académique',
            'email.required' => 'svp remplir toutes les champs',
            'email.unique'  => 'il y-a déjà un compte avec cette adresse émail',
            'nApogee.unique' => 'il y-a déjà un étudiant avec ce numéro',
            'nApogee.required' => 'svp remplir toutes les champs',
        ];
        if($etudiant->email != $request->email && $etudiant->nApogee != $request->nApogee)
        {
            $validator = Validator::make($request->all(), [
                'email' =>'unique:etudiants|unique:users|ends_with:@uca.ac.ma',
                'nApogee' => 'unique:etudiants',
            ], $messages)->validate();
        }
        elseif($etudiant->email != $request->email)
        {
            $validator = Validator::make($request->all(), [
                'email' =>'unique:etudiants|unique:users|ends_with:@uca.ac.ma',
                ], $messages)->validate();
        }elseif($etudiant->nApogee != $request->nApogee)
        {
            $validator = Validator::make($request->all(), [
                'nApogee' => 'unique:etudiants',
            ], $messages)->validate();
        }
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->nApogee = $request->nApogee;
        $etudiant->email = $request->email;
        $etudiant->filiere = $request->filiere;
        $etudiant->classe = $request->classe;
        $etudiant->groupe = $request->groupe;

        $user = User::find($id);
        $user->name = $request->nom.' '.$request->prenom;
        $user->email = $request->email;
        $user->password = Hash::make($request->nApogee);
        $user->save();
        $etudiant->save();
        $request->session()->flash('success','le compte "'.$request->nom.' '.$request->prenom.'"  a été modifié avec succès');
        return redirect('/comptes-etudiants');
    }

    public function supprimerEtudiant(Request $request,$id)
    {
        $etudiant = etudiant::find($id);
        $id = DB::table('users')->where('email', $etudiant->email)->value('id');
        $user = User::find($id);
        $request->session()->flash('success','le compte "'.$etudiant->nom.' '.$etudiant->prenom.'"  a été supprimé avec succès');
        $etudiant->delete();
        $user->delete();
    }
    /*
     * **********************************
     * 
     * **********************************
     * 
     * **********************************
     * 
     * **********************************
     * 
     */
    function PPRGenerateur() {
        $PPR = random_int(100000, 999999);
    
        if ($this->PPRExiste($PPR)) {
            return PPRGenerateur();
        }
        return $PPR;
    }
    
    function PPRExiste($PPR) {
        return DB::table( 'enseignants' )->where( 'PPR', $PPR )->exists();
    }

    /*
     * **********************************
     * 
     * **********************************
     * 
     * **********************************
     * 
     * **********************************
     * 
     */
    public function compteEnseignant()
    {
        $enseignants = enseignant::all();
        return view('admin.enseignant')->with('enseignants',$enseignants);
    }
    public function creerEnseignant()
    {
        return view('admin.creerEnseignant');
    }
    public function stockeEnseignant(createCompte $request)
    {
        
        $enseignant = new enseignant;
        $enseignant->nom = $request->nom;
        $enseignant->prenom = $request->prenom;
        $enseignant->email = $request->email;
        $enseignant->PPR = $this->PPRGenerateur();
        $enseignant->nTelephone = $request->nTelephone;
        User::create([
            'name' => $enseignant->nom.' '.$enseignant->prenom,
            'email' => $enseignant->email,
            'password' => Hash::make('covid-19'),
            'type'=> 'enseignant',
        ]);
        $enseignant->save();
        $request->session()->flash('success',$request->nom.' '.$request->prenom.' a été ajouté avec succès');
        return redirect('/comptes-enseignants');
    }

    public function voirEnseignant($id)
    {
        $enseignant = enseignant::find($id);
        return view('admin.voirEnseignant')->with('enseignant',$enseignant);
    }

    public function éditerEnseignant($id)
    {
        $enseignant = enseignant::find($id);
        return view('admin.éditerEnseignant')->with('enseignant',$enseignant);
    }

    public function modifierEnseignant(Request $request, $id)
    {
        $enseignant = enseignant::find($id);
        $id = DB::table('users')->where('email', $enseignant->email)->value('id');
        
        $messages = [
            'email.ends_with'  => 'svp utilisez une adresse émail académique',
            'email.required' => 'svp remplir toutes les champs',
            'email.unique'  => 'il y-a déjà un compte avec cette adresse émail',
        ];
        if($enseignant->email != $request->email)
        {
            $validator = Validator::make($request->all(), [
                'email' =>'unique:etudiants|unique:users|ends_with:@uca.ac.ma',
                ], $messages)->validate();
        }
        
        $enseignant->nom = $request->nom;
        $enseignant->prenom = $request->prenom;
        $enseignant->email = $request->email;
        $enseignant->nTelephone = $request->nTelephone;
        $enseignant->filiere = $request->filiere;

        $user = User::find($id);
        $user->name = $request->nom.' '.$request->prenom;
        $user->email = $request->email;

        $user->save();
        $enseignant->save();
        $request->session()->flash('success','le compte "'.$request->nom.' '.$request->prenom.'"  a été modifié avec succès');
        return redirect('/comptes-enseignants');
    }

    public function supprimerEnseignant(Request $request,$id)
    {
        $enseignant = enseignant::find($id);
        $id = DB::table('users')->where('email', $enseignant->email)->value('id');
        $user = User::find($id);
        $enseignant->delete();
        $user->delete();
        $request->session()->flash('success','le compte "'.$enseignant->nom.' '.$enseignant->prenom.'"  a été supprimé avec succès');
    }
    /*
     * **********************************
     * 
     * **********************************
     * 
     * **********************************
     * 
     * **********************************
     * 
     */
    public function gestionFiliere()
    {
        $filieres = DB::table('filieres')
        ->join('enseignants', 'enseignants.id', '=', 'filieres.chef_id')
        ->select('filieres.*', 'enseignants.nom', 'enseignants.prenom', 'enseignants.email')
        ->get();
        $enseignants = DB::table('users')->where('type', 'enseignant')->get();
        return view('admin.gestionFiliere',compact('filieres','enseignants',));
    }

    public function stockefiliere(Request $request)
    {
        $filiere = new Filiere;
        $messages = [
            'filiere.required' => 'svp remplir toutes les champs',
            'filiere.unique'  => 'il y-a déjà une filière avec ce nom',
            'chef.required' => 'svp choisissez un enseignant comme chef de la nouvelle filière',
        ];
        $validator = Validator::make($request->all(), [
            'filiere' =>'unique:filieres|required',
            'chef' => 'required',
        ],$messages)->validate();
        
        $id = DB::table('users')->where('email', $request->chef)->value('id');
        $chef = User::find($id);
        $chef->type = 'chef de filiere';
        $id = DB::table('enseignants')->where('email', $request->chef)->value('id');
        $enseignant = enseignant::find($id);
        $enseignant->filiere = $request->filiere;
        $filiere->filiere = $request->filiere;
        $filiere->chef_id = $id;
        $enseignant->save();
        $chef->save();
        $filiere->save();
        $request->session()->flash('success','La filière '.$request->prenom.' a été ajouté avec succès');
        return redirect('/gestionFiliere');
    }
    public function modifierFiliere(Request $request , $id)
    {
        $filiere = Filiere::find($id);
        $messages = [
            'filiere.required' => 'svp remplir toutes les champs',
            'filiere.unique'  => 'il y-a déjà une filière avec ce nom',
            'chef.required' => 'svp choisissez un enseignant comme chef de la nouvelle filière',
        ];
        if($filiere->filiere == $request->filiere)
        {
            $validator = Validator::make($request->all(), [
                'chef' => 'required',
            ],$messages)->validate();
        }else {
            $validator = Validator::make($request->all(), [
                'filiere' =>'unique:filieres|required',
                'chef' => 'required',
            ],$messages)->validate();
        }
        $id = DB::table('users')->where('email', $request->chef)->value('id');
        $chef = User::find($id);
        $id = DB::table('enseignants')->where('email', $chef->email)->value('id');
        if ($filiere->chef_id !=  $id) {
            $chef->type = 'chef de filiere';
            $enseignant = enseignant::find($id);
            $enseignant->filiere = $request->filiere;
            $enseignant->save();
            $chef->save();
            $chef_id = $id;
            $id = DB::table('enseignants')->where('id', $filiere->chef_id)->value('id');
            $enseignant = enseignant::find($id);
            $enseignant->filiere = NULL;
            $id = DB::table('users')->where('email', $enseignant->email)->value('id');
            $chef = User::find($id);
            $chef->type = 'enseignant';
            $filiere->filiere = $request->filiere;
            $filiere->chef_id = $chef_id;
            $enseignant->save();
            $chef->save();
        } else {
            $filiere->filiere  = $request->filiere;
        }

        $filiere->save();
        $request->session()->flash('success','La filière '.$request->prenom.' a été modifié avec succès');
        return redirect('/gestionFiliere');
    }

    public function supprimerFiliere(Request $request , $id)
    {
        $filiere = Filiere::find($id);
        
        $id = $filiere->chef_id;
        $enseignant = enseignant::find($id);
        $enseignant->filiere = NULL;
        $id = DB::table('users')->where('email', $enseignant->email)->value('id');
        $user = User::find($id);
        $user->type = 'enseignant';
        $filiere->delete();
        $enseignant->save();
        $user->save();
        $request->session()->flash('success','La filière "'.$filiere->filiere.'"  a été supprimé avec succès');
    }
}