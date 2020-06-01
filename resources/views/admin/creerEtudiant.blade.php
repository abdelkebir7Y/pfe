@extends('layouts.admin')

@section('title','ajouter un étudiant')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/administrateur">Accueil</a></li>
                    <li class="breadcrumb-item active"><a href="/comptes-etudiants"> compte d'étudiant</a></li>
                    <li class="breadcrumb-item active">ajouter un compte </li>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Créer un compte</h3></div>
                                    <div class="card-body">
                                        <form action="/ajouter-étudiant" method="POST">
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
                                            <div class="form-group ">
                                                <label for="exampleFormControlSelect1" class="mb-0">Filière</label>
                                                <select class="form-control px-3 @error('filiere') is-invalid @enderror" id="exampleFormControlSelect1" name="filiere" >
                                                    <option value="NULL">sélectionnez une filière</option>
                                                    <option value="SMI">SMI</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="SMC">SMC</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="SVI">SVI</option>
                                                    <option value="STU">STU</option>
                                                </select>
                                            </div> 
                                            @error('filiere')
                                                <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
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
                                                <input type="submit" value="Créer"class="px-5 btn btn-primary btn-lg active p-2 mb-2">
                                            </div>
                                        </form>
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