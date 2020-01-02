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
    <?php include("includes/include_head.php"); ?>
    </head>
    
    <body>
        <div class="container-fluid">

            <?php include("includes/include_header.php"); ?>

            <div id="adminDashboard">
                <div class="row overviewAdmin">
                    <div class="col-10">
                        <div class="row">
                            <div class="col-3">
                                <h5>Commentaires</h5>
                                <div class="row justify-content-center">
                                    <p>32</p>
                                    <i class="far fa-comment"></i>
                                </div>
                            </div>
                            <div class="col-3">
                                <h5>On aimé</h5>
                                <div class="row justify-content-center">
                                    <p>164</p>
                                    <i class="far fa-heart"></i>
                                </div>
                            </div>
                            <div class="col-3">
                                <h5>Nombre de vues</h5>
                                <div class="row justify-content-center">
                                    <p>1642</p>
                                    <i class="far fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h5>Commentaires à modérer</h5>
                                <div class="row justify-content-center">
                                    <p>13</p>
                                    <i class="fas fa-comment-medical"></i>
                                </div>
                            </div>
                            <div class="col-4">
                                <h5>Commentaires signalés</h5>
                                <div class="row justify-content-center">
                                    <p>2</p>
                                    <i class="fas fa-comment-slash"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <h5>Créer un article</h5>
                                <div class="row justify-content-center">
                                    <i class="fas fa-feather-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row articlesAdmin">

                </div>
                <div class="row comAdmin">

                </div>
                <div class="row reportedComAdmin">

                </div>
            </div>
            
            <?php include("includes/include_footer.php"); ?>

        </div>

    </body>
    
</html>