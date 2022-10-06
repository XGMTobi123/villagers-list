<?php


namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;

class Villager extends DbModel
{
    public int $id = 0;
    public string $name = '';
    public int $age = 0;
    public int $cid = -1;

    public function tableName(): string
    {
        return 'villagers';
    }


    public static function getVillagerList()
    {
        $statement = \app\core\Application::$app->db->prepare("SELECT * FROM villagers GROUP BY id");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $result = Cities::replaceCidsWithNames($result);
        return $result;
    }

    public static function villagersSearch(array $params)
    {
        //TODO implode
        $s = "SELECT * FROM villagers WHERE ";
        foreach ($params as $key => $value) {
            if ($value != '0') {
                $s = $s . $key . " LIKE :" . $key . " AND ";
            } else {
                unset($params[$key]);
            }
        }
        $s = substr($s, 0, -5);
        //var_dump($params);
        //$s = "SELECT * FROM villagers WHERE " . implode(', ', array_keys($params)) . " LIKE " . implode(',', $params);
        //var_dump($s);
        $statement = Application::$app->db->prepare($s);
        foreach ($params as $param => $value) {
            $statement->bindValue(":$param", "%" . "$value" . "%");
        }
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $result = Cities::replaceCidsWithNames($result);
        return $result;
    }

    public static function getVillagerById($id)
    {
        //$statement = \app\core\Application::$app->db->prepare("SELECT v.*,c.cname FROM `villagers` AS v LEFT JOIN cities as c ON c.cid=v.cid WHERE id = :id");3
        $statement = \app\core\Application::$app->db->prepare("SELECT * FROM `villagers` WHERE id = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $villager = new Villager();
        $result = $statement->fetch(\PDO::FETCH_OBJ);
        foreach ($result as $attribute => $value) {
            $villager->$attribute = $value;
        }
        return $villager;
    }

    public function register()
    {
        $this->save();
    }

    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'age' => [self::RULE_REQUIRED, self::RULE_AGE],
            //'cid' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['id', 'name', 'age', 'cid'];
    }
}