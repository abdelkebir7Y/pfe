<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index');
    Route::group(['middleware' => ['admin']], function () {

        Route::get('/administrateur','adminController@index');

        Route::get('/comptes-etudiants','adminController@compteEtudiant');
        Route::get('/ajouter-étudiant','adminController@creerEtudiant');
        Route::post('/ajouter-étudiant','adminController@stockerEtudiant');
        Route::get('/etudiants/{id}','adminController@voirEtudiant');
        Route::get('/etudiants/{id}/éditer','adminController@éditerEtudiant');
        Route::post('/etudiants/{id}/éditer','adminController@modifierEtudiant') ;
        Route::get('/etudiants/{id}/supprimer','adminController@supprimerEtudiant') ;


        Route::get('/comptes-enseignants','adminController@compteEnseignant') ;
        Route::get('/ajouter-enseignant','adminController@creerEnseignant') ;
        Route::post('/ajouter-enseignant','adminController@stockeEnseignant') ; //Enseignant
        Route::get('/enseignants/{id}','adminController@voirEnseignant') ;
        Route::get('/enseignants/{id}/éditer','adminController@éditerEnseignant') ;
        Route::post('/enseignants/{id}/éditer','adminController@modifierEnseignant') ;
        Route::get('/enseignants/{id}/supprimer','adminController@supprimerEnseignant') ;

        Route::get('/gestionFiliere','adminController@gestionFiliere') ;
        Route::post('/ajouter-filiere','adminController@stockefiliere') ; 
        Route::get('/filière/{id}/supprimer','adminController@supprimerFiliere') ;
        Route::post('/filière/{id}/éditer','adminController@modifierFiliere') ;
        
        Route::post('etudiant/chercherClasseGroupe', 'adminController@chercherClasseGroupe')->name('etudiant.chercherClasseGroupe');
       
        Route::get('/paramétre','adminController@paramétre');
    });
    /* 
    *
    *
    *
    */
    Route::group(['middleware' => ['enseignant']], function () {
        Route::get('/enseignant','enseignantController@index') ;
        Route::get('/{name}/emploi','enseignantController@voirEmploi') ;
        Route::get('/ajouterAbsence','enseignantController@ajouterAbsence') ;
        Route::get('/générerCodeQr/{id}','enseignantController@genererCodeQr') ;
        Route::get('/QRcode','enseignantController@QRcode') ;

        
        Route::group(['middleware' => ['chef']], function () {

            Route::get('/chefDeFilière','chefController@index') ;
            Route::get('/gestion-groupes','chefController@gestionGroupes') ;
            Route::post('/ajouter-groupe','chefController@stockerGroupe') ;
            Route::post('/ajouter-classe','chefController@stockerClasse') ;
            Route::get('/groupes/{id}/supprimer','chefController@supprimerGroupe') ;
            Route::post('/groupes/{id}/éditer','chefController@modifierGroupe') ;
            Route::get('/listes-étudiants','chefController@listesEtudiants') ;
            Route::post('/ajouter_étudiant','chefController@ajouterEtudiant') ;
            Route::get('/etudiants/{filiere}/{id}/supprimer','chefController@supprimerEtudiant') ;
            Route::post('/ajouter_groupe','chefController@ajouterGroupe') ;
            Route::get('/emplois','chefController@emplois') ;
            Route::get('/voir_emploi','chefController@voirEmploi') ;
            Route::get('/Emplois/{id}','chefController@modifierEmploi') ;
            Route::post('/enregistrer_emploi','chefController@enregistrerEmploi') ;
            


            Route::post('groupe/chercher', 'chefController@chercher')->name('groupe.chercher');
            
        });
    });
    
});

Auth::routes();