@extends('layouts.admin')

@section('title',$etudiant->nom.' '.$etudiant->prenom)

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/administrateur">Accueil</a></li>
                    <li class="breadcrumb-item active"><a href="/comptes-etudiants"> compte d'étudiant</a></li>
                    <li class="breadcrumb-item active">{{$etudiant->nom.' '.$etudiant->prenom}} </li>
                </ol>
            </div>
        </main>


        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">{{$etudiant->nom.' '.$etudiant->prenom}}</h3></div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1">Nom</label>
                                                    <input value="{{$etudiant->nom}}" class="form-control py-4" type="text" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" >Prénom</label>
                                                    <input value="{{$etudiant->prenom}}" class="form-control py-4" disabled/>
                                                </div>
                                            </div> 
                                        </div> 
                                            <div class="form-group">
                                                <label class="  small mb-1" for="nApogee">N° Apogée</label>
                                                <input value="{{$etudiant->nApogee}}" class="form-control py-4 " disabled/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input value="{{$etudiant->email}}" class="form-control py-4" disabled/>
                                            </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="classe">Classe</label>
                                                    <input value="{{$etudiant->classe}}" class="form-control py-4"disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="groupe">Groupe</label>
                                                <input value="{{$etudiant->groupe}}" class="form-control py-4" disabled/>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        </div>
    </div>
@endsection