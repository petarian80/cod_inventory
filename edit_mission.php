<?php
  $page_title = 'Edit Mission';
  require_once('includes/load.php');
 
  
?>
<?php
  //Display all catgories.
  $mission = find_by_id('mission',(int)$_GET['id']);
  if(!$mission){
    $session->msg("d","Missing Mission id.");
    redirect('mission.php');
  }
?>

<?php
if(isset($_POST['edit_mission'])){
  $req_field = array('mission-name');
  validate_fields($req_field);
  $mission_name = remove_junk($db->escape($_POST['mission-name']));
  if(empty($errors)){
        $sql = "UPDATE mission SET name='{$mission_name}'";
       $sql .= " WHERE id='{$mission['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated Mission");
       redirect('mission.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('mission.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('mission.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($mission['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_mission.php?id=<?php echo (int)$mission['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="mission-name" value="<?php echo remove_junk(ucfirst($mission['name']));?>">
           </div>
           <button type="submit" name="edit_mission" class="btn btn-primary">Update Mission</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
