<?php


namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\core\Request;
use app\models\User;
//use app\models\Villager;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            //var_dump($user);

            if ($user->validate() && $user->save()){
                return 'Success';
            }
            //var_dump($user->errors);
            return $this->render('register',[
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $user
        ]);
    }
}