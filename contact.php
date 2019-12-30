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

            <div id="contact" class="row">
                <h2>Contactez moi></h2>
                <form method="POST" action="contact_post" class="col-12">
                    <div class="row">
                        <div class="col 6">
                            <label for="contactName">Nom : </label>
                            <input type="text" id="contactName" name="contactName" placeholder="Votre nom" />
                        </div>
                        <div class="col-6">
                            <label for="contactFirstName">Prénom :</label>
                            <input type="text" id="contactFirstName" name="contactFirstName" placeholder="Votre prénom" />
                        </div>
                    </div>
                    <label for="contactMail">Addresse mail :</label>
                    <input type="text" id="contactMail" name="contactMail" placeholder="Votre adresse mail" />
                    <label for="contactObject">Objet du message</label>
                    <input type="text" id="contactObject" name="contactObject" placeholder="L'objet de votre message" />
                    <label for="contactMessage">Message</label>
                    <textarea id="contactMessage" name="contactMessage" cols="30" rows="10">Votre message ici</textarea>
                    <div class="row">
                        <div class="col-6">
                            <input type="checkbox" id="acceptRGPD_contact" name="acceptRGPD_contact">
                            <label for="acceptRGPD_contact">Je reconnais avoir pris connaissance de ces droits.</label>
                        </div>
                        <div class="col-6">
                            <!-- recaptcha-->
                        </div>
                    </div>
                    <button type="submit" value="Envoyer">Envoyer</button>
                </form>
            </div>
            
            <?php include("includes/include_footer.php"); ?>

        </div>

    </body>
    
</html>