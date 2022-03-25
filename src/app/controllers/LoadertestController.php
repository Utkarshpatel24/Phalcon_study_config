<?php

use Phalcon\Mvc\Controller;


class LoadertestController extends Controller
{
    public function indexAction()
    {
        $date = new \App\Components\LoaderHelper();
         echo $date->getDate();
        
        // return '<h1>Hello World!</h1>';
    }
}