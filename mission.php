<?php
  $page_title = 'All MISSION';
  require_once('includes/load.php');
 
 
  
  $all_mission = find_all('mission')
?>
<?php
 if(isset($_POST['add_mission'])){
   $req_field = array('mission-name');
   validate_fields($req_field);
   $mission_name = remove_junk($db->escape($_POST['mission-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO mission (mission)";
      $sql .= " VALUES ('{$mission_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Mission");
        redirect('mission.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Mission</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="mission.php">
            <div class="form-group">
                <input type="text" class="form-control" name="mission-name" placeholder="Mission Name">
            </div>
            <button type="submit" name="add_mission" class="btn btn-primary">Add Mission</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Missions</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center">Missions</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_mission as $mission):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($mission['mission'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_mission.php?id=<?php echo (int)$mission['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                  <i class="fa fa-pencil-square" aria-hidden="true"></i>                    </a>
                        </a>
                        <a href="delete_mission.php?id=<?php echo (int)$mission['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <i class="fa fa-trash" aria-hidden="true"></i>
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
