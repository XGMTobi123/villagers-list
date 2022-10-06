<?php


namespace app\core;


abstract class DbModel extends Model
{
    abstract public function tableName():string ;
    abstract public function attributes():array;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        //var_dump($params);
        //var_dump($attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',',$attributes).")
            VALUES(".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute",$this->{$attribute});
        }
        return $statement->execute();
//        echo '<pre>';
//        var_dump($statement,$params,$attributes);
//        echo '</pre>';
    }
    public function update()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $s = "UPDATE $tableName SET ";
        foreach ($params as $param=>$value) {
//            echo "<pre>";
//            var_dump($param);
//            var_dump($attributes);
//            echo "</pre>";
            $s = $s.$attributes[$param]."=".($value).",";
        }
        $s = substr($s,0,-1);
        $s = $s."
        WHERE id =".$params[0];
        //echo $s;
        $statement = self::prepare($s);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute",$this->{$attribute});
        }
        return $statement->execute();
    }

    public function delete()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $s = "DELETE from $tableName WHERE id =".$this->{$attributes[0]};
        //var_dump($s);
        //echo $s;
        $statement = self::prepare($s);
        if ($this->{$attributes[0]}!=0){
        return $statement->execute();
        }
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}