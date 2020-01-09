<!DOCTYPE HTML>
<!-- Couleurs :
    Blanc       #FFFFFF
    Gris        #333
    Gris clair  #919191
    Gris foncé  #181A1B
    Orangé      #542E00
    Orang Clair #F08400
    Bleu clair  #00A3D0
    Bleu gris   #38435A
    Bleu foncé  #181D27
    -->
<!-- Blog d'écrivain - Made by Lacrotte Florent / Projet 4 - OpenClassrooms -->

<html>
    
    <head>
    <?php include("include_head.php"); ?>
    </head>
    
    <body>
        <div class="container-fluid adminDashboard">

            <?php include("include_header.php"); ?>

            <div class="row justify-content-center" id="adminDashboard">
                <div class="col-12 col-sm-10">
                    <h2 class="my-3">Tableau de bord</h2>
                    <div class="mt-5 row overviewAdmin justify-content-center">
                        <div class="col-12">
                            <h3 class="text-left bubbleTitle">Coup d'oeil</h3>
                        </div>
                        <div class="col-12 mb-4 p-3">
                            <div class="row">
                                <div class="bubbleDashboard col-12 col-sm-6 col-md-4 border p-2 text-center">
                                    <h5>Commentaires</h5>
                                    <div class="row justify-content-center align-items-baseline">
                                        <p>32</p>
                                        <i class="far fa-comment ml-2"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-12 col-sm-6 col-md-4 border p-2 text-center">
                                    <h5>On aimé</h5>
                                    <div class="row justify-content-center align-items-baseline">
                                        <p>164</p>
                                        <i class="far fa-heart ml-2"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-12 col-sm-6 col-md-4 border p-2 text-center">
                                    <h5>Nombre de vues</h5>
                                    <div class="row justify-content-center align-items-baseline">
                                        <p>1642</p>
                                        <i class="far fa-eye ml-2"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-12 col-sm-6 col-md-4 border p-2 text-center">
                                    <h5>Commentaires à modérer</h5>
                                    <div class="row justify-content-center align-items-baseline">
                                        <p>13</p>
                                        <i class="fas fa-comment-medical ml-2"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-12 col-sm-6 col-md-4 border p-2 text-center">
                                    <h5>Commentaires signalés</h5>
                                    <div class="row justify-content-center align-items-baseline">
                                        <p>2</p>
                                        <i class="fas fa-comment-slash ml-2"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-12 col-sm-6 col-md-4 border p-2 text-center">
                                    <h5>Créer un article</h5>
                                    <div class="row justify-content-center align-items-baseline">
                                        <i class="fas fa-feather-alt ml-2 border p-2 rounded-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row articlesAdmin card mb-4">
                        <div class="col-12 card-header">
                            <h3 class="text-left bubbleTitle m-0">Articles</h3>
                        </div>
                        <div class="col-12 p-3 card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Date de publication</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>La route du bonheur</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>La route du bonheur</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>La route du bonheur</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer px-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédente</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">Suivante</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="row comAdmin card mb-4">
                        <div class="col-12 card-header">
                            <h3 class="text-left bubbleTitle">Commentaires</h3>
                        </div>
                        <div class="col-12 p-3 card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Pseudo</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Date de publication</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Albert</td>
                                        <td>fhqhhfoqhqnfjhqfhqkfjqfjsqfhqfh</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Albert</td>
                                        <td>fhqhhfoqhqnfjhqfhqkfjqfjsqfhqfh</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Albert</td>
                                        <td>fhqhhfoqhqnfjhqfhqkfjqfjsqfhqfh</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer px-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédente</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">Suivante</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="row reportedComAdmin card mb-4">
                        <div class="col-12 card-header">
                            <h3 class="text-left bubbleTitle">Commentaires signalés</h3>
                        </div>
                        <div class="col-12 card-list-group my-2">
                            <form method="POST" action="" class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input id="autoSuprCom" name="autoSuprCom" type="checkbox" class="custom-control-input" />
                                    <label for="autoSuprCom" class="custom-control-label">Masquage automatique d'un commentaire signalé plus de 20 fois.</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 p-3 card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Pseudo</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Date de publication</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Albert</td>
                                        <td>fhqhhfoqhqnfjhqfhqkfjqfjsqfhqfh</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Albert</td>
                                        <td>fhqhhfoqhqnfjhqfhqkfjqfjsqfhqfh</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Albert</td>
                                        <td>fhqhhfoqhqnfjhqfhqkfjqfjsqfhqfh</td>
                                        <td>43 DEC 1234</td>
                                        <td>I B</td>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer px-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédente</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">Suivante</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include("include_footer.php"); ?>

        </div>

    </body>
    
</html>