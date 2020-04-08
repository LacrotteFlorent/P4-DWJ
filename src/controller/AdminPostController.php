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
        if(!$this->denyAccessUnlessGranted("admin")){
            FlashBag::getInstance()->add("red", "Vous n'avez pas les droits pour acceder à cette page.");
            return $this->redirection('/host');
        };

        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");
        return $this->render("adminPost.html.twig", [
            'billet'        => $billet,
            'image'         => $imageBillet,
        ]);
    }

    /**
    * @return Response
    */
    public function showVirgin()
    {   
        if(!$this->denyAccessUnlessGranted("admin")){
            FlashBag::getInstance()->add("red", "Vous n'avez pas les droits pour acceder à cette page.");
            return $this->redirection('/host');
        };

        return $this->render("adminPost.html.twig");
    }

    /**
    * @return RedirectionResponse
    */
    public function update($id)
    {   
        if(!$this->denyAccessUnlessGranted("admin")){
            FlashBag::getInstance()->add("red", "Vous n'avez pas les droits pour acceder à cette page.");
            return $this->redirection('/host');
        };

        if($this->request->getRequestMethod() === 'POST'){
            if($billetModel = $this->testDatas()){
                $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);

                if(!empty($_FILES["name"])){
                    $imageModel = (new ImageModel)->hydrateForSql([
                        "name"      => $_FILES["imageToUpload"]['name'],
                        "alt"       => $_POST["alt"]
                    ]);
                    $name = basename($_FILES["imageToUpload"]["name"]);
                    if(is_file("public/img/" . $name)){
                        unlink("public/img/" . $name);
                        }
                    move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], "public/img/" . $name);
                    
                    $this->getDatabase()->getManager('\Project\Model\ImageModel')->update($imageModel, ['id'=>$billet->getImageId()]);
                }

                $billetModel->hydrateForSql(['image_id'=> $billet->getImageId()]);
                $this->getDatabase()->getManager('\Project\Model\BilletModel')->update($billetModel, ["id"=>$id]);
                FlashBag::getInstance()->add("violet", "Votre article à été mis à jour !");
                return $this->redirection('/adminDashboard');
            }
            else{
                return $this->redirection('/adminPost/' . $id);
            }
        }
        return $this->redirection('/adminPost/' . $id);
    }

    /**
    * @return RedirectionResponse
    */
    public function create()
    {   
        if(!$this->denyAccessUnlessGranted("admin")){
            FlashBag::getInstance()->add("red", "Vous n'avez pas les droits pour acceder à cette page.");
            return $this->redirection('/host');
        };

        if($this->request->getRequestMethod() === 'POST'){
            if($billetModel = $this->testDatas()){
                $imageModel = (new ImageModel)->hydrateForSql([
                    "name"      => $_FILES["imageToUpload"]['name'],
                    "alt"       => $_POST["alt"]
                ]);

                $name = basename($_FILES["imageToUpload"]["name"]);
                if(is_file("public/img/" . $name)){
                    unlink("public/img/" . $name);
                    }
                move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], "public/img/" . $name);
                
                $this->getDatabase()->getManager('\Project\Model\ImageModel')->insertByModel($imageModel);
                $billetModel->hydrateForSql(['image_id'=>$this->getDatabase()->getManager('\Project\Model\ImageModel')->lastInsertID()]);
                $this->getDatabase()->getManager('\Project\Model\BilletModel')->insertByModel($billetModel);
                FlashBag::getInstance()->add("blue", "Votre article à été crée !");
                return $this->redirection('/adminDashboard');
            }
            else{
                return $this->redirection('/adminPost/0');
            }
        }
        return $this->redirection('/adminPost/0');
    }

    /**
    * @return RedirectionResponse
    */
    public function delete($id)
    {   
        if(!$this->denyAccessUnlessGranted("admin")){
            FlashBag::getInstance()->add("red", "Vous n'avez pas les droits pour acceder à cette page.");
            return $this->redirection('/host');
        };
        
        if($this->request->getRequestMethod() === 'POST'){
            $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
            $image = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId());
            $this->getDatabase()->getManager('\Project\Model\CommentModel')->delete(['post_id' => $id]);
            $this->getDatabase()->getManager('\Project\Model\BilletModel')->delete(['id' => $id]);
            $this->getDatabase()->getManager('\Project\Model\ImageModel')->delete(['id' => $billet->getImageId()]);

            if(is_file("public/img/" . $image->getName())){
                unlink("public/img/" . $image->getName());
            }

            FlashBag::getInstance()->add("orange", "Votre article à été suprrimé !");
            return $this->redirection('/adminDashboard');
        }
        return $this->redirection('/adminPost/' . $id);
    }

    /**
     * @internal Hydrates and tests POST data
     * @return bool|BilletModel
     */
    private function testDatas()
    {
        $billetModel = (new BilletModel())->hydrateForSql([
            "title"         => $_POST["title"],
            "content"       => $_POST["content"],
            "created_at"    => date($_ENV["DATE_FORMAT"]),
            "posted_at"     => !empty($_POST["datePost"]) ? ($_POST["datePost"] . " " . $_POST["timePost"] . ":00") : date($_ENV["DATE_FORMAT"]),
            "draft"         => $_POST["submit"] === "draft" ? 1 : 0,
            "like_count"    => 0,
            "view_count"    => 0,
        ]);
        if((new Validator)->assertion($billetModel, [
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
            ]], true)){

            return $billetModel;
        }
        return false;
    }

}