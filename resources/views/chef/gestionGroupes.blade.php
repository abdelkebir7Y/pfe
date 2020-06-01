@extends('layouts.chef')

@section('title','gestion des groupes')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">gestion des groupes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/chefDeFilière">Accueil</a></li>
                    <li class="breadcrumb-item active">gestion des groupes</li>
                </ol>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>    
                @endif
                <div class="row row-cols-6 justify-content-right">
                    <div class="col ">
                        <button class="btn btn-primary btn-lg active p-2 mb-2"data-toggle="modal"data-target="#new_classe" data-whatever="@mdo">ajouter une classe</button>
                        <div class="modal fade" id="new_classe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouvelle classe</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="/ajouter-classe">
                                            @csrf
                                            @if ($errors->has('classe') )
                                                <script>
                                                    $( document ).ready(function() {
                                                        $('#new_classe').modal('show');
                                                    });
                                                </script>
                                                @error('classe')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            @else
                                                <div class="alert alert-primary">svp utilisez la syntaxe suivante pour le nom de classe  ----Filière-nom----</div>
                                            @endif
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label @error('classe') is-invalid @enderror">Nom de nouvelle classe</label>
                                            <input type="text" class="form-control" id="nouveau_classe" name="classe" required value="{{old('classe')? old('classe') : $filiere.'-'}}" placeholder="Entrer le nom de classes">
                                            </div>
                                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary active p-2 mb-2" data-dismiss="modal">Annuler</button>
                                            <div class="form-group ">
                                                <input type="submit" class="btn btn-primary active p-2 mb-2" value="enregistrer" >
                                            </div>
                                            
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary btn-lg active p-2 mb-2" data-toggle="modal" data-target="#new_groupe" data-whatever="@fat">ajouter un groupe</button>
                        <div class="modal fade" id="new_groupe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouveau groupe</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="/ajouter-groupe">
                                        <div class="modal-body">
                                        
                                            @csrf
                                            @if ($errors->has('groupe') )
                                                <script>
                                                    $( document ).ready(function() {
                                                        $('#new_groupe').modal('show');
                                                    });
                                                </script>
                                                @error('classe')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            @endif
                        @if (!count($classes))
                                            <div class="alert alert-primary text-center">----svp ajoutez une classe----</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary active p-2 mb-2" data-dismiss="modal">Retour</button>
                                        </div>
                        @else
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1" class="mb-0">Nom de la classe</label>
                                                <select class="form-control px-3" id="exampleFormControlSelect1" name="classe" required >
                                                    @foreach ($classes as $classe)
                                                        <option value="{{$classe->classe}}">{{$classe->classe}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Nom de Nouveau groupe</label>
                                                <input type="text" class="form-control" id="nouveau_classe" name="groupe" placeholder="Entrer le nom groupe" required/>
                                            </div>
                                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary active p-2 mb-2" data-dismiss="modal">Annuler</button>
                                            <div class="form-group ">
                                                <input type="submit" class="btn btn-primary active p-2 mb-2" value="enregistrer">
                                            </div>
                                        
                                        </div>
                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>        
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>listes des groupes.
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                     
                                <thead>
                                    <tr>
                                        <th>Classe</th>
                                        <th>Groupe</th>
                                        <td><b></b></td>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>        
                                        <th>Classe</th>
                                        <th>Groupe</th>
                                        <td><b></b></td>
                                    </tr>
                                </tfoot>
                                <tbody> 
                                    @foreach ($groupes as $groupe)
                                        <tr>
                                            <td>{{$groupe->classe}}</td>
                                            <td>{{$groupe->groupe}}</td>
                                            <td style="width: 10%"> 
                                                <a href="#modifier" data-toggle="modal" title="modifier" data-serp-pos="1" class="mr-2" style="color:#4caf50">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#modal" data-toggle="modal" title="supprimer" data-serp-pos="1" class="mr-2" style="color:#f44336">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modifier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier le groupe</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="/groupes/{{$groupe->id}}/éditer">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1" class="mb-0">Nom de la classe</label>
                                                                <select class="form-control px-3" id="exampleFormControlSelect1" name="classe" required >
                                                                    <option value="{{$groupe->classe}}">{{$groupe->classe}}</option>
                                                                    @foreach ($classes as $classe)
                                                                        @if ($groupe->classe != $classe->classe )
                                                                            <option value="{{$classe->classe}}">{{$classe->classe}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                              </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Nom de groupe</label>
                                                            <input type="text" class="form-control" id="nouveau_classe" name="groupe" value="{{$groupe->groupe}}" required/>
                                                            </div>
                                                    
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary active p-2 mb-2" data-dismiss="modal">Annuler</button>
                                                            <div class="form-group ">
                                                                <input type="submit" class="btn btn-primary active p-2 mb-2" value="enregestrer">
                                                            </div>
                                                            
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>


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
                                                        <p>Voulez-vous vraiment supprimer ce groupe ?</p>
                                                    </div>
                                                    <div class="modal-footer container">
                                                        <div class="row">
                                                            <div class="col-md-auto">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                                                            </div>
                                                            <div class="col-md-auto">
                                                                <a href="/groupes/{{$groupe->id}}/supprimer">
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