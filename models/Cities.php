<?php


namespace app\models;

use app\core\DbModel;
use app\core\Model;

class Cities extends DbModel
{
    public int $cid =0;
    public string $cname='';

    public function tableName(): string
    {
        return 'cities';
    }

    public static function replaceCidsWithNames(array $result)
    {
        $cities = Cities::getCities();
        foreach ($result as $key => $value) {
            foreach ($cities as $city => $v) {
                if ($city == $result[$key]['cid']) {
                    $result[$key]['cid'] = $v;
                }
            }
        }
        return $result;
    }

    public static function replaceCidWithNameSingle(array $result)
    {
        $cities = self::getCities();
        foreach ($cities as $city => $v) {
            if ($city == $result['cid']) {
                $result['cid'] = $v;
            }
        }
        return $result;
    }

    public static function getCities(){
        $statement = \app\core\Application::$app->db->prepare("SELECT * FROM cities GROUP BY cid");
        $statement->execute();
        $cities = [];
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $value) {
            $cities[$value['cid']] = $value['cname'];
        }
        return $cities;
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
            'cname' => [self::RULE_REQUIRED, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            //'cid' => [self::RULE_REQUIRED],
        ];
    }
    public function attributes(): array
    {
        return ['cname', 'cid'];
    }
}