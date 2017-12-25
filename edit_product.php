<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');

   
?>
<?php
  $products = join_product_table();
  $product = find_by_id('products',(int)$_GET['id']);
   $all_units = find_all('units');

$all_categories = find_all('categories');
// if(!$product){
//   $session->msg("d","Missing product id.");
//   redirect('product.php');
// }
// ?>
<?php

 if(isset($_POST['edit_product'])){
  
    $req_fields = array('part_no','item_name','unit_id','quantity', 'rate','categorie_id' );
    validate_fields($req_fields);
       $part_no  = remove_junk($db->escape($_POST['part_no']));
       $item_name   = remove_junk($db->escape($_POST['item_name']));
       $unit_id   = remove_junk($db->escape($_POST['unit_id']));
       $quantity   = (int)$_POST['quantity'];
       $rate   = (int)$_POST['rate'];
       $categorie_id   = remove_junk($db->escape($_POST['categorie_id']));
      
      
       $session->msg("d", $_POST['categorie_id']);
        if(empty($errors)){
       $query = "UPDATE products SET part_no ='{$part_no}', item_name ='{$item_name}',rate='{$rate}',unit_id ='{$unit_id}', quantity ='{$quantity}', categorie_id ='{$categorie_id}' WHERE id ='{$product['id']}'";
 
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product.php', false);
               } 

    else{
       $session->msg("d", "Sorry! Failed to Update");
       redirect('product.php?id='.$product['id'], false);
   }}
   else {
    $session->msg("d", $errors);
    redirect('product.php',false);
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
           
           <span>Editing :  <?php echo remove_junk(ucfirst($product['item_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" id="edit-product" action="edit_product.php?id=<?php echo (int)$product['id'];?>">
<strong> PART NUMBER </strong>
          <div class="form-group"> 
               <input type="text" class="form-control" name="part_no" value="<?php echo remove_junk(ucfirst($product['part_no']));?>">
           </div>
<strong> ITEM NAME </strong>
           <div class="form-group">
               <input type="text" class="form-control" name="item_name" value="<?php echo remove_junk(ucfirst($product['item_name']));?>">
           </div>
<strong> A/U UNIT </strong>
           <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="unit_id">
                      <option value="">Select Product Units</option>
                    <?php  foreach ($all_units as $unit): ?>
                      <option value="<?php echo (int)$unit['id'] ?>"
                         <?php if(((int)$unit['id']) == remove_junk(ucfirst($product['unit_id']))): ?> selected="selected"<?php endif; ?>
                      >
                        <?php echo $unit['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
           <strong> RATE </strong>
            <div class="form-group">
               <input type="number" class="form-control" name="rate" value="<?php echo remove_junk(ucfirst($product['rate']));?>">
           </div>
<strong> QUANTITY </strong>
    <div class="form-group">
               <input type="text" class="form-control" name="quantity" value="<?php echo remove_junk(ucfirst($product['quantity']));?>">
           </div>
<strong> CATEGORIE </strong>    
  
<div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="categorie_id">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>"
                         <?php if(((int)$cat['id']) == remove_junk(ucfirst($product['categorie_id']))): ?> selected="selected"<?php endif; ?>
                      >
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>

           <button type="submit" name="edit_product" class="btn btn-primary">Update Product</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
