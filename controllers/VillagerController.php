<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Model;
use app\core\Request;
use app\models\Cities;
use app\models\User;
use app\models\Villager;

class VillagerController extends Controller
{
    public function edit(Request $request)
    {
        $villager = new Villager();
        if ($request->isPost()){
            $villager->loadData($request->getBody());
            //var_dump($villager);
            if ($villager->validate() && $villager->update()){
                return 'Success';
            }
        }
        if ($request->isGet()){
            $id = $request->getBody()['id'];

            if ($id <= 0){
                return $this->render('404');
            }

            $cities = Cities::getCities();
            $villager = Villager::getVillagerById($id);
            return $this->render('edit',[
                'model' => $villager,
                'cities' => $cities
            ]);
        }
    }

    public function delete(Request $request)
    {
        $villager = new Villager();
        if ($request->isPost()){
            $villager->loadData($request->getBody());
            if ($villager->delete()){
                echo json_encode([
                    'result' => "Successful deleted"
                ]);
                exit;

            }
        }
    }

    public function create(Request $request)
    {
        $villager = new Villager();
        $cities = Cities::getCities();
        if ($request->isPost()){
            $villager->loadData($request->getBody());
            if ($villager->validate() && $villager->save()) {
                echo json_encode([
                    'result' => 'Added successful'
                ]);
                exit;
            }
            else{
                echo json_encode([
                    'result' => 'Error',
                    'errors' => $villager->getErrors()
                ]);
                exit;
            }
            //var_dump($villager);
        }
        //if ($villager->validate() && $villager->save()){
        //    return 'Success';
        //}
        return $this->render('create',[
            'model' => $villager,
            'cities' => $cities
        ]);
    }

    public function add(Request $request)
    {
        $villager = new Villager();
        $cities = Cities::getCities();
        if ($request->isPost()){
            $villager->loadData($request->getBody());
            if ($villager->validate() && $villager->save()){
                echo json_encode([
                    'result' => 'Added successful'
                ]);
                exit;
            }
        }
    }

    public function editRow(Request $request){
        if ($request->isPost()){
            $id = $request->getBody()['id'];
            $villager = Villager::getVillagerById($id);
            $params = [
                'data' => get_object_vars($villager),
            ];
            return $this->renderAjax('row-input-ajax', $params);
        }else{
            return $this->render('404');
        }
    }

    public function saveRow(Request $request){
        if ($request->isPost()){
            $villager = new Villager();
            $data = $request->getBody();
            $data['id']= (int)($data['id']);
            $data['age']= (int)($data['age']);
            $data['cid']=(int)($data['cid']);
            $villager->loadData($request->getBody());
            if ($villager->update()){
                $params = [
                    'data' => Cities::replaceCidWithNameSingle(get_object_vars($villager)),
                ];
                return $this->renderAjax('row-ajax', $params);
            }else{
                return 'Error';
            }
        }else{
            return $this->render('404');
        }

    }


}