@extends('layouts.admin')

@section('title','gestion des comptes des enseignants')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">comptes des enseignants</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/administrateur">Accueil</a></li>
                            <li class="breadcrumb-item active">compte enseignant</li>
                        </ol>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{session()->get('success')}}
                            </div>    
                        @endif
                        <a href="/ajouter-enseignant">
                            <button class="btn btn-primary btn-lg active p-2 mb-2">ajouter une compte</button>     
                        </a>            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>listes des enseignants.
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- tableau des comptes-->
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                     
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>émail</th>
                                                <td><b></b></td>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>émail</th>
                                                <td><b></b></td>
                                            </tr>
                                        </tfoot>
                                        <tbody> 
                                            @foreach ($enseignants as $enseignant)
                                                <tr>
                                                    <td>{{$enseignant->nom}}</td>
                                                    <td>{{$enseignant->prenom}}</td>
                                                    <td>{{$enseignant->email}}</td>
                                                    <td style="width: 10%"> 
                                                        <a href="/enseignants/{{$enseignant->id}}" title="plus d'information" data-serp-pos="1" class="mr-2" style="color:#00bcd4">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="/enseignants/{{$enseignant->id}}/éditer" title="modifier" data-serp-pos="1" class="mr-2" style="color:#4caf50">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" title="supprimer" filiere="{{$enseignant->filiere}}" id="{{$enseignant->id}}" class="mr-2 supprimer" style="color:#f44336">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <div id="confirmation" class="modal fade">
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
                                        <button type="button" name="supprimer" id="supprimer" class="btn btn-danger">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="confirmation_chefFiliere" class="modal fade">
                    <div class="modal-dialog modal-confirm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i><br>
                                    
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>----responsable de la filière!!!!----</p>
                            </div>
                        </div>
                    </div>
                </div>
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
        <script>
            var enseignant_id;
            var enseignant_filiere;
            $(document).ready(function(){
                $(document).on('click', '.supprimer', function(){
                    enseignant_id = $(this).attr('id');
                    enseignant_filiere = $(this).attr('filiere');
                    if (!enseignant_filiere) {
                        $('#confirmation').modal('show');
                    } else {
                        $('#confirmation_chefFiliere').modal('show');
                    }
                    
                });
    
                $('#supprimer').click(function(){
                    $.ajax({
                        url:"/enseignants/"+enseignant_id+"/supprimer",
                        beforeSend:function(){
                            $('#supprimer').text('Suppression ...');
                        },
                        success:function(data)
                        {
                            setTimeout(function(){
                                $('#confirmation').modal('hide');
                                location.reload();
                            }, 500);
                        }
                    })
                });
    
            });
        </script>
@endsection