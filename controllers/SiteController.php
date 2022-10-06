<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Cities;
use app\models\Villager;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'result' => Villager::getVillagerList(),
            'name' => "ABOBUS"
        ];

        return $this->render('home', $params);
    }


    public function contact()
    {
        return $this->render('contact');
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'Handling submitted data';
    }
}