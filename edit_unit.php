<?php
  $page_title = 'Edit Unit';
  require_once('includes/load.php');
 
  
?>
<?php
  //Display all units
  $unit_names = find_by_id('army_units',(int)$_GET['id']);
  if(!$unit_names){
    $session->msg("d","Missing unit id.");
    redirect('unit.php');
  }
?>

<?php
if(isset($_POST['edit_unit'])){
  $req_field = array('unit-name','unit-location','unit-strength');
  validate_fields($req_field);
  $unit_name = remove_junk($db->escape($_POST['unit-name']));
  $unit_location = remove_junk($db->escape($_POST['unit-location']));
  $unit_strength = remove_junk($db->escape($_POST['unit-strength']));

  if(empty($errors)){
        $sql = "UPDATE army_units SET unit_name='{$unit_name}',location='{$unit_location}',total_strength='{$unit_strength}'";
       $sql .= " WHERE id='{$unit_names['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated Unit");
       redirect('unit.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('unit.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('unit.php',false);
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
           <span>Editing <?php echo remove_junk(ucfirst($unit_names['unit_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_unit.php?id=<?php echo (int)$unit_names['id'];?>">
           <strong> Unit Name</strong>
           <div class="form-group">
               <input type="text" class="form-control" name="unit-name" value="<?php echo remove_junk(ucfirst($unit_names['unit_name']));?>">
           </div>
           <strong> Unit Location</strong>
            <div class="form-group">
               <input type="text" class="form-control" name="unit-location" value="<?php echo remove_junk(ucfirst($unit_names['location']));?>">
           </div>
           <strong> Unit Strength</strong>
            <div class="form-group">
               <input type="number" class="form-control" name="unit-strength" value="<?php echo remove_junk(ucfirst($unit_names['total_strength']));?>">
           </div>
           <button type="submit" name="edit_unit" class="btn btn-primary">Update Unit</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
