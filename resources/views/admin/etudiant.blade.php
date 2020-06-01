@extends('layouts.admin')

@section('title','gestion des comptes des étudiants')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">comptes des étudiants</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/administrateur">Accueil</a></li>
                    <li class="breadcrumb-item active">compte étudiant</li>
                </ol>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>    
                @endif
                <a href="/ajouter-étudiant">
                    <button class="btn btn-primary btn-lg active p-2 mb-2">ajouter une compte</button>     
                </a>            
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>listes des étudiants.
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- tableau des comptes-->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                     
                                <thead>
                                    <tr>
                                        <th>Classe</th>
                                        <th>Groupe</th> 
                                        <th>N° Apogée</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>        
                                        <th>Classe</th>
                                        <th>Groupe</th> 
                                        <th>N° Apogée</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody> 
                                    @foreach ($etudiants as $etudiant)
                                        <tr>
                                            <td>{{$etudiant->classe}}</td>
                                            <td>{{$etudiant->groupe}}</td>
                                            <td>{{$etudiant->nApogee}}</td>
                                            <td>{{$etudiant->nom}}</td>
                                            <td>{{$etudiant->prenom}}</td>
                                            <td style="width: 15%"> 
                                                <a href="/etudiants/{{$etudiant->id}}" title="plus d'information" data-serp-pos="1" class="mr-2" style="color:#00bcd4">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/etudiants/{{$etudiant->id}}/éditer" title="modifier" data-serp-pos="1" class="mr-2" style="color:#4caf50">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#modal" data-toggle="modal" title="supprimer" data-serp-pos="1" class="mr-2" style="color:#f44336">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <div id="modal" class="modal fade">
                                            <div class="modal-dialog modal-confirm modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="icon-box">
                                                            <i class="material-icons">&#xE5CD;</i>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Voulez-vous vraiment supprimer ce compte ?</p>
                                                    </div>
                                                    <div class="modal-footer container">
                                                        <div class="row">
                                                            <div class="col-md-auto">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                                                            </div>
                                                            <div class="col-md-auto">
                                                                <a href="/etudiants/{{$etudiant->id}}/supprimer">
                                                                    <button type="button" class="btn btn-danger">Supprimer</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                    @endforeach       
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy;</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection