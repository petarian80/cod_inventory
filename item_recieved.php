<?php
  $page_title = 'Product Recieved';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 
  $all_categories = find_all('categories');
  $all_units = find_all('units');
?>
<?php
 if(isset($_POST['item_recieve'])){
   $req_fields = array('part_no','item_name','unit_id','quantity','alp_no','categorie_id','rate','po_no','drs_no','crv_no','firm','remarks' );
   validate_fields($req_fields);
   if(empty($errors)){
     $r_number  = remove_junk($db->escape($_POST['part_no']));
     $r_name   = remove_junk($db->escape($_POST['item_name']));
     $r_unit   = remove_junk($db->escape($_POST['unit_id']));
     $r_qty   = remove_junk($db->escape($_POST['quantity'])); 
     $r_alp   = remove_junk($db->escape($_POST['alp_no']));
     $r_cat   = remove_junk($db->escape($_POST['categorie_id']));
     $r_rate   = remove_junk($db->escape($_POST['rate']));
     $r_po   = remove_junk($db->escape($_POST['po_no']));
     $r_drs   = remove_junk($db->escape($_POST['drs_no']));
     $r_crv   = remove_junk($db->escape($_POST['crv_no']));
     $r_firm   = remove_junk($db->escape($_POST['firm']));
      $r_remarks   = remove_junk($db->escape($_POST['remarks']));
     $date    = make_date();
     $query  = "INSERT INTO recieved (";
     $query .="part_no, item_name,unit_id,quantity,alp_no,categorie_id,po_no,date,drs_no,crv_no,rate,firm,remarks";
     $query .=") VALUES (";
     $query .=" '{$r_number}', '{$r_name}','{$r_unit}', '{$r_qty}', '{$r_alp}','{$r_cat}','{$r_po}', '{$date}','{$r_drs}','{$r_crv}','{$r_rate}','{$r_firm}','{$r_remarks}'";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('item_recieved.php',false);
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
            <span>RECIEVE ITEM </span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="item_recieved.php" class="clearfix">
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
                     
                     <input type="number" class="form-control" name="quantity" placeholder="Product Quantity">
                  </div>
                 </div>
                 </div>
                 </div>
                 <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="alp_no" placeholder="ALP Number">
                  </div>
                 </div>
                 </div>
                 </div>
                 

                  <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="categorie_id">
                      <option value="">Select Producd Categorie</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>

                   <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="po_no" placeholder=" PO Number">
                  </div>
                 </div>
                 </div>
                 </div>

                  <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="drs_no" placeholder=" DRS Number">
                  </div>
                 </div>
                 </div>
                 </div>

                  <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="crv_no" placeholder=" CRV Number">
                  </div>
                 </div>
                 </div>
                 </div>
                
                 <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="number" class="form-control" name="rate" placeholder=" Rate">
                  </div>
                 </div>
                 </div>
                 </div>

               <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="text" class="form-control" name="firm" placeholder=" Firm">
                  </div>
                 </div>
                 </div>
                 </div>

                  <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     
                     <input type="text" class="form-control" name="remarks" placeholder=" Remarks">
                  </div>
                 </div>
                 </div>

               </div>
              
              

              
              <button type="submit" name="item_recieve" class="btn btn-danger">Recieve Item</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
