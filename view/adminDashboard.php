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
        <div class="container-fluid">

            <?php include("include_header.php"); ?>

            <div class="row justify-content-center" id="adminDashboard">
                <div class="col-10">
                    <h2 class="my-3">Tableau de bord</h2>
                    <div class="mt-5 row overviewAdmin justify-content-center">
                        <div class="col-12">
                            <h3 class="text-left bubbleTitle">Coup d'oeil</h3>
                        </div>
                        <div class="col-12 mb-4 p-3">
                            <div class="row justify-content-between mb-4">
                                <div class="bubbleDashboard col-3 miniShadow p-2 text-center">
                                    <h5>Commentaires</h5>
                                    <div class="row justify-content-center">
                                        <p>32</p>
                                        <i class="far fa-comment"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-4 miniShadow p-2 text-center">
                                    <h5>On aimé</h5>
                                    <div class="row justify-content-center">
                                        <p>164</p>
                                        <i class="far fa-heart"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-3 miniShadow p-2 text-center">
                                    <h5>Nombre de vues</h5>
                                    <div class="row justify-content-center">
                                        <p>1642</p>
                                        <i class="far fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="bubbleDashboard col-4 miniShadow p-2 text-center">
                                    <h5>Commentaires à modérer</h5>
                                    <div class="row justify-content-center">
                                        <p>13</p>
                                        <i class="fas fa-comment-medical"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-4 miniShadow p-2 text-center">
                                    <h5>Commentaires signalés</h5>
                                    <div class="row justify-content-center">
                                        <p>2</p>
                                        <i class="fas fa-comment-slash"></i>
                                    </div>
                                </div>
                                <div class="bubbleDashboard col-2 miniShadow p-2 text-center">
                                    <h5>Créer un article</h5>
                                    <div class="row justify-content-center">
                                        <i class="fas fa-feather-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row articlesAdmin">
                        <div class="col-12">
                            <h3 class="text-left bubbleTitle">Articles</h3>
                        </div>
                        <div class="col-12 miniShadow mb-4 p-3">
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
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
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
                    <div class="row comAdmin">
                        <div class="col-12">
                            <h3 class="text-left bubbleTitle">Commentaires</h3>
                        </div>
                        <div class="col-12 miniShadow mb-4 p-3">
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
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
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
                    <div class="row reportedComAdmin">
                        <div class="col-12">
                            <h3 class="text-left bubbleTitle">Commentaires signalés</h3>
                        </div>
                        <div class="col-12">
                            <form method="POST" action="">
                                <div class="custom-control custom-checkbox">
                                    <input id="autoSuprCom" name="autoSuprCom" type="checkbox" class="custom-control-input" />
                                    <label for="autoSuprCom" class="custom-control-label">Masquage automatique d'un commentaire signalé plus de 20 fois.</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 miniShadow mb-4 p-3">
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
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
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