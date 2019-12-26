<?php
interface SimpleControl
{
  function getClassname();
  function getLetter();
}

class First implements SimpleControl
{
  private $className;
  private $letter;
  function __construct($type, $letter)
  {
    $this->className = $type;
    $this->letter = $letter;
  }
  function getClassname(){
    echo $this->className."\n";
  }
  function getLetter(){
    echo $this->letter."\n";
  }
}


class Second implements SimpleControl
{
  private $className;
  private $letter;
  function __construct($type, $letter)
  {
    $this->className = $type;
    $this->letter = $letter;
  }
  function getClassname(){
    echo $this->className."\n";
  }
  function getLetter(){
    echo $this->letter."\n";
  }
}

?>
