@extends('layouts.admin')

@section('title','ajouter un enseignant')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/administrateur">Accueil</a></li>
                    <li class="breadcrumb-item active"><a href="/comptes-enseignants"> compte enseignant</a></li>
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
                                        <form action="/ajouter-enseignant" method="POST">
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
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input value="{{old('email')}}" class="form-control py-4 @error('email') is-invalid @enderror" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Entrer émail addresse" required />
                                            </div>
                                            @error('email')
                                                <div class="alert alert-danger">{{$message}} </div>
                                            @enderror 
                                            <div class="form-group">
                                                <label class="  small mb-1" for="nTelephone">Numéro de téléphone</label>
                                                <input value="{{old('nTelephone')}}" class="form-control py-4 " name="nTelephone" id="nTelephone" type="text" placeholder="+212 6 666 666 66 " required />
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