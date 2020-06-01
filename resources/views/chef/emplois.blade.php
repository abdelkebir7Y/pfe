@extends('layouts.chef')

@section('title','gestion des emplois')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <h1 class="mt-4">Emplois du temps</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/chefDeFilière">Accueil</a></li>
                    <li class="breadcrumb-item active">Emplois</li>
                </ol>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Choisir une classe et un groupe</h3></div>
                            <div class="card-body">
                                <form action="/voir_emploi" method="GET">
                                    @csrf
                                    
                                    <div class="form-row ">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlSelect1" class="mb-0">Classe</label>
                                            <select class="form-control px-3 " id="exampleFormControlSelect1" name="classe" >
                                                @foreach ($groupes as $groupe)
                                                    <option value="{{$groupe->classe}}">{{$groupe->classe}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlSelect1" class="mb-0">Groupe</label>
                                            <select class="form-control px-3" id="exampleFormControlSelect1" name="groupe" >
                                                @foreach ($groupes as $groupe)
                                                    <option value="{{$groupe->groupe}}">{{$groupe->groupe}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group mt-4 p-0 d-flex justify-content-center">
                                        <input type="submit" value="Voir emploi" class="px-5 btn btn-primary btn-lg active p-2 mb-2">
                                    </div>
                                </form>
                            </div>
                            
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