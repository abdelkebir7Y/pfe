<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Classe;
use App\Groupe;
use App\etudiant;
use App\enseignant;
use App\salle;
use App\Module;
use App\User;
use App\Emploi;
use App\Séance;
use Illuminate\Support\Facades\Auth;
use App\HTTP\Requests\createCompte;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;



class chefController extends Controller
{
    public function index()
    {
        $filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');
        return view('chef.index',compact('filiere'));
    }

    public function gestionGroupes()
    {
        $classes = Classe::all();
        $groupes = Groupe::all();
        $filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');
        return view('chef.gestionGroupes',compact('classes','groupes','filiere'));
    }
    
    public function stockerClasse(Request $request)
    {
        $classe = new Classe;
        $classe->classe = $request->classe;
        $classe->filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');
        $messages = [
            'classe.unique' => 'il y-a déjà une classe avec ce nom',
            'classe.required' => 'ajoutez un nom pour la nouvelle classe',
            'classe.starts_with' => 'svp utilisez la syntaxe suivante pour le nom de classe  ----Filière-nom----',
        ];
        $validator = Validator::make($request->all(), [
            'classe' => 'required | starts_with:'.$classe->filiere.'-|unique:classes,classe',
        ], $messages)->validate();
        $classe->save();
        $request->session()->flash('success','La classe"'.$request->classe.'" a été ajouté avec succès');
        return redirect('/gestion-groupes');
    }

    public function stockerGroupe(Request $request)
    {
        $groupe = new Groupe;
        $groupe->classe = $request->classe;
        $groupe->groupe = $request->groupe;

        $emploi = new Emploi;
        $emploi->classe = $request->classe;
        $emploi->groupe = $request->groupe;
        $emploi->filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');

        $groupe->save();
        $emploi->save();
        $request->session()->flash('success','Le groupe "'.$request->groupe.'" a été ajouté avec succès');
        return redirect('/gestion-groupes');
    }


    public function modifierGroupe(Request $request, $id)
    {
        $groupe = Groupe::find($id);
        
        $id = DB::table('emplois')->where([
            ['groupe', $groupe->groupe],
            ['filiere', $filiere],
            ['classe', $groupe->classe],
        ])->value('id');
        $emplloi = Emploi::find($id);
        $groupe->classe = $request->classe;
        $groupe->groupe = $request->groupe;

        $emploi->classe = $request->classe;
        $emploi->groupe = $request->groupe;

        $groupe->save();
        $emploi->save();
        $request->session()->flash('success','Le groupe "'.$groupe->classe.'-'.$groupe->groupe.'" a été modifié avec succès');
        return redirect('/gestion-groupes');
    }

    public function supprimerGroupe(Request $request,$id)
    {
        $groupe = Groupe::find($id);
        $filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');
        $id = DB::table('emplois')->where([
            ['groupe', $groupe->groupe],
            ['filiere', $filiere],
            ['classe', $groupe->classe],
        ])->value('id');
        $emploi = Emploi::find($id);

        $groupe->delete();
        $emploi->save();

        $request->session()->flash('success','Le groupe "'.$groupe->classe.'-'.$groupe->groupe.'" a été supprimé avec succès');  
        return redirect('/gestion-groupes');
    }

    public function listesEtudiants()
    {
        $filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');
        $etudiants = DB::table('etudiants')->where('filiere', $filiere)->get();
        return view('chef.listesEtudiants',compact('etudiants','filiere'));
    }

    public function ajouterEtudiant(Request $request)
    {
        $messages = [
            'email.ends_with'  => 'svp utilisez une adresse émail académique',
            'email.required' => 'svp remplir toutes les champs',
            'email.unique'  => 'il y-a déjà un compte avec cette adresse émail',
            'nApogee.unique' => 'il y-a déjà un étudiant avec ce numéro',
            'nApogee.required' => 'svp remplir toutes les champs',
        ];
        $validator = Validator::make($request->all(), [
            'email' =>'unique:etudiants|unique:users|ends_with:@uca.ac.ma',
            'nApogee' => 'unique:etudiants',
        ], 
        $messages)->validate();
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
        return redirect('/listes-étudiants');
    }

    public function supprimerEtudiant(Request $request, $filiere , $id)
    {
        $etudiant = etudiant::find($id);
        $id = DB::table('users')->where('email', $etudiant->email)->value('id');
        $user = User::find($id);
        $request->session()->flash('success','le compte "'.$etudiant->nom.' '.$etudiant->prenom.'"  a été supprimé avec succès');
        $etudiant->delete();
        $user->delete();
        return redirect('/listes-étudiants');
    }
    public function ajouterGroupe(Request $request)
    {
        $filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');
        $request->validate([
            'file'=> 'required|mimes:csv,txt'
        ]); 
        $file = file($request->file->getRealPath());
        $data = array_slice($file,1);

        $parts= array_chunk($data,1000);

        foreach($parts as $index=>$part)
        {
            $fileName = resource_path('pending-files/'.date('y-m-d-H-i-s').$index.'.csv');
            file_put_contents($fileName,$part);
        }

        (new etudiant())->importToDb($filiere);
        $request->session()->flash('success','import success');
        return redirect('/listes-étudiants');
    }

