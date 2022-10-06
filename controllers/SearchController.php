<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Model;
use app\core\Request;
use app\models\Cities;
use app\models\User;
use app\models\Villager;

class SearchController extends Controller
{

    public function search(Request $request)
    {

        if ($request->isGet()){
            $villager = Villager::villagersSearch($request->getBody());
//            echo '<pre style="color:red;">';
//            print_r($villager);
//            echo '</pre>';

            return $this->render('search', [
                'result' => $villager,
                'cities' =>Cities::getCities()
            ]);
        }
    }
}