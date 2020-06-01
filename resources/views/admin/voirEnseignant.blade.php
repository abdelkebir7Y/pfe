@extends('layouts.admin')

@section('title',$enseignant->nom.' '.$enseignant->prenom)

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/administrateur">Accueil</a></li>
                    <li class="breadcrumb-item active"><a href="/comptes-enseignants"> compte enseignant</a></li>
                    <li class="breadcrumb-item active">{{$enseignant->nom.' '.$enseignant->prenom}} </li>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">{{$enseignant->nom.' '.$enseignant->prenom}}</h3></div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1">Nom:</label>
                                                    <input value="{{$enseignant->nom}}" class="form-control py-4" type="text" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" >Prénom:</label>
                                                    <input value="{{$enseignant->prenom}}" class="form-control py-4" disabled/>
                                                </div>
                                            </div> 
                                        </div> 
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email:</label>
                                                <input value="{{$enseignant->email}}" class="form-control py-4" disabled/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="classe">Numéro de téléphone:</label>
                                                <input value="{{$enseignant->nTelephone}}" class="form-control py-4"disabled />
                                            </div>
                                            @if ($enseignant->filiere != NULL)
                                                <div class="form-group">
                                                    <label class="small mb-1" for="groupe">chef du filière:</label>
                                                    <input value="{{$enseignant->filiere}}" class="form-control py-4" disabled/>
                                                </div>
                                            @endif
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