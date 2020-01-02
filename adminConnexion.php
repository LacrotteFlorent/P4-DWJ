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

            <div id="adminConnexion" class="row justify-content-center my-3">
                <div class="col-10">
                    <div class="row">
                        <div class="col-8">
                            <h2 class="my-3">Page de connexion</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4 my-4">
                            <form method="POST" action="contact_post" class="row">
                                <div class="connexionAdmin col-12 d-flex flex-column m-4 miniShadow p-4">
                                    <p>Connectez vous :</p>
                                    <label for="connexionIdent" class="pb-0" >Identifiant :</label>
                                    <input type="text" id="connexionIdent" name="connexionIdent" placeholder=" Identifiant" class="rounded-sm border-0 mb-4" />
                                    <label for="connexionMDP">Mot de passe :</label>
                                    <input type="text" id="connexionMDP" name="connexionMDP" placeholder=" ############" class="rounded-sm border-0 mb-4" />
                                    <button class="rounded-sm border-0" type="submit" value="Envoyer"><i class="far fa-paper-plane my-4"></i> Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <?php include("includes/include_footer.php"); ?>

        </div>

    </body>
    
</html>