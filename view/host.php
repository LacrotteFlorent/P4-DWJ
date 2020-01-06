<!DOCTYPE HTML>
<!-- Couleurs :
    Blanc       #FFFFFF
    Gris        #333
    Gris clair  #919191
    Gris foncé  #181A1B
    Orangé      #542E00
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

            <section class="row" id="topLeaf">
                <div id="spaceLeaf" class="col-2 d-none d-sm-block"></div>
                <div id="photoLeaf" class="col-12 col-sm-8">
                    <div id="frameworkLeaf" class="row">
                        <div id="textLeaf" class="mt-3 m-sm-3">
                            <h2>"Billet simple pour l'Alaska"</h2>
                            <p>Un roman publié en ligne</p>
                        </div>
                        <div id="inputLeaf" class="mb-3">
                            <button>Dernier Chapitres</button>
                            <button>A Propos</button>
                            <button>Livre</button>
                        </div>
                    </div>
                </div>
                <div class="spaceLeaf col-2 d-none d-sm-block"></div>
            </section>

            <section class="row" id="insert">
                <div class="col-12">
                    <p><i>"J'ai fait le choix de partager ce livre avec vous en m'affranchissant d'un éditeur classique"</i></p>
                    <p><i>Partagez mon aventure !</i></p>
                    <div class="socialNetwork">
                        <div id="facebook" class="circle">
                        </div>
                        <div id="instagram" class="circle">
                        </div>
                        <div id="twitter" class="circle">
                        </div>
                    </div>
                </div>
            </section>

            <section  class="row justify-content-center" id="news">
                <div class="col-10">
                    <h2>Derniers Chapitres</h2>
                    <div class="splitter">
                        <div class="row justify-content-center">
                            <div class="split col-10"></div>
                        </div>
                    </div>
                </div>
                <div id=frameworkNews class="col-12 col-sm-10">
                    <div class="row px-2 mt-3">
                        <div class="chapter col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="row justify-content-center">
                                <div class="photoChapter col-10">
                                    <img src="../public/img/chapter1.jpg" />
                                </div>
                            </div>
                            <div class="context">
                                <h3>La route de tous les malheurs</h3>
                                <p class="dateChapter">Publié le 34 décembre 2393  à 14h44</p>
                                <p class="contentChapter">Salut, il était une fois une jolie princesse au royaumme des neiges qui rencontre un gentil bonhomme de neige Olaf ... </p>
                            </div>
                            <div class="more">
                                <button>Lire la suite</button>
                            </div>
                            <div class="socialNetworkChapter mx-3 row">
                                <div class="split col-3"></div>
                                <div class="socialCircles col-6">
                                    <div class="row">
                                        <div id="facebook" class="circle"></div>
                                        <div id="instagram" class="circle"></div>
                                        <div id="twitter" class="circle"></div>
                                    </div>
                                </div>
                                <div class="split col-3"></div>
                            </div>
                        </div>
                        <div class="chapter col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        
                        </div>
                        <div class="chapter col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        
                        </div>
                    </div>
                </div>
            </section>

            <section class="row justify-content-center" id="about">
                <div class="col-10">
                    <h2>A propos</h2>
                </div>
                <div class="splitter col-12">
                    <div class="row">
                        <div class="spaceSplit col-1"></div>
                        <div class="split col-10"></div>
                        <div class="spaceSplit col-1"></div>
                    </div>
                </div>
                <div class="col-10">
                    <div id="book" class="inset book row">
                        <div class="title col-12 my-lg-4">
                            <h3>Le livre</h3>
                            <div class="row justify-content-start">
                                <div class="split col-6"></div>
                            </div>
                        </div>
                        <div class="photo col-12 col-sm-12 col-md-5">
                            <img src="../public/img/chapter2.jpg" />
                        </div>
                        <div class="content col-12 col-sm-12 col-md-7">
                            <h3 Class="my-3 m-md-0 mb-md-3">Billet simple pour l'Alaska</h3>
                            <p>Est un roman publié par Jean Forteroche, en autopublication sur internet à partir du 34 juillon 4356.</p>
                            <p>Le but étant de laisser libre court au préccesus créatif, aucunes barrière entre le lecteur et l'auteur.</p>
                            <p>Il est publié sous forme de chapitres individuel que vous pouvez lire à chaque nouvelles publication.</p>
                            <p>C'est l'histoire de ma jeunesse et des hommes et femmes que j'ai rencontré en vivant cette aventure extraordinaire, d'aller vivre en Alaska</p>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div id="author" class="inset author row">
                        <div class="title col-12 mb-lg-4">
                            <h3>L'auteur</h3>
                            <div class="row justify-content-end">
                                <div class="split col-6"></div>
                            </div>
                        </div>
                        <div class="content col-12 col-sm-12 col-md-7">
                            <h3 class="mb-1 m-md-0">Jean Forteroche</h3>
                            <p>Je me suis révélé écrivaint que tard, et heureusement j'ai eu la chance de vivre de grandes aventures.</p>
                            <p>Ce ne sera pas mon premier roman, mais les précédent "Au pays des Merveilles - 2003" et "Dans la grande tourmante - 1999" on été publié de manière classique ches les éditions bigflammion.</p>
                            <p>Je suis originaire de haute savoie et nés de parents explorateurs.</p>
                        </div>
                        <div class="photo col-12 col-sm-12 col-md-5">
                            <img src="../public/img/jean_forteroche.jpg" />
                        </div>
                    </div>
                </div>
            </section>
            
            <?php include("include_footer.php"); ?>
        </div>
    </body>

</html>