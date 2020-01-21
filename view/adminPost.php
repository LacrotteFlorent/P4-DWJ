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
        <div class="container-fluid adminPost">

            <?php include("include_header.php"); ?>

            <div class="row justify-content-center" id="adminPost">
                <div class="col-12 col-sm-10">
                    <h2 class="my-3">Editeur d'articles</h2>
<!--
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3><i class="far fa-hand-pointer"></i> Selecteur</h3>
                        </div>
                        <div class="card-body">
                            <h4>Selectionnez un article à modifier ou créez un nouveau</h4>
                            <p>Pour selectionner un article utilisez la liste déroulante</p>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect02">
                                  <option selected>Selectionnner un article</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>
                                <div class="input-group-append">
                                  <label class="input-group-text" for="inputGroupSelect02">Articles</label>
                                </div>
                            </div>
                        </div>
                    </div>
-->
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3><i class="fas fa-heading"></i> Titre</h3>
                        </div>
                        <div class="card-body">
                            <h4>Choisissez un titre pour votre article</h4>
                            <p>Ce titre apparaitra dans l'article et dans la liste d'articles</p>
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" placeholder="Entrez un titre ici" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="addon-wrapping">Titre</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3><i class="far fa-image"></i> Image</h3>
                        </div>
                        <div class="card-body">
                            <h4>Choisissez une image pour votre article</h4>
                            <p>(Taille recommandée 400x600px)</p>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile02">
                                  <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"><em class="d-none d-md-block">Selectionner une image</em></label>
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text" id="inputGroupFileAddon02">Télécharger</span>
                                </div>
                            </div>
<<<<<<< HEAD
=======
                            <form method="POST" action="" class="list-group-item rounded-sm mb-2 p-2">
                                <div class="custom-control custom-checkbox">
                                    <input id="autoSuprCom" name="autoSuprCom" type="checkbox" class="custom-control-input" />
                                    <label for="autoSuprCom" class="custom-control-label">Ne pas afficher l'image dans l'article (cette image sera utilisée dans la page acceuil et blog seulement).</label>
                                </div>
                            </form>
>>>>>>> a8bddfb6062c8640a2dbea4430d7367dae5f9669
                            <p>Aperçu :</p>
                            <img src="../public/img/chapter1.jpg"  alt="photo d'illustration du chapitre 1" class="img-fluid img-thumbnail" />
                        </div>
                    </div>
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3><i class="fas fa-paragraph"></i> Contenu</h3>
                        </div>
                        <div class="card-body">
                            <h4>Ajoutez du contenu à votre article</h4>
                            <p>Utilisez les fonctions de l'éditeur pour mettre en forme le texte</p>
                            <form class="col-12 mb-4" method="post">
                                <textarea id="postArea">Hello, World!</textarea>
                            </form>
                        </div>
                    </div>
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3><i class="fas fa-check"></i> Validation</h3>
                        </div>
                        <div class="row p-4">
                            <div class="col-sm-12">
                            <h4>Validez votre saisie</h4>
                            <p>Gérer les publications ici</p>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="card cardValid">
                                    <div class="card-body">
                                        <h4 class="card-title">Sauvegarder</h4>
                                        <p class="card-text">Vous pourrez reprendre le brouillion via la section Selecteur</p>
                                        <button type="button" class="btn btn-success">Enregister un brouillon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="card cardValid">
                                    <div class="card-body">
                                        <h4 class="card-title">Supprimer</h4>
                                        <p class="card-text">En cliquant sur le boutton vous supprimez l'article. Attention pas de retour possible.</p>
                                        <button class="btn btn-danger">Supprimer l'article</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="card cardValid">
                                    <div class="card-body">
                                        <h4 class="card-title">Publier maintenant</h4>
                                        <p class="card-text">Mettez votre article en ligne.</p>
                                        <button class="btn btn-info">Publier maintenant</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="card cardValid">
                                    <div class="card-body">
                                        <h4 class="card-title">Publier plus tard</h4>
                                        <p class="card-text">Mettez votre article en ligne à la date sélectionnée.</p>
                                        <p>
                                            <label for="dateAdminPost">Date de publication</label>
                                            <input type="date" id="dateAdminPost">
                                            <label for="timeAdminPost">Heure de publication</label>
                                            <input type="time" name="timeAdminPost">
                                        </p>
                                        <button class="btn btn-info">Publier plus tard</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include("include_footer.php"); ?>

        </div>

    </body>
    
</html>