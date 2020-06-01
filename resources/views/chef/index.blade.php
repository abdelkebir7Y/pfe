@extends('layouts.chef')

@section('title','Accueil')

@section('content')
    <div id="layoutSidenav_content" >
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Accueil</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">profil</li>
                </ol>
            </div>
        </main>
        <div class="container">
        <div class="row ">
            <div class="col-lg-7">
            <div class="profile">
                <div class="profile-image ">
                    <img  style="width: 70%;height: 1000%" src="https://dynamic.cirad.fr/var/dynamic/storage/images/dynamic/consortium/maghreb/ucam-maroc/31613-18-fre-FR/ucam-maroc.jpg" alt="">
                </div>
                <div class="profile-user-settings">    
                    <h1 class="profile-user-name">SMI<!-- gas agnsou ndadgh baxa adaghd tassi ism  lfilier tgertid sagnsou nda --></h1>
                    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#colapseLayouts" aria-expanded="false" aria-controls="colapseLayouts">
                        <button class="btn profile-edit-btn">paramètres</button>               
                        <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>
                    </a>
                    <div class="collapse" id="colapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="modifier_parametr.html">modifier les paramètres </a>
                        <a class="nav-link" href="#">déconnexion</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="profile-stats">
                <ul>
                    <br><br>
                    <a href="https://www.uca.ma/"><li>UCA </li></a>
                    <a href="https://www.uca.ma/fssm"><li> FSSM</li></a>
                </ul>
            </div>
            <div class="profile-bio">
                <p>
                    <span class="profile-real-name">
                        Bienvenue sur la plateforme <i>AbsenceApps</i> pour gérer automatiquement les absences. Vous êtes désormais responsable de la gestion des absences des étudiants filiére <b>{{$filiere}} </b>
                    </span>
                </p>
            </div>
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
@endsection