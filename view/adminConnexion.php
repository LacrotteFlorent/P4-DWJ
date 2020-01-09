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
    <?php include("./include_head.php"); ?>
    </head>
    
    <body>
        <div class="container-fluid">

            <?php include("./include_header.php"); ?>

            <div id="adminConnexion" class="row justify-content-center my-3">
                <div class="col-12 col-sm-11 col-md-10">
                    <div class="row d-none d-sm-block connexionTwenty">
                        <div class="col-8">
                            <h2 class="my-3">Page de connexion</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center connexionHeighty">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-4 my-4">
                            <form method="POST" action="contact_post">
                                <p>Connectez vous :</p>
                                <div class="form-group">
                                    <label for="connexionIdent">Identifiant :</label>
                                    <input type="text" id="connexionIdent" name="connexionIdent" placeholder=" Identifiant" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="connexionMDP">Mot de passe :</label>
                                    <input type="text" id="connexionMDP" name="connexionMDP" placeholder=" ############" class="form-control" required />
                                </div>
                                <button class="btn" type="submit" value="Envoyer"><i class="fas fa-sign-in-alt mx-2"></i> Se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include("./include_footer.php"); ?>

        </div>

    </body>
    
</html>