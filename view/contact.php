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
        <div class="container-fluid">

            <?php include("include_header.php"); ?>

            <div id="contact" class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-9 col-lg-7 my-4">
                    <h2 class="mb-4">Formulaire de contact</h2>
                    <form method="POST" action="contact_post" class="p-0 p-sm-3 p-md-5 border">
                        <div class="form row">
                            <div class="form-group col-md-6 col-12">
                                <label for="contactName">Nom : </label> 
                                <input type="text" id="contactName" name="contactName" placeholder=" Votre nom" class="form-control" />
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="contactFirstName">Prénom :</label>
                                <input type="text" id="contactFirstName" name="contactFirstName" placeholder=" Votre prénom" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contactMail" class="pb-0" >Addresse mail :</label>
                            <input type="text" id="contactMail" name="contactMail" placeholder=" Votre adresse mail" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="contactObject">Objet du message :</label>
                            <input type="text" id="contactObject" name="contactObject" placeholder=" L'objet de votre message" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="contactMessage">Message : (255 caractères max)</label>
                            <textarea id="contactMessage" name="contactMessage" cols="30" rows="10" class="form-control" placeholder=" Votre message ici"></textarea>
                        </div>
                        <div class="form row">
                            <div class="form-group col-md-6 col-12">
                                <p>Les données à caractère personnel que vous nous communiquez feront l'objet d'un traitement automatisé aux fins de gestion de votre demande. Vous disposez d'un droit d'accès, de rectification, de suppression, de limitation et d'opposition conformément à la réglementation sur la protection des données à caractère personnel.</p>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="acceptRGPD_contact" name="acceptRGPD_contact" />
                                    <label class="custom-control-label" for="acceptRGPD_contact"> Je reconnais avoir pris connaissance de ces droits.</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <!-- recaptcha-->
                                <p>reCaptcha</p>
                            </div>
                        </div>
                        <button class="btn mb-3" type="submit" value="Envoyer"><i class="far fa-paper-plane mx-2"></i> Envoyer</button>
                    </form>
                </div>
            </div>
            
            <?php include("include_footer.php"); ?>

        </div>

    </body>
    
</html>



<!--
<form method="POST" action="contact_post" class="row p-5 border">
    <div class="col-12 d-flex flex-column form-group">
        <div class="form-row justify-content-around">
            <div class="col-6 d-flex flex-column">
                <label for="contactName">Nom : </label> 
                <input type="text" id="contactName" name="contactName" placeholder=" Votre nom" class="form-control rounded-sm border-0" />
            </div>
            <div class="col-6 d-flex flex-column">
                <label for="contactFirstName">Prénom :</label>
                <input type="text" id="contactFirstName" name="contactFirstName" placeholder=" Votre prénom" class="form-control rounded-sm border-0" />
            </div>
        </div>
        <label for="contactMail" class="pb-0" >Addresse mail :</label>
        <input type="text" id="contactMail" name="contactMail" placeholder=" Votre adresse mail" class="form-control rounded-sm border-0" />
        <label for="contactObject">Objet du message :</label>
        <input type="text" id="contactObject" name="contactObject" placeholder=" L'objet de votre message" class="form-control rounded-sm border-0" />
        <label for="contactMessage">Message :</label>
        <textarea id="contactMessage" name="contactMessage" cols="30" rows="10" class="form-control rounded-sm border-0" placeholder=" Votre message ici"></textarea>
            <div class="row my-3">
                <div class="col-6">
                    <p>Les données à caractère personnel que vous nous communiquez feront l'objet d'un traitement automatisé aux fins de gestion de votre demande. Vous disposez d'un droit d'accès, de rectification, de suppression, de limitation et d'opposition conformément à la réglementation sur la protection des données à caractère personnel.</p>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="acceptRGPD_contact" name="acceptRGPD_contact" />
                        <label class="custom-control-label" for="acceptRGPD_contact"> Je reconnais avoir pris connaissance de ces droits.</label>
                    </div>
                </div>
                <div class="col-6">
                    <!-- recaptcha
                    <p>reCaptcha</p>
                </div>
            </div>
        <button class="btn rounded-sm border-0 mb-3" type="submit" value="Envoyer"><i class="far fa-paper-plane"></i> Envoyer</button>
    </div>
</form>


-->