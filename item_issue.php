<?php
  $page_title = 'Product issued';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 
  $all_categories = find_all('categories');
  $all_units = find_all('units');
?>
<?php
 if(isset($_POST['issue_item'])){
  $req_fields = array('part_no','item_name','iv_no','unit_id','rate','item_demanded','item_issued','to_fol','unit','issued_by', 'total' );
   validate_fields($req_fields);
   if(empty($errors)){
     $i_number  = remove_junk($db->escape($_POST['part_no']));
     $i_name   = remove_junk($db->escape($_POST['item_name']));
     $i_v   = remove_junk($db->escape($_POST['iv_no']));
     $i_unit   = remove_junk($db->escape($_POST['unit_id'])); 
     $i_rate   = remove_junk($db->escape($_POST['rate']));  
     $i_demand   = remove_junk($db->escape($_POST['item_demanded']));
     $i_ssue   = remove_junk($db->escape($_POST['item_issued']));
     $i_fol   = remove_junk($db->escape($_POST['to_fol']));
     $i_ut   = remove_junk($db->escape($_POST['unit']));
     $i_by   = remove_junk($db->escape($_POST['issued_by']));
     $i_total   = remove_junk($db->escape($_POST['total']));

     $date    = make_date();
     $query  = "INSERT INTO issue (";
     $query .="part_no, item_name, iv_no, unit_id, rate, item_demanded, item_issued, to_fol, unit, issued_by,date,total";
     $query .=") VALUES (";
     $query .=" '{$i_number}', '{$i_name}','{$i_v}', '{$i_unit}', '{$i_rate}','{$i_demand}','{$i_ssue}','{$i_fol}','{$i_ut}','{$i_by}', '{$date}' ,'{$i_total}' ";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Product issued ");
       redirect('item_issue.php', false);
     } else {
       $session->msg('d',' Sorry failed to issue!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('item_issue.php',false);
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
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>ISSUE ITEM </span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="item_issue.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  
                  <input type="text" class="form-control" name="part_no" placeholder="Part Number">
               </div>
              </div>

<div class="form-group">
                <div class="input-group">
                  
                  <input type="text" class="form-control" name="item_name" placeholder="Item Name">
               </div>
              </div>

<div class="form-group">
                <div class="input-group">
                  
                  <input type="text" class="form-control" name="iv_no" placeholder="IV Number">
               </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="unit_id">
                      <option value="">Select Producd unit</option>
                    <?php  foreach ($all_units as $unit): ?>
                      <option value="<?php echo (int)$unit['id'] ?>">
                        <?php echo $unit['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
             
                  
              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="rate" placeholder="Rate">
                  </div>
                 </div>
                 </div>
                 </div>
     <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="item_demanded" placeholder="Item Demanded">
                  </div>
                 </div>
                 </div>
                 </div>

                 <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="item_issued" placeholder="Item Issued">
                  </div>
                 </div>
                 </div>
                 </div>

                  <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                    
                     <input type="number" class="form-control" name="to_fol" placeholder="To FOL">
                  </div>
                 </div>
                 </div>
                 </div>

 <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="unit" placeholder="Unit">
                  </div>
                 </div>
                 </div>
                 </div>
                  
              
 <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="issued_by" placeholder="Issued By">
                  </div>
                 </div>
                 </div>
                 </div>
              
  <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="total" placeholder="TotaL Amount">
                  </div>
                 </div>
                 </div>
                 </div>
              <button type="submit" name="issue_item" class="btn btn-danger">Issue Item</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
