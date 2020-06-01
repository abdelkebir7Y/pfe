@extends('layouts.admin')

@section('title','gestion des filières')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Filières</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/administrateur">Accueil</a></li>
                    <li class="breadcrumb-item active">Filière</li>
                </ol>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>    
                @endif
                <div class="col">
                    <button class="btn btn-primary btn-lg active p-2 mb-2" id="redirect" data-toggle="modal" data-target="#new_filiere" data-whatever="@fat">ajouter une filière</button>
                    <div class="modal fade" id="new_filiere" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle filière</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="/ajouter-filiere">
                                    <div class="modal-body">
                                    
                                        @csrf
                                        @if ($errors->has('filiere') )
                                            <script>
                                                $( document ).ready(function() {
                                                    $('#new_filiere').modal('show');
                                                });
                                            </script>
                                            @error('filiere')
                                                <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        @endif
                    @if (!count($enseignants))
                                        <div class="alert alert-primary text-center">----svp ajoutez un enseignant----<br>
                                            --pour étre le chef de cette nouvelle filière--<br>
                                            <p id="number"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary active p-2 mb-2" data-dismiss="modal">Retour</button>
                                    </div>
                                    <script>
                                        $('#redirect').click(function() {
                                           countdown(6);
                                           setTimeout(function () { location.href='/comptes-enseignants'; }, 7000);
                                           $(this).unbind();
                                       });
                                        function countdown(timer) {
                                            var intervalID;
                                            intervalID = setInterval(function () {

                                                document.getElementById("number").innerHTML = timer;
                                                timer = timer - 1;
                                                if (timer < 0) {
                                                    clearTimeout(intervalID);
                                                }
                                            }, 1000);
                                        }
                                    </script>
                    @else
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="mb-0">Chef de filière</label>
                                            <select class="form-control px-3" id="exampleFormControlSelect1" name="chef" required >
                                                @foreach ($enseignants as $enseignant)
                                                    <option value="{{$enseignant->email}}">{{$enseignant->name.' ('.$enseignant->email.')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Nom de Nouvelle filière </label>
                                            <input type="text" class="form-control" id="nouveau_classe" name="filiere" value="{{old('filiere') ?old('filiere') :"" }}" placeholder="Entrer le nom de la filière" required/>
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
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>listes des filières.
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- tableau des comptes-->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                     
                                <thead>
                                    <tr>
                                        <th>Filière</th>
                                        <th>Chef de filière</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>        
                                        <th>Filière</th>
                                        <th>Chef de filière</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody> 
                                    @foreach ($filieres as $filiere)
                                        <tr>
                                            <td>{{$filiere->filiere}}</td>
                                            <td>{{$filiere->chef}}</td>
                                            <td style="width: 15%"> 
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier la filière</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="/filière/{{$filiere->id}}/éditer">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1" class="mb-0">Chef de filière</label>
                                                                <select class="form-control px-3" id="exampleFormControlSelect1" name="chef" required >
                                                                    <option value="{{$filiere->chef}}">{{$filiere->chef}}</option>
                                                                    @foreach ($enseignants as $enseignant)
                                                                        @if ($enseignant->name != $filiere->chef )
                                                                            <option value="{{$enseignant->email}}">{{$enseignant->name.' ('.$enseignant->email.')'}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                              </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Nom de filière</label>
                                                            <input type="text" class="form-control" id="nouveau_classe" name="filiere" value="{{$filiere->filiere}}" required/>
                                                            </div>
                                                    
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary active p-2 mb-2" data-dismiss="modal">Annuler</button>
                                                            <div class="form-group ">
                                                                <input type="submit" class="btn btn-primary active p-2 mb-2" value="enregistrer">
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
                                                        <p>Voulez-vous vraiment supprimer la filière <b style="color: red"> {{$filiere->filiere}}</b> ?</p>
                                                    </div>
                                                    <div class="modal-footer container">
                                                        <div class="row">
                                                            <div class="col-md-auto">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                                                            </div>
                                                            <div class="col-md-auto">
                                                                <a href="/filière/{{$filiere->id}}/supprimer">
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