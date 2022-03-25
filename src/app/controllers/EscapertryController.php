<?php

use Phalcon\Mvc\Controller;

// use Phalcon\Escaper;
use Phalcon\Escaper\Exception;


class EscapertryController extends Controller
{
    public function indexAction()
    {
        $postdata = $this->request->getPost();
        if (count($postdata) != 0) {
            // print_r($postdata);
             //$escaper = new Escaper();
            $this->view->message =  $this->escaper->escapeHtml($postdata['content']);
            // $this->view->message = $postdata['content'];

            
        }
        
       
    }
}