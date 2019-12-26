<?php

  require "tasks_data/4/simple_html_dom.php";

  function parsePage($link, $team_name)
  {

    $html = file_get_html($link);
    $some_number = 0;
    $is_found = false;
    foreach($html->find('.colored.big tr') as $tr_element) //Получили строки из таблицы команд года.
          {
            if($some_number != 0){
               //Получаем место команды в сезоне года
                $td_info = $tr_element->find('td',1);
                if(strpos($td_info->plaintext, $team_name) !== false){
                  echo $tr_element->find('td', 0)->plaintext;
                  $is_found = true;
                  $html->clear;
                  unset($html);
                  break;


              }
            }
            $some_number = 1;
          }
          return $is_found;
  }
?>

<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Team</title>
</head>
<body>
  <form class="" action="fours_task.php" method="post">
    <input type="text" name="team_name" value="" placeholder="Название команды: ">
    <input type="submit" name="" value="Получить">
  </form>


<?php


  $team_name = "";
  //Если получили POST с названием команды
  if(isset($_POST["team_name"])){
    $team_name = $_POST["team_name"];
    unset($_POST["team_name"]);
    echo $team_name."<br />";
    $html = file_get_html("http://terrikon.com/football/italy/championship/table");

    foreach ($html->find('.news',0)->find("dl dd a") as $link) {
      echo $link->plaintext.": место - ";
      if (!parsePage("http://terrikon.com".$link->href, $team_name)){
        echo "Не найдено<br>";
      }else{
        echo "<br>";
      }

    }

    $html->clear;
    unset($html);


    } else {
    //

  }


?>
</body>
</html>
