@extends('layouts.enseignant')

@section('title','Emploi de temps')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Emploi du temps</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/chefDeFilière">Accueil</a></li>
                <li class="breadcrumb-item active">Emploi</li>

            </ol>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>    
            @endif
        </div>
    </main>
    <div id="layoutAuthentication_content" class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>Emploi du temps
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table100 ver1 voirTable table-responsive-lg" data-vertable="ver1">
                    <tr class="row100 tableauT">
                        <th class="cellule mytdemploi " > Heure ></td>
                        <th class="cellule mytdemploi  column100 column1" > 8h00-9:45 </th>
                        <th class="cellule mytdemploi  column100 column2" > 10h00-11h45 </th>
                        <th class="cellule mytdemploi  column100 column3" > 12h00-13h45 </th>
                        <th class="cellule mytdemploi  column100 column4" > 14h00-15h45</th>
                        <th class="cellule mytdemploi  column100 column5" > 16h00-17h45 </th>
                        <th class="cellule mytdemploi  column100 column6" > 18h00-19h45 </th>
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
                    <tr class="text-center-row row100 ">
                        <th class="tableauT"> {{  ${'J'.$i}  }} </th>
                        @for ($j = 1; $j < 7; $j++)
                            <td class="{{'column100 column'.$j}}" data-column="{{'column'.$j}}">
                                @foreach ($seances as $seance)
                                    @if ($seance->jour == ${'J'.$i})
                                        @if ($seance->heureD == ${'heureD'.$j})
                                            <a href="/générerCodeQr/{{$seance->id}}" class="no-underline">
                                                <b>{{$seance->module}}</b>
                                                <p class="small m-0" >{{$seance->type}}</p>
                                                <p class="small m-0" >{{$seance->salle}}</p>
                                            </a>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endfor
                    </tr>
                </table>       
            </div>
        </div>        
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
@endsection