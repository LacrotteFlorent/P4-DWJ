<?php

namespace Project\Controller;

use Framework\Form\Validation\Validator;
use Framework\Controller;
use Framework\FlashBag;
use Project\Model\CommentModel;

class AdminCommentController extends Controller
{

    /**
    * @return RedirectionResponse
    */
    public function valid($id)
    {   
        if(!$this->denyAccessUnlessGranted("admin")){
            FlashBag::getInstance()->add("red", "Vous n'avez pas les droits pour acceder à cette page.");
            return $this->redirection('/host');
        };

        if($this->request->getRequestMethod() === 'POST'){
            $commentModel = $this->getDatabase()->getManager('\Project\Model\CommentModel')->find($id);
            $commentModel = $commentModel->hydrateForSql([
                "valid"     => 1,
                "report"    => 0
            ]);
            if((new Validator)->assertion($commentModel)){
                $this->getDatabase()->getManager('\Project\Model\CommentModel')->update($commentModel, ["id"=>$id]);
                (FlashBag::getInstance())->add("green", "Le commentaire à été validé !");
                return $this->redirection('/adminDashboard');
            }
        }
        return $this->redirection('/adminDashboard');
    }

    /**
    * @return RedirectionResponse
    */
    public function report($id)
    {   
        if($this->request->getRequestMethod() === 'POST'){
            $commentModel = $this->getDatabase()->getManager('\Project\Model\CommentModel')->find($id);
            $commentModel = $commentModel->hydrateForSql([
                "valid"     => 1,
                "report"    => 1,
            ]);
            if((new Validator)->assertion($commentModel)){
                $this->getDatabase()->getManager('\Project\Model\CommentModel')->update($commentModel, ["id"=>$id]);
                (FlashBag::getInstance())->add("orange", "Le commentaire à été signalé !");
                return $this->redirection('/billet/'. $this->request->getPost()["idBillet"]);
            }
        }
        return $this->redirection('/adminDashboard');
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
            $this->getDatabase()->getManager('\Project\Model\CommentModel')->delete(['id' => $id]);
            FlashBag::getInstance()->add("orange", "Le commentaire à été supprimé !");
            return $this->redirection('/adminDashboard');
        }
        return $this->redirection('/adminDashboard');
    }

}