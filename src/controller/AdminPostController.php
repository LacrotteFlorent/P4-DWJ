<?php

namespace Project\Controller;

use Framework\Form\ExtendAssertion;
use Framework\Form\Validator;
use Framework\Controller;
use Framework\FlashBag;
use Project\Model\BilletModel;
use Project\Model\ImageModel;

class AdminPostController extends Controller
{
   /**
    * @return Response
    */
    public function show($id)
    {   
        if($this->request->getRequestMethod() === 'POST'){
            //dd($_POST);
            if(((new Validator)->assertion(null, [
                'image'     => [
                    'value'     => $_FILES["imageToUpload"],
                    'assert'    => 'image',
                    'size'      => $_ENV["SIZE_IMG"],
                ],
                'alt'       => [
                    'value'     => $_POST["alt"],
                    'assert'    => 'string'
                ],
                'submit'    => [
                    'value'     => $_POST["submit"],
                    'assert'    => 'string'
                ]
            ]))){
                $billetModel = (new BilletModel())->hydrateForSql([
                    "title"         => $_POST["title"],
                    "content"       => $_POST["content"],
                    "created_at"    => date($_ENV["DATE_FORMAT"]),
                    "posted_at"     => !empty($_POST["datePost"]) ? $_POST["datePost"] : date($_ENV["DATE_FORMAT"]),
                    "draft"         => isset($_POST["draft"]) ? 1 : 0,
                    "like_count"    => 0,
                    "view_count"    => 0,
                ]);
                if((new Validator)->assertion($billetModel)){
                    $imageModel = (new ImageModel)->hydrateForSql([
                        "name"      => $_FILES["imageToUpload"]['name'],
                        "alt"       => $_POST["alt"]
                    ]);

                    $name = basename($_FILES["imageToUpload"]["name"]);
                    if(is_file("public/img/" . $name)){
                        unlink("public/img/" . $name);
                        }
                    move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], "public/img/" . $name);
                    
                    if($id != "0"){
                        $this->getDatabase()->getManager('\Project\Model\ImageModel')->update($imageModel, ['id'=>3]);
                        $billetModel->hydrateForSql(['image_id'=>3]);
                        $this->getDatabase()->getManager('\Project\Model\BilletModel')->update($billetModel, ["id"=>$id]);
                        FlashBag::getInstance()->add("violet", "Votre article à été mis à jour !");
                        return $this->redirection('/adminDashboard');
                    }
                    if($id === "0"){
                        $this->getDatabase()->getManager('\Project\Model\ImageModel')->insertByModel($imageModel);
                        $billetModel->hydrateForSql(['image_id'=>$this->getDatabase()->getManager('\Project\Model\ImageModel')->lastInsertID()]);
                        $this->getDatabase()->getManager('\Project\Model\BilletModel')->insertByModel($billetModel);
                        FlashBag::getInstance()->add("blue", "Votre article à été créer!");
                        return $this->redirection('/adminDashboard');
                    }
                }
                else{
                    if($id != "0"){
                        return $this->redirection('/adminPost/' . $id);
                    }
                    if($id === "0"){
                        return $this->redirection('/adminPost/0');
                    }
                }
            }
        }

        // Si l'id est = 0 alors c'est un nouveau post
        if($id === "0"){
            return $this->render("adminPost.html.twig");
        }

        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");

        return $this->render("adminPost.html.twig", [
            'billet'        => $billet,
            'image'         => $imageBillet,
        ]);
    }

}