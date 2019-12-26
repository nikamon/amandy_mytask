<?php

  $link = mysqli_connect("localhost", "root", "", "bank"); //Данные к вашей базе править тут!
  
  function task_a()
  {

    // а) написать запрос, который бы выводил полное имя и баланс человека на данный момент
    $link = $GLOBALS['link'];
    $query = "SELECT * FROM `persons`";
    $result = mysqli_query($link, $query);
    if($result){
      while($row = mysqli_fetch_assoc($result)){
        $query = "SELECT `name` FROM `cities` WHERE `id`='".$row['city_id']."'";
        $result_1 = mysqli_query($link, $query);
        $res = mysqli_fetch_assoc($result_1);

        $query = "SELECT `amount` FROM `transactions` WHERE `from_person_id` = '".$row['id']."'";
        $result_2 = mysqli_query($link, $query);
        $query = "SELECT `amount` FROM `transactions` WHERE `to_person_id` = '".$row['id']."'";
        $result_3 = mysqli_query($link, $query);

        $balance = 100.00;

        while($from = mysqli_fetch_assoc($result_2)["amount"]){
          $balance = $balance - $from;
        }
        while($from = mysqli_fetch_assoc($result_3)["amount"]){
          $balance = $balance + $from;
        }

        echo "<tr><td>".$row["id"]."</td><td>".$row["fullname"]."</td><td>".$balance."</td></tr>";
      }
    }
  }

  function task_b()
  {

    // б) написать запрос, который бы выводил город, представители которого участвовали в передаче денег наибольшее количество раз
    $link = mysqli_connect("localhost", "root", "", "bank");
    $query = "(SELECT `cities`.`name`, `persons`.`city_id`, `transactions`.`from_person_id` FROM `cities` AS `cities`, `persons` AS `persons`, `transactions` AS `transactions` WHERE `persons`.`id` = `transactions`.`from_person_id` AND `cities`.`id` = `persons`.`city_id` ORDER BY `persons`.`city_id`) UNION ALL (SELECT `cities`.`name`, `persons`.`city_id`, `transactions`.`to_person_id` FROM `cities` AS `cities`, `persons` AS `persons`, `transactions` AS `transactions` WHERE `persons`.`id` = `transactions`.`to_person_id` AND `cities`.`id` = `persons`.`city_id`) ORDER BY `city_id` DESC";
    $result = mysqli_query($GLOBALS['link'], $query);

    $res_2_1 = array(array());
    $val = 0;
    while($row = mysqli_fetch_assoc($result)){
      $res_2_1[$val] = $row["name"];
      $val++;
    }

     $res_2_1 = array_count_values($res_2_1);
     arsort($res_2_1);
     $res_2_2 = $res_2_1;
     $element = array_shift($res_2_1);
     echo "<br><span id='popular_city'>б)Чаще всего: ".array_search($element, $res_2_2)."</span>";
  }

  function task_c()
  {

    // в) написать запрос, отражающий все транзакции, где передача денег осуществлялась между представителями одного города
    $link = mysqli_connect("localhost", "root", "", "bank");
    $query = "(SELECT `transactions`.`transaction_id`,`persons`.`city_id`, `transactions`.`from_person_id` FROM `persons` AS `persons`, `transactions` AS `transactions`, `cities` AS `cities` WHERE `persons`.`id` = `transactions`.`from_person_id` AND `cities`.`id` = `persons`.`city_id`) UNION ALL (SELECT `transactions`.`transaction_id`,`persons`.`city_id`, `transactions`.`to_person_id` FROM `persons` AS `persons`, `transactions` AS `transactions`, `cities` AS `cities` WHERE `persons`.`id` = `transactions`.`to_person_id` AND `cities`.`id` = `persons`.`city_id`)";
    $result = mysqli_query($GLOBALS['link'], $query);
    $result_c_1 = array();
    $val = 0;
    while($row = mysqli_fetch_assoc($result)){
      $result_c_1[] = $row;
      $val++;
    }
    //var_dump($result_c_1);
    $from_transactions = array_slice($result_c_1, 0, count($result_c_1)/2);
    $to_transactions = array_slice($result_c_1, count($result_c_1)/2);
    echo "<span id='popular_city'>в)</span>";
    for ($i=0; $i < count($from_transactions); $i++) {

      if($from_transactions[$i]["city_id"] == $to_transactions[$i]["city_id"]){
        echo "<span id='duo_cities'>Transaction with ID: ".$from_transactions[$i]["transaction_id"]." from city with ID: ".$from_transactions[$i]["city_id"].";</span><br>";
      }
    }

    mysqli_close($link); //Закрываем соединение с базой. Мелочь, а приятно)
  }


?>

<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Задание №5</title>
  <style media="screen">
    td{
      background-color: white;
      padding:2px;
    }
    table{
      text-align: center;
      font-size: 20px;
      background-color: black;
    }
    thead tr td{
      padding:10px;
      font-size: 24px;
      background-color: blue;
      color:white;
    }
    #popular_city{
      display: block;

      font-size: 24px;
      margin-top: 40px;
      font-family: 'Century Gothic';
    }
    #duo_cities{
      display: block;

      font-size: 20px;
      font-family: 'Century Gothic';
    }
  </style>
</head>
<body>
  a)
  <table>
    <thead>
      <tr>
        <td>ID</td>
        <td>Имя</td>
        <td>Баланс</td>
      </tr>
    </thead>

  <?php

    task_a(); //Задание a


  ?>
  </table>

  <?php

    task_b();//Задание б
    task_c();//Задание в


  ?>

</body>
</html>


<!-- SELECT `cities`.`name`, `persons`.`city_id`, `transactions`.`from_person_id` FROM `cities` AS `cities`, `persons` AS `persons`, `transactions` AS `transactions` WHERE `persons`.`id` = `transactions`.`from_person_id` AND `cities`.`id` = `persons`.`city_id` -->
<!-- (SELECT `transactions`.`transaction_id`,`persons`.`city_id`, `transactions`.`from_person_id` FROM `persons` AS `persons`, `transactions` AS `transactions`, `cities` AS `cities` WHERE `persons`.`id` = `transactions`.`from_person_id` AND `cities`.`id` = `persons`.`city_id`) UNION (SELECT `transactions`.`transaction_id`,`persons`.`city_id`, `transactions`.`to_person_id` FROM `persons` AS `persons`, `transactions` AS `transactions`, `cities` AS `cities` WHERE `persons`.`id` = `transactions`.`to_person_id` AND `cities`.`id` = `persons`.`city_id`) -->
