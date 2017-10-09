<?php
  require_once('includes/load.php');
  
  
?>
<?php
  $mission = find_by_id('mission',(int)$_GET['id']);
  if(!$mission){
    $session->msg("d","Missing Mission id.");
    redirect('mission.php');
  }
?>
<?php
  $delete_id = delete_by_id('mission',(int)$mission['id']);
  if($delete_id){
      $session->msg("s","Mission deleted.");
      redirect('mission.php');
  } else {
      $session->msg("d","Mission deletion failed.");
      redirect('mission.php');
  }
?>
