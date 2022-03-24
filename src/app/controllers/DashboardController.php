<?php

use Phalcon\Mvc\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        if(count($this->session->get('login')) == 0)
        $this->response->redirect('/login');

        $config = $this->config;
        $this->view->appname = $config->app->appname;
        $this->view->appversion = $config->app->appversion;
        //return '<h1>Hello!!!</h1>';
    }
}