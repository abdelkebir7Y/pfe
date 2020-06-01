<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>gestion des emplois</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
    <body >
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="/chefDeFilière">AbsenceApps</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown" style="color: white">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Emploi du temps</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/chefDeFilière">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="/emplois">Emplois</a></li>
                        <li class="breadcrumb-item active">{{$emploi->classe.' -> '.$emploi->groupe}}</li>

                    </ol>
                </div>
            </main>
            <div id="layoutAuthentication_content" class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="modal-content animate" action="/enregistrer_emploi" method="POST" >
                    @csrf
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>Modifier l'emploi du temps de groupe<b> G03.
                            <div class="float-right ">
                                <div class="col-md-6 float-left">
                                    <a href="/emplois">
                                        <button type="button" class="btn btn-secondary active  px-3 py-1 mb-0" >Annuler</button>
                                    </a>
                                </div>
                                <div class="col-md-6  float-right">
                                    <input type="submit" class="btn btn-primary active px-3 py-1 mb-0" value="enregistrer">
                                </div> 
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <input type="hidden"  name="emploi" value="{{$emploi->id}}">
                            <table class="table table100 ver1 voirTable table-bordered table-responsive-lg mb-0" data-vertable="ver1">
                                <tr class="row100 tableauT">
                                    <th class="mytdemploi"> Heure ></th>
                                    <th class="cellule mytdemploi  column100 column1"> 08h00-09h45 </th>
                                    <input type="hidden" value="08:00" name="heureD1">
                                    <input type="hidden" value="09:45" name="heureF1">
                                    <th class="cellule mytdemploi  column100 column2"> 10h00-12h45 </th>
                                    <input type="hidden" value="10:00" name="heureD2">
                                    <input type="hidden" value="11:45" name="heureF2">
                                    <th class="cellule mytdemploi  column100 column3"> 12h00-14h45 </th>
                                    <input type="hidden" value="12:00" name="heureD3">
                                    <input type="hidden" value="13:45" name="heureF3">
                                    <th class="cellule mytdemploi  column100 column4"> 14h00-16h45 </th>
                                    <input type="hidden" value="14:00" name="heureD4">
                                    <input type="hidden" value="15:45" name="heureF4">
                                    <th class="cellule mytdemploi  column100 column5"> 16h00-18h45 </th>
                                    <input type="hidden" value="16:00" name="heureD5">
                                    <input type="hidden" value="17:45" name="heureF5">
                                    <th class="cellule mytdemploi  column100 column6"> 18h00-19h45 </th>
                                    <input type="hidden" value="18:00" name="heureD6">
                                    <input type="hidden" value="19:45" name="heureF6">
                                    <input type="hidden" value="NULL" name="null">
                                </tr>
                                @php
                                    $J1 = 'Lundi';
                                    $J2 = 'Mardi';
                                    $J3 = 'Mercredi';
                                    $J4 = 'Jeudi';
                                    $J5 = 'Vendredi';
                                    $J6 = 'Samedi';
                                    $heureD1 = '08:00';
                                    $heureD2 = '10:00';
                                    $heureD3 = '12:00';
                                    $heureD4 = '14:00';
                                    $heureD5 = '16:00';
                                    $heureD6 = '18:00';
                                @endphp
                                @for ($i = 1; $i < 7; $i++)
                                    <tr class="text-center-row row100 ">
                                        <th class="tableauT"> {{  ${'J'.$i}  }} </th>
                                        <input type="hidden" value="{{  ${'J'.$i}  }}" name="{{'J'.$i}}">
                                        @for ($j = 1; $j < 7; $j++)
                                            <td class="es mytdemploi {{'column100 column'.$j}}" data-column="{{'column'.$j}}">
                                                <div class="form-group justify-content-centre">
                                                    @php
                                                        $bool = true;
                                                    @endphp
                                                    @foreach ($seances as $seance)
                                                        @if ($seance->jour == ${'J'.$i})
                                                            @if ($seance->heureD == ${'heureD'.$j})
                                                                @if ( !$errors->any() || old('c'.$i.$j) == 'on')
                                                                    <input type="checkbox" name="{{'c'.$i.$j}}" checked>
                                                                    <div class="form-group hidden" style="display: block">
                                                                        <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_module'}}" >
                                                                            <option value="{{ old('J'.$i.'S'.$j.'_module') ? old('J'.$i.'S'.$j.'_module') : $seance->module}}">{{old('J'.$i.'S'.$j.'_module') ? old('J'.$i.'S'.$j.'_module') : $seance->module}}</option>
                                                                            @foreach ($modules as $module)
                                                                                @if (old('J'.$i.'S'.$j.'_module') ? old('J'.$i.'S'.$j.'_module') != $module->module : $seance->module != $module->module)
                                                                                    <option value="{{$module->module}}">{{$module->module}}</option>  
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group hidden" style="display: block">
                                                                        <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_enseignant'}}" >
                                                                            <option value="{{old('J'.$i.'S'.$j.'_enseignant') ? old('J'.$i.'S'.$j.'_enseignant') :$seance->enseignant}}">{{old('J'.$i.'S'.$j.'_enseignant') ? old('J'.$i.'S'.$j.'_enseignant') :$seance->enseignant}}</option>
                                                                            @foreach ($enseignants as $enseignant)
                                                                                @if (old('J'.$i.'S'.$j.'_enseignant') ? old('J'.$i.'S'.$j.'_enseignant') != ($enseignant->nom.' '.$enseignant->prenom) : $seance->enseignant != ($enseignant->nom.' '.$enseignant->prenom))
                                                                                    <option value="{{$enseignant->nom.' '.$enseignant->prenom}}">{{$enseignant->nom.' '.$enseignant->prenom}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group hidden" style="display: block">
                                                                        <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_type'}}" >
                                                                            <option value="{{old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type') : $seance->type}}">{{old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type') :$seance->type}}</option>
                                                                            @if (old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type') == "Cours" :$seance->type == "Cours")
                                                                                <option value="TP">TP</option>
                                                                                <option value="TD">TD</option>
                                                                            @else 
                                                                                @if (old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type') == "TP":$seance->type == "TP")
                                                                                    <option value="Cours">Cours</option>
                                                                                    <option value="TD">TD</option>
                                                                                @else
                                                                                    <option value="Cours">Cours</option>
                                                                                    <option value="TP">TP</option>
                                                                                @endif
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group hidden" style="display: block">
                                                                        <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_salle'}}" >
                                                                            <option value="{{old('J'.$i.'S'.$j.'_salle') ? old('J'.$i.'S'.$j.'_salle') :$seance->salle}}">{{old('J'.$i.'S'.$j.'_salle') ? old('J'.$i.'S'.$j.'_salle') : $seance->salle}}</option>
                                                                            @foreach ($salles as $salle)
                                                                                @if (old('J'.$i.'S'.$j.'_salle') ? old('J'.$i.'S'.$j.'_salle') != $salle->salle :$seance->salle != $salle->salle)
                                                                                    <option value="{{$salle->salle}}">{{$salle->salle}}</option>  
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @php
                                                                        $bool = false;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @if ($bool)
                                                        @if(old('c'.$i.$j) == 'on')
                                                            <input type="checkbox" name="{{'c'.$i.$j}}" checked>
                                                            <div class="form-group hidden" style="display: block">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_module'}}" >
                                                                    <option value="{{ old('J'.$i.'S'.$j.'_module') ? old('J'.$i.'S'.$j.'_module') : $seance->module}}">{{old('J'.$i.'S'.$j.'_module') ? (old('J'.$i.'S'.$j.'_module') == "NULL" ? "==Module==": old('J'.$i.'S'.$j.'_module')): $seance->module}}</option>
                                                                    @foreach ($modules as $module)
                                                                        @if (old('J'.$i.'S'.$j.'_module') ? old('J'.$i.'S'.$j.'_module') != $module->module : $seance->module != $module->module)
                                                                            <option value="{{$module->module}}">{{$module->module}}</option>  
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group hidden" style="display: block">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_enseignant'}}" >
                                                                    <option value="{{old('J'.$i.'S'.$j.'_enseignant') ? old('J'.$i.'S'.$j.'_enseignant') :$seance->enseignant}}">{{old('J'.$i.'S'.$j.'_enseignant') ? old('J'.$i.'S'.$j.'_enseignant')  == "NULL" ? "==Enseignant==": old('J'.$i.'S'.$j.'_enseignant') :$seance->enseignant}}</option>
                                                                    @foreach ($enseignants as $enseignant)
                                                                        @if (old('J'.$i.'S'.$j.'_enseignant') ? old('J'.$i.'S'.$j.'_enseignant') != ($enseignant->nom.' '.$enseignant->prenom) : $seance->enseignant != ($enseignant->nom.' '.$enseignant->prenom))
                                                                            <option value="{{$enseignant->nom.' '.$enseignant->prenom}}">{{$enseignant->nom.' '.$enseignant->prenom}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group hidden" style="display: block">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_type'}}" >
                                                                    <option value="{{old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type') : $seance->type}}">{{old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type')  == "NULL" ? "==Type==": old('J'.$i.'S'.$j.'_type') :$seance->type}}</option>
                                                                    @if (old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type') == "Cours" :$seance->type == "Cours")
                                                                        <option value="TP">TP</option>
                                                                        <option value="TD">TD</option>
                                                                    @else 
                                                                        @if (old('J'.$i.'S'.$j.'_type') ? old('J'.$i.'S'.$j.'_type') == "TP":$seance->type == "TP")
                                                                            <option value="Cours">Cours</option>
                                                                            <option value="TD">TD</option>
                                                                        @else
                                                                            <option value="Cours">Cours</option>
                                                                            <option value="TP">TP</option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="form-group hidden" style="display: block">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_salle'}}" >
                                                                    <option value="{{old('J'.$i.'S'.$j.'_salle') ? old('J'.$i.'S'.$j.'_salle') :$seance->salle}}">{{old('J'.$i.'S'.$j.'_salle') ? old('J'.$i.'S'.$j.'_salle')  == "NULL" ? "==Salle==": old('J'.$i.'S'.$j.'_salle'): $seance->salle}}</option>
                                                                    @foreach ($salles as $salle)
                                                                        @if (old('J'.$i.'S'.$j.'_salle') ? old('J'.$i.'S'.$j.'_salle') != $salle->salle :$seance->salle != $salle->salle)
                                                                            <option value="{{$salle->salle}}">{{$salle->salle}}</option>  
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @php
                                                                $bool = false;
                                                            @endphp
                                                        @else
                                                            <input type="checkbox" name="{{'c'.$i.$j}}">
                                                            <div class="form-group hidden">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_enseignant'}}" >
                                                                    <option value="NULL">==Enseignant==</option>
                                                                    @foreach ($enseignants as $enseignant)
                                                                        <option value="{{$enseignant->nom.' '.$enseignant->prenom}}">{{$enseignant->nom.' '.$enseignant->prenom}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group hidden">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_salle'}}" >
                                                                    <option value="NULL">==Salle==</option>
                                                                    @foreach ($salles as $salle)
                                                                        <option value="{{$salle->salle}}">{{$salle->salle}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group hidden">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_module'}}" >
                                                                    <option value="NULL">==Module==</option>
                                                                    @foreach ($modules as $module)
                                                                        <option value="{{$module->module}}">{{$module->module}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group hidden">
                                                                <select class="form-control px-3 m-0" name="{{'J'.$i.'S'.$j.'_type'}}" >
                                                                    <option value="NULL">==Type==</option>
                                                                    <option value="Cours">Cours</option>
                                                                    <option value="TP">TP</option>
                                                                    <option value="TD">TD</option>
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div> 
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor 
                            </table>
                        </div>
                    </div>  
                </form>
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
        <script src="/js/modifierEmploi.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/assets/demo/chart-area-demo.js"></script>
        <script src="/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="/assets/demo/datatables-demo.js"></script>
    </body>
</html>