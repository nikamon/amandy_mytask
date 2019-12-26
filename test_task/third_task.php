<?php

  $arr_inpr = explode(" ",$argv[1]); //Получаем входную строку и сразу разбиваем на массив
  echo "\n";

  $arr_final = array();

  foreach ($arr_inpr as $value) {
    if(is_numeric($value)){
      if((strpos($value, '.') == false) & (strpos($value,',') == false))
        $arr_final[] = $value;
    }
  }  //Формируем массив чисел по параметрам

  $arr_final = array_unique($arr_final, SORT_NUMERIC); //Убираем повторы в массиве
  asort($arr_final); //Сортируем массив по возрастанию



  foreach ($arr_final as $value) {
      echo $value." ";
  } //Выводим массив
?>
