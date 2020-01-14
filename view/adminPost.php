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
                    <div class="mt-5 row justify-content-center">
                        <form class="col-12 mb-4" method="post">
                            <textarea id="postArea">Hello, World!</textarea>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php include("include_footer.php"); ?>

        </div>

    </body>
    
</html>