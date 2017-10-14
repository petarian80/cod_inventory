<?php
  require_once('includes/load.php');
  
  
?>
<?php
  $army_unit = find_by_id('army_units',(int)$_GET['id']);
  if(!$army_unit){
    $session->msg("d","Missing unit id.");
    redirect('unit.php');
  }
?>
<?php
  $delete_id = delete_by_id('army_units',(int)$army_unit['id']);
  if($delete_id){
      $session->msg("s","Unit deleted.");
      redirect('unit.php');
  } else {
      $session->msg("d","Unit deletion failed.");
      redirect('unit.php');
  }
?>
