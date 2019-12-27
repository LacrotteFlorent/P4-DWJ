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
    
    <body class="container">

        <?php include("includes/include_header.php"); ?>

        <div id="blogMainSplit" class="row">
            <!-- main section with content -->
            <section id="blogContent" class="col-10">
                <!-- new chapter -->
                    <section id="blogLastChapter" class="row">
                        <div id="blogLastChapterPhoto" class="col-12">
                            <img src="./img/chapter1.jpg"  alt="photo d'illustration du chapitre 1" />
                        </div>
                        <div id="blogLastChapterSocialNetwork" class="col-12">
                            <div class="row">
                                <div id="facebook" class="circle"></div>
                                <div id="instagram" class="circle"></div>
                                <div id="twitter" class="circle"></div>
                                <div id="like" class="circle"></div>
                            </div>
                        </div>
                        <div id="blogLastChapterContent" class="col-12">
                            <div class="row">
                                <div id="blogLastChapterText" class="col-12">
                                    <h2>La route de tous les malheurs</h2>
                                    <p>Salut, il était une fois une jolie princesse au royaumme des neiges qui rencontre un gentil bonhomme de neige Olaf ...</p>
                                    <p>Eodem tempore Serenianus ex duce, cuius ignavia populatam in Phoenice Celsen ante rettulimus, pulsatae maiestatis imperii reus iure postulatus ac lege, incertum qua potuit suffragatione absolvi, aperte convictus familiarem suum cum pileo, quo caput operiebat, incantato vetitis artibus ad templum misisse fatidicum, quaeritatum expresse an ei firmum portenderetur imperium, ut cupiebat, et cunctum.</p>
                                    <p>Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?</p>
                                    <p>Haec igitur prima lex amicitiae sanciatur, ut ab amicis honesta petamus, amicorum causa honesta faciamus, ne exspectemus quidem, dum rogemur; studium semper adsit, cunctatio absit; consilium vero dare audeamus libere. Plurimum in amicitia amicorum bene suadentium valeat auctoritas, eaque et adhibeatur ad monendum non modo aperte sed etiam acriter, si res postulabit, et adhibitae pareatur.</p>
                                </div>
                            </div>
                            <div id="blogLastChapterButton" class="col-12">
                                <div class="row">
                                    <div class="split col-5"></div>
                                    <div class="more col-2">
                                        <div class="row">
                                            <button>Lire la suite</button>
                                        </div>
                                    </div>
                                    <div class="split col-5"></div>
                                </div>
                            </div>
                            <div id="blogLastChapterInformation" class="col-12">
                                <div>
                                    <i class="fas fa-upload"></i><p>Publié le 12 Janvier 2020 à 15h42</p>
                                </div>
                                <div>
                                    <i class="far fa-comment"></i><p> 34 Commentaires</p>
                                </div>
                                <div>
                                    <i class="far fa-heart"></i><p> 67 J'aime</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- old Chapter -->
                    <section id="blogOldChapter" class="row">
                        <div class="col-12">
                            <div class="row">
                                <div id="blogPhotoChapter" class="col-4">
                                    <img src="./img/chapter2.jpg"  alt="photo d'illustration du chapitre 1" />
                                </div>
                                <div id="blogContentChapter" class="col-8">
                                    <div class="context">
                                        <h3>La route de tous les malheurs</h3>
                                        <p class="dateChapter">Publié le 34 décembre 2393  à 14h44</p>
                                        <p class="contentChapter">Salut, il était une fois une jolie princesse au royaumme des neiges qui rencontre un gentil bonhomme de neige Olaf ... </p>
                                        <a href="###">Lire la suite >>></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div id="blogPhotoChapter" class="col-4">
                                    <img src="./img/chapter3.jpg"  alt="photo d'illustration du chapitre 1" />
                                </div>
                                <div id="blogContentChapter" class="col-8">
                                    <div class="context">
                                        <h3>La route de tous les bonheurs</h3>
                                        <p class="dateChapter">Publié le 34 décembre 2393  à 14h44</p>
                                        <p class="contentChapter">Salut, il était une fois une jolie princesse au royaumme des neiges qui rencontre un gentil bonhomme de neige Olaf ... </p>
                                        <a href="###">Lire la suite >>></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div id="blogPhotoChapter" class="col-4">
                                    <img src="./img/chapter4.jpg"  alt="photo d'illustration du chapitre 1" />
                                </div>
                                <div id="blogContentChapter" class="col-8">
                                    <div class="context">
                                        <h3>La route de tous les défis</h3>
                                        <p class="dateChapter">Publié le 34 décembre 2393  à 14h44</p>
                                        <p class="contentChapter">Salut, il était une fois une jolie princesse au royaumme des neiges qui rencontre un gentil bonhomme de neige Olaf ... </p>
                                        <a href="###">Lire la suite >>></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            <!-- aside section from right -->
            <aside id="blogAside" class="col-2">
                <div class="row">
                    <!-- summary -->
                    <div id="blogAsideSummary" class="col-12">
                        <h4>Sommaire</h4>
                        <div class="row splitRow">
                            <div class="split col-6"></div>
                            <div class="spaceSplit col-6"></div>
                        </div>
                        <ul>
                            <li><a href="##">Chapitre 1: A manger</a></li>
                            <li><a href="##">Chapitre 2: A boire</a></li>
                            <li><a href="##">Chapitre 3: A faire</a></li>
                            <li><a href="##">Chapitre 4: A ranger</a></li>
                            <li><a href="##">Chapitre 5: A changer</a></li>
                        </ul>
                    </div>
                    <!-- search -->
                    <div id="blogAsideSearch" class="col-12">
                        <h4>Rechercher</h4>
                        <div class="row splitRow">
                            <div class="split col-6"></div>
                            <div class="spaceSplit col-6"></div>
                        </div>
                        <p>Retrouvez facilement votre chapitre</p>
                        <input class="col-12" id="search_input_blog" type="text" placeholder=" Rechercher" />
                    </div>
                    <!-- newsletter -->
                    <div id="blogAsideNewsletter" class="col-12">
                        <h4>Newsletter</h4>
                        <div class="row splitRow">
                            <div class="split col-6"></div>
                            <div class="spaceSplit col-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p>Inscrivez vous pour être informé de la sortie des derniers chapitres.</p>
                                <form method="POST" action="newsletter_post.php">
                                    <label for="nom_newsletter_blog">Nom :</label>
                                    <input type="text" id="nom_newsletter_blog" name="nom_newsletter_blog" placeholder=" Entrez votre nom" />
                                    <label for="prenom_newsletter_blog">Prénom :</label>
                                    <input type="text" id="prenom__newsletter_blog" name="prenom_newsletter_blog" placeholder=" Entrez votre prénom" />
                                    <label for="mail_newsletter_blog">Addresse mail :</label>
                                    <input type="email" id="mail_newsletter_blog" name="mail_newsletter_blog" placeholder=" Entrez votre email" />
                                    <p>Les données à caractère personnel que vous nous communiquez feront l'objet d'un traitement automatisé aux fins de gestion de votre demande. Vous disposez d'un droit d'accès, de rectification, de suppression, de limitation et d'opposition conformément à la réglementation sur la protection des données à caractère personnel.</p>
                                    <div id="divRGPD">
                                        <input type="checkbox" id="acceptRGPD_newsletter_blog" name="acceptRGPD_newsletter_blog">
                                        <label for="acceptRGPD_newsletter_blog">Je reconnais avoir pris connaissance de ces droits.</label>
                                    </div>
                                    <button type="submit" value="S'inscrire" id="register_newsletter_blog">S'inscrire</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
        
        <?php include("includes/include_footer.php"); ?>

    </body>
    
</html>