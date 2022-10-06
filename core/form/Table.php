<?php


namespace app\core\form;


class Table
{
    public static function createTable(array $sContent, array $columnContent)
    {
        echo '<div class="d-table"><div class="d-tr">';
        foreach ($sContent as $s=>$value){
            echo "<div class = 'd-th'>$value</div>";
        }
        echo '</div>';

        foreach ($columnContent as $c=>$value){
            //var_dump($value);
            echo "<div class='d-tr'>";
            foreach ($sContent as $s=>$item) {
                //var_dump($value[$s]);
                echo "<div class = 'd-td'>$value[$s]</div>";
            }
            echo "</div>";
        }
        echo "</div>";
        return new Table();
    }
}