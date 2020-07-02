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
            <div id="layoutAuthentication">
                <div id="layoutAuthentication_content">
                    <main>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Éditer le compte</h3></div>
                                        <div class="card-body">
                                            <form action="/etudiants/{{$etudiant->id}}/éditer" method="POST">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="nom">Nom</label>
                                                            <input value="{{old('nom') ? old('nom') :$etudiant->nom}}" class="form-control py-4" id="nom" name="nom" type="text" placeholder="Entrer le nom" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="prenom">Prénom</label>
                                                            <input value="{{old('prenom') ? old('prenom') :$etudiant->prenom}}" class="form-control py-4" id="prenom" type="text" name="prenom" placeholder="Entrer le prénom" required/>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                <div class="form-group">
                                                    <label class="  small mb-1" for="nApogee">N° Apogée</label>
                                                    <input value="{{old('nApogee') ? old('nApogee') :$etudiant->nApogee}}" class="form-control py-4 @error('nApogee') is-invalid @enderror " name="nApogee" id="nApogee" type="text" placeholder="1615517 " required />
                                                </div>
                                                @error('nApogee')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                    <input value="{{old('email') ? old('email') : $etudiant->email}}" class="form-control py-4 @error('email') is-invalid @enderror" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Entrer émail addresse" required />
                                                </div>
                                                @error('email')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                                <div class="form-group ">
                                                    <label for="filiere" class="mb-0">Filière</label>
                                                    <select class="form-control px-3 dynamic" id="filiere" name="filiere" data-dependent="classe" required>
                                                        <option value="{{old('filiere') ? old('filiere') :$etudiant->filiere}}">{{old('filiere') ? old('filiere') :$etudiant->filiere}}</option>
                                                        @foreach($filieres as $filiere)
                                                            @if ($filiere->filiere != $etudiant->filiere)
                                                                <option value="{{ $filiere->filiere}}">{{ $filiere->filiere }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div> 
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="classe">Classe</label>
                                                            <select name="classe" id="classe" class="form-control px-3 dynamic" data-dependent="groupe" required>
                                                                <option value="{{old('classe') ? old('classe') :$etudiant->classe}}">{{old('classe') ? old('classe') :$etudiant->classe}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="groupe">Groupe</label>
                                                            <select name="groupe" id="groupe" class="form-control px-3" required>
                                                                <option value="{{old('groupe') ? old('groupe') :$etudiant->groupe}}">{{old('groupe') ? old('groupe') :$etudiant->groupe}}</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                <div class="form-group mt-4 p-0 d-flex justify-content-center">
                                                    <input type="submit" value="Enregistrer"class="px-5 btn btn-primary btn-lg active p-2 mb-2">
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
    </div>
    <script>
        $(document).ready(function(){
        
            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('etudiant.chercherClasseGroupe') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {
                            $('#'+dependent).html(result);
                        }
                    
                    })
                }
            });
            
            $('#filiere').change(function(){
                $('#classe').val('');
                $('#groupe').val('');
            });
            
            $('#classe').change(function(){
                $('#groupe').val('');
            });
            
        });
    </script>
@endsection