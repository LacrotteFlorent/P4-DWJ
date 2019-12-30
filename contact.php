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

            <div id="contact" class="row justify-content-center">
                <div class="col-8 my-4">
                    <h2>Contactez moi</h2>
                    <form method="POST" action="contact_post" class="row">
                        <div class="col-12 d-flex flex-column">
                            <div class="row justify-content-around">
                                <div class="col-6 d-flex flex-column">
                                    <label for="contactName">Nom : </label>
                                    <input type="text" id="contactName" name="contactName" placeholder="Votre nom" />
                                </div>
                                <div class="col-6 d-flex flex-column">
                                    <label for="contactFirstName">Prénom :</label>
                                    <input type="text" id="contactFirstName" name="contactFirstName" placeholder="Votre prénom" />
                                </div>
                            </div>
                            <label for="contactMail">Addresse mail :</label>
                            <input type="text" id="contactMail" name="contactMail" placeholder="Votre adresse mail" />
                            <label for="contactObject">Objet du message :</label>
                            <input type="text" id="contactObject" name="contactObject" placeholder="L'objet de votre message" />
                            <label for="contactMessage">Message :</label>
                            <textarea id="contactMessage" name="contactMessage" cols="30" rows="10">Votre message ici</textarea>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="checkbox" id="acceptRGPD_contact" name="acceptRGPD_contact">
                                        <label for="acceptRGPD_contact">Je reconnais avoir pris connaissance de ces droits.</label>
                                    </div>
                                    <div class="col-6">
                                        <!-- recaptcha-->
                                        <p>reCaptcha</p>
                                    </div>
                                </div>
                            <button class="col-2" type="submit" value="Envoyer">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php include("includes/include_footer.php"); ?>

        </div>

    </body>
    
</html>