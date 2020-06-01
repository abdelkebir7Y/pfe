@extends('layouts.chef')

@section('title','listes des étudiants')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">listes des étudiants</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/chefDeFilière">Accueil</a></li>
                    <li class="breadcrumb-item active">listes des étudiants</li>
                </ol>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>    
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row row-cols-6 justify-content-right">
                    <div class="col ">
                        <button class="btn btn-primary btn-lg active p-2 mb-2"data-toggle="modal"data-target="#ajouter_etudiant" data-whatever="@mdo">ajouter un étudiant</button>
                        <div class="modal fade" id="ajouter_etudiant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ajouter un étudiant</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/ajouter_étudiant" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="nom">Nom</label>
                                                        <input value="{{old('nom')}}" class="form-control py-4" id="nom" name="nom" type="text" placeholder="Entrer le nom" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="prenom">Prénom</label>
                                                        <input value="{{old('prenom')}}" class="form-control py-4" id="prenom" type="text" name="prenom" placeholder="Entrer le prénom" required/>
                                                    </div>
                                                </div> 
                                            </div> 
                                            <div class="form-group">
                                                <label class="  small mb-1" for="nApogee">N° Apogée</label>
                                                <input value="{{old('nApogee')}}" class="form-control py-4 @error('nApogee') is-invalid @enderror " name="nApogee" id="nApogee" type="text" placeholder="1615517 " required />
                                            </div>
                                            @error('nApogee')
                                                <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input value="{{old('email')}}" class="form-control py-4 @error('email') is-invalid @enderror" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Entrer émail addresse" required />
                                            </div>
                                            @error('email')
                                                <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                            <input type="hidden" value="{{$filiere}}" name="filiere">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="classe">Classe</label>
                                                        <input value="{{old('classe')}}" class="form-control py-4" id="classe" name="classe" type="text" placeholder="Entrer la classe" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="groupe">Groupe</label>
                                                    <input value="{{old('groupe')}}" class="form-control py-4" id="groupe" type="text" name="groupe" placeholder="Entrer le groupe" required/>
                                                    </div>
                                                </div> 
                                                <input type="hidden" value="etudiant" name="type">
                                            </div> 
                                            <div class="form-group mt-4 p-0 d-flex justify-content-center">
                                                <input type="submit" value="Ajouter"class="px-5 btn btn-primary btn-lg active p-2 mb-2">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary btn-lg active p-2 mb-2"data-toggle="modal"data-target="#ajouter_groupe" data-whatever="@mdo">ajouter une liste</button>
                        <div class="modal fade" id="ajouter_groupe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ajouter une liste</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/ajouter_groupe" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @error('fichier')
                                                <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                            <div class="form-row">
                                                <label class="small mb-1" for="fichier">Choisir un fichier csv</label>
                                                <input type="file" class="form-control" id="fichier" name="file">
                                            </div> 
                                            <div class="form-group mt-4 p-0 d-flex justify-content-center">
                                                <input type="submit" value="Ajouter"class="px-5 btn btn-primary btn-lg active p-2 mb-2">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <td><b></b></td>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>    
                                        <th>Classe</th>
                                        <th>Groupe</th>    
                                        <th>N° Apogée</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <td><b></b></td>
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
                                            <td style="width: 10%"> 
                                                <a href="#" title="plus d'information" data-serp-pos="1" class="mr-2" style="color:#00bcd4">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" title="modifier" data-serp-pos="1" class="mr-2" style="color:#4caf50">
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
                                                                <a href="/etudiants/{{$etudiant->filiere}}/{{$etudiant->id}}/supprimer">
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