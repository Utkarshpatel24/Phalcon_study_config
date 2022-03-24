<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class LoginController extends Controller
{
    public function indexAction()
    {
        //return '<h1>Hello!!!</h1>';
        // echo $this->cookies->has('remeber-me');
        // die();
        // print_r($this->cookies->get('remember-me')->getValue());
        // die();
        if ($this->cookies->has('remember-me')) {
            $data = $this->cookies->get('remember-me')->getValue();
            $data = json_decode($data);
            // print_r($data);
            // die();
             $this->response->redirect('/dashboard');
        }
    }

    public function checkAction()
    {
        $postdata = $this->request->getPost();
        $user = Users::find(
            [
                'conditions' => 'email = ?1 AND password =?2 ',
                'bind'       => [
                    1 => $postdata['email'],
                    2 => $postdata['password']
                ]
            ]
        );
        // print_r($postdata);
        // echo count($user);

        if (count($user) != 0) {

            $this->session->login = $postdata;
            //  print_r($_SESSION);
            //  
            //  print_r($this->session->get('login'));
            // die();

            if (count($postdata) == 3) {
                $cookie = $this->cookies;
                $cookie->set(
                    'remember-me',
                    json_encode(
                        [
                            'email' => $postdata['email'],
                            'password' => $postdata['password']
                        ]
                    ),
                    time() + 3600
                );
                // $this->cookies->send();
                $response = new Response();
               // $cookies  = new Cookies();

                $response->setCookies($cookie);
                $response->send();
                // print_r($this->cookies->get('remember-me')->getValue());
                // die();
            }
            $this->response->redirect('/dashboard');
        } else {
            $response = new Response(
                "Sorry, the page doesn't exist",
                404, 
                'Not Found'
            );
            
            $response->send();
            //echo "<h1>Not registered or approved</h1>";
        }


    }


    public function logoutAction()
    {
        $this->session->destroy();
        $this->cookies->get('remember-me')->delete();
        $this->response->send();
        // print_r($this->cookies->get('remember-me')->getValue());
        // die();
        $this->response->redirect('/login');
    }

    
}