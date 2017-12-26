<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
 
  
  $all_categories = find_all('categories');
   $all_units = find_all('units');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('part_no','item_name','unit_id','quantity','rate','categorie_id');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_no  = remove_junk($db->escape($_POST['part_no']));
     $p_name  = remove_junk($db->escape($_POST['item_name']));
     $p_unit   = remove_junk($db->escape($_POST['unit_id']));
     $p_qty   = remove_junk($db->escape($_POST['quantity']));
     $p_rate   = remove_junk($db->escape($_POST['rate']));     
     $p_cat  = remove_junk($db->escape($_POST['categorie_id']));
    
     
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .="part_no, item_name,rate,unit_id, quantity, categorie_id,date";
     $query .=") VALUES (";
     $query .=" '{$p_no}','{$p_name}','{$p_rate}','{$p_unit}','{$p_qty}','{$p_cat}','{$date}'";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
            
            <span>ADD NEW PRODUCT</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php"  autocomplete ="off" class="clearfix">
              <div class="form-group">
                  
                  <input type="text" class="form-control" name="part_no" placeholder="Part Number">
              </div>

              <div class="form-group">
                 
                  <input type="text" class="form-control" name="item_name" placeholder="Item Name">
              </div>

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
                     
                     <input type="number" class="form-control" name="rate" placeholder="Product Rate">
                  </div>
                 </div>
                 </div>
                 </div>
                 
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="categorie_id">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
              
              <button type="submit" name="add_product" class="btn btn-danger">Add product</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
