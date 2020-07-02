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
                                            <label for="nouveau_filiere" class="col-form-label">Nom de Nouvelle filière </label>
                                            <input type="text" class="form-control" id="nouveau_filiere" name="filiere" value="{{old('filiere') ?old('filiere') :"" }}" placeholder="Entrer le nom de la filière" required/>
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
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>        
                                        <th>Filière</th>
                                        <th>Chef de filière</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody> 
                                    @foreach ($filieres as $filiere)
                                        <tr class="data-row">
                                            <td class="filiere">{{$filiere->filiere}}</td>
                                            <td class="chef">{{$filiere->nom.' '.$filiere->prenom}}</td>
                                            <td class="email">{{$filiere->email}}</td>
                                            <td style="width: 15%"> 
                                                <a href="#" data-item-id="{{$filiere->id}}" id="button_modifier" title="modifier" class="mr-2 modifier" style="color:#4caf50">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#"  id="{{$filiere->id}}" title="supprimer"  class="mr-2 supprimer" style="color:#f44336">
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
                        <p>Voulez-vous vraiment supprimer cette filière ?</p>
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

    {{-- //////////////////////////////////////////// --}}

    
    <div class="modal fade" id="modifier_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier la filière</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="editForm">
                        @csrf
                        <div class="form-group">
                            <label class="mb-0">Chef de filière</label>
                            <select class="form-control px-3" name="chef" id="modifier_chef" required >
                                @foreach ($enseignants as $enseignant)
                                        <option value="{{$enseignant->email}}">{{$enseignant->name.' ('.$enseignant->email.')'}}</option>
                                @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="filiere" class="col-form-label">Nom de filière</label>
                            <input id="modifier_filiere" type="text" class="form-control" id="filiere" name="filiere" required/>
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
    <script>
        var filiere_id;
        $(document).ready(function(){
            $(document).on('click', '.supprimer', function(){
                filiere_id = $(this).attr('id');
                console.log(filiere_id);
                $('#confirmation').modal('show');
            });

            $('#supprimer').click(function(){
                $.ajax({
                    url:"/filière/"+filiere_id+"/supprimer",
                    beforeSend:function(){
                        $('#supprimer').text('Suppression ...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            location.reload();
                        }, 500);
                    }
                })
            });

            //  //////////////////////////////////////////////

            $(document).on('click', "#button_modifier", function() {
                $(this).addClass('modifier_cette_ligne'); 
                var options = {
                'backdrop': 'static'
                };
                $('#modifier_modal').modal(options)
            })

            $('#modifier_modal').on('show.bs.modal', function() {
                var el = $(".modifier_cette_ligne");
                var row = el.closest(".data-row");
                var id = el.data('item-id');
                var filiere = row.children(".filiere").text();
                var chef = row.children(".chef").text(); ///////////// nom prenom -------------- n'est pas un email
                var email = row.children(".email").text();
                document.getElementById('editForm').setAttribute('action','/filière/'+id+'/éditer');
                $("#modifier_filiere").val(filiere);

                $("#modifier_chef").prepend("<option value='"+email+"' selected='selected'>"+chef+' ('+email+' )'+"</option>");


            })

            $('#modifier_modal').on('hide.bs.modal', function() {
                $('.modifier_cette_ligne').removeClass('modifier_cette_ligne')
                $("#editForm").trigger("reset");
                $("#modifier_chef").trigger("reset");
                $("#modifier_chef").find('option').get(0).remove();
            })
        });
    </script>
@endsection