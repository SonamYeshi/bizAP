<?php
$cidno = $_GET['id'];

      $result = array("$cidno");
      $myJSON = json_encode($result);
      echo $myJSON;
?>
