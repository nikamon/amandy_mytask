<?php
  include './tasks_data/1/first_classes.php'; //Классы и интерфейсы

  //Первый класс
  $first = new First("First", 'A');
  $first->getClassname();
  $first->getLetter();

  //Второй класс
  echo "</br>";
  $second = new Second("Second", 'B');
  $second->getClassname();
  $second->getLetter();
?>