    public function emplois()
    {
        $groupes = Groupe::all();
        return view('chef.emplois',compact('groupes'));
    }

    public function voirEmploi(Request $request)
    {
        $filiere = DB::table('enseignants')->where('email', Auth::user()->email)->value('filiere');
        $id = DB::table('emplois')->where([
            ['groupe', $request->groupe],
            ['classe', $request->classe],
            ['filiere', $filiere],
        ])->value('id');
        $emploi = Emploi::find($id);
        $seances =  DB::table('séances')->where('emploi', $id)->get();

        return view('chef.voirEmploi',compact('emploi','seances'));
    }

    public function modifierEmploi($id)
    {
        $emploi = Emploi::find($id);
        $enseignants = enseignant::all();
        $modules = Module::all();
        $salles = salle::all();
        $seances =  DB::table('séances')->where('emploi', $id)->get();
        session( [ 'pageVoirEmploi' => back()->getTargetUrl() ] );
        return view('chef.modifierEmploi',compact('emploi','enseignants','modules','salles','seances'));
    }

    public function enregistrerEmploi(Request $request)
    {
        $messages = array();
        $validators = array();
        for ($i=1; $i < 7; $i++) { 
            $J = $request->{'J'.$i} ;
            for ($j=1; $j < 7; $j++) { 
                if ($request->{'c'.$i.$j} == 'on') {
                    $message = [
                        'J'.$i.'S'.$j.'_enseignant.different'  => 'svp choisir un enseignant pour la '.( $j == 1 ? $j.' ere': $j.' eme' ).' séance du '.$J,
                        'J'.$i.'S'.$j.'_module.different' => 'svp choisir un module pour la '.( $j == 1? $j.' ere': $j.' eme' ).' séance du '.$J,
                        'J'.$i.'S'.$j.'_type.different'  => 'svp choisir un type pour la '.( $j == 1 ? $j.' ere': $j.' eme' ).' séance du '.$J,
                        'J'.$i.'S'.$j.'_salle.different' => 'svp choisir une salle pour la '.( $j == 1 ? $j.' ere': $j.' eme' ).' séance du '.$J,
                    ];
                    $messages = array_merge($message,$messages);
                }
            }
        }
        for ($i=1; $i < 7; $i++) { 
            $J = $request->{'J'.$i} ;
            for ($j=1; $j < 7; $j++) { 
                if ($request->{'c'.$i.$j} == 'on') {
                    $validator = [
                        'J'.$i.'S'.$j.'_enseignant' =>'different:null',
                        'J'.$i.'S'.$j.'_type' =>'different:null',
                        'J'.$i.'S'.$j.'_module' =>'different:null',
                        'J'.$i.'S'.$j.'_salle' =>'different:null',
                    ];
                    $validators = array_merge($validators , $validator);
                }
            }
        }
        $validator = Validator::make($request->all(),$validators,$messages)->validate();

        for ($i=1; $i < 7; $i++) { 
            $J = $request->{'J'.$i} ;
            for ($j=1; $j < 7; $j++) { 
                if ($request->{'c'.$i.$j} == 'on') {
                    DB::table('séances')
                        ->updateOrInsert(
                            ['emploi' => $request->emploi,
                             'jour' => $request->{'J'.$i} ,
                             'heureD' => $request->{'heureD'.$j} ,
                            ],
                            ['heureF' => $request->{'heureF'.$j},
                             'enseignant' => $request->{'J'.$i.'S'.$j.'_enseignant'},
                             'salle' => $request->{'J'.$i.'S'.$j.'_salle'} ,
                             'type' => $request->{'J'.$i.'S'.$j.'_type'} ,
                             'module' => $request->{'J'.$i.'S'.$j.'_module'} , 
                            ]
                        );
                }
                else {
                    DB::table('séances')
                        ->where([
                            ['emploi' , $request->emploi],
                             ['jour' , $request->{'J'.$i} ],
                             ['heureD' , $request->{'heureD'.$j}]
                        ])->delete();
                }
            }
        }
        $redirection = session('pageVoirEmploi');
        $request->session()->flash('success','les modifications ont bien été enregistrées avec succès');
        return redirect($redirection);
    }
}