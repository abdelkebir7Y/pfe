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
        <div id="layoutSidenav_content">{{-- 
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Emploi du temps</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/chefDeFilière">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="/emplois">Emplois</a></li>
                        <li class="breadcrumb-item active">{{$emploi->classe.' -> '.$emploi->groupe}}</li>

                    </ol>
                </div>
            </main> --}}
            <div class="container h-95">
                <div class="row justify-content-center">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>svp scannez le code ci dessous<b> G03.
                            <div class="float-right ">
                                <div class="col-md-6 float-left">
                                    <a href="/ajouterAbsence">
                                        <button type="button" class="btn btn-secondary active  px-3 py-1 mb-0" >Annuler</button>
                                    </a>
                                </div>
                                <div class="col-md-6  float-right">
                                    <a href="/ajouterAbsence">
                                        <button type="button" class="btn btn-primary active  px-3 py-1 mb-0" >enregistrer</button>
                                    </a>
                                </div> 
                            </div>
                        </div>
                        <img class="card-img" src="/{{$image}}" alt="codeQR">
                    </div> 
                </div>
            </div>
            {{-- <div id="layoutAuthentication_footer">
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
            </div> --}}
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