@extends('layouts.admin')

@section('title','Accueil')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Accueil</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Accueil</li>
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
                    <h1 class="profile-user-name">Administrateur</h1>
                    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#colapseLayouts" aria-expanded="false" aria-controls="colapseLayouts">
                        <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>
                        <button class="btn profile-edit-btn">paramètres</button>
                    </a>
                    <div class="collapse" id="colapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/paramétre">modifier les paramètres </a>
                        <a class="nav-link" href="/login">déconnexion</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="profile-stats">
                <ul>
                    <br><br>
                    <a href="https://www.uca.ma/" target="_blank"><li>UCA </li></a>
                    <a href="https://www.uca.ma/fssm"  target="_blank"><li> FSSM</li></a>
                </ul>
            </div>
            <div class="profile-bio">
                <p><span class="profile-real-name"></span>Vous êtes maintenant responsable de la gestion de tous les comptes personnels des enseignants, des étudiants et des chefs des filères</p>
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