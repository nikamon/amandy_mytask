<?php

  $words = array("red", "blue", "green", "yellow", "lime", "magenta", "black", "gold", "gray", "tomato");

?>

<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Задание 2</title>
  <style media="screen">
    body{
      background-color: lightgray;
    }
    span{
      font-size:30px;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <?php

    for ($i=1; $i < 26 ; $i++) {
      $current = $words[array_rand($words,1)];
      $curr_color = $current;
      while($current == $curr_color){
        //Если текущее слово совпадет с выбранным цветом
        $curr_color = $words[array_rand($words,1)];
      }

      echo '<b><span style="color:'.$curr_color.'">'.$current.'</span></b> ';
      if($i % 5 == 0){
        //Каждые 5 слов перенос на новую строку
        echo "<br>";
      }
    }

    ?>
</body>
</html>
