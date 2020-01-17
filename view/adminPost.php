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
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3>Selecteur</h3>
                        </div>
                        <div class="card-body">
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
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3>Titre</h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="addon-wrapping">Titre</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Entrez un titre ici" aria-label="Username" aria-describedby="addon-wrapping">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3>Image</h3>
                        </div>
                        <div class="card-body">
                            <h4>Choisissez une image pour votre article taille recommandée(434343x42424)</h4>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile02">
                                  <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choisissez un fichier</label>
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text" id="inputGroupFileAddon02">Télécharger</span>
                                </div>
                            </div>
                            <img src="../public/img/chapter1.jpg"  alt="photo d'illustration du chapitre 1" class="img-fluid img-thumbnail" />
                        </div>
                    </div>
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3>Contenu</h3>
                        </div>
                        <div class="card-body">
                            <form class="col-12 mb-4" method="post">
                                <textarea id="postArea">Hello, World!</textarea>
                            </form>
                        </div>
                    </div>
                    <div class="mb-4 row card">
                        <div class="card-header">
                            <h3>Validation</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-success">Enregister un brouillon</button>
                            <button class="btn btn-info">Publier maintenant</button>
                            <button class="btn btn-danger">Supprimer l'article</button>

                        </div>
                    </div>
                </div>
            </div>
            
            <?php include("include_footer.php"); ?>

        </div>

    </body>
    
</html>