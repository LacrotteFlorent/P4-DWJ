<?php

namespace Project\Controller;

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
            dump($_POST);
            dump($_FILES);
            if(((new Validator)->assertion(null, [
                'image'     => [
                    'value'     => $_FILES["imageToUpload"],
                    'assert'    => 'image',
                    'size'      => $_ENV["SIZE_IMG"],
                ],
                'alt'       => [
                    'value'     => $_POST["alt"],
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

                    $name = basename($params['value']["name"]);
                    move_uploaded_file($params['value']["tmp_name"], "public/img/" . $name);
                    
                    $this->getDatabase()->getManager('\Project\Model\ImageModel')->insertByModel($imageModel);
                    $billetModel->hydrateForSql(['image_id'=>$this->getDatabase()->getManager('\Project\Model\ImageModel')->lastInsertID()]);
                        dump($imageModel);
                        dump($billetModel);
                    $this->getDatabase()->getManager('\Project\Model\BilletModel')->insertByModel($billetModel);
                    FlashBag::getInstance()->add("blue", "Votre article à été actualisé!");
                    //return $this->redirection('/adminDashboard');
                }
                else{
                    //return $this->redirection('/adminPost/0); // adminPost/ l'id en cours
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