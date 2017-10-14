<?php
  $page_title = 'All UNITS';
  require_once('includes/load.php');
 
 
  
  $all_unit = find_all('army_units')
?>
<?php
 if(isset($_POST['add_unit'])){
   $req_field = array('unit-name','unit-location','unit-strength');
   
   validate_fields($req_field);
   $unit_name = remove_junk($db->escape($_POST['unit-name']));
   $unit_location = remove_junk($db->escape($_POST['unit-location']));
   $unit_strength = remove_junk($db->escape($_POST['unit-strength']));

   if(empty($errors)){
      $sql  = "INSERT INTO army_units (unit_name,location,total_strength)";
      $sql .= " VALUES ('{$unit_name}','{$unit_location}','{$unit_strength}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Unit");
        redirect('unit.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Unit</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="unit.php">
            <div class="form-group">
                <input type="text" class="form-control" name="unit-name" placeholder="Unit Name">
            </div>
             <div class="form-group">
                <input type="text" class="form-control" name="unit-location" placeholder="Unit Location">
            </div>
             <div class="form-group">
                <input type="number" class="form-control" name="unit-strength" placeholder="Unit Strength">
            </div>
            <button type="submit" name="add_unit" class="btn btn-primary">Add Unit</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Units</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center"> Unit</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">strength</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_unit as $unit):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($unit['unit_name'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($unit['location'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($unit['total_strength'])); ?></td>

                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_unit.php?id=<?php echo (int)$unit['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_unit.php?id=<?php echo (int)$unit['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
