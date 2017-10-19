<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');

   
?>
<?php
  $product = join_product_table();
$all_categories = find_all('categories');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('part_no','item_name','unit_id','quantity', 'rate','categorie_id' );
    validate_fields($req_fields);

   if(empty($errors)){
       $part_no  = remove_junk($db->escape($_POST['part_no']));
       $item_name   = remove_junk($db->escape($_POST['item_name']));
       $unit_id   = remove_junk($db->escape($_POST['unit_id']));
       $quantity   = (int)$_POST['quantity'];
       $rate   = (int)$_POST['rate'];
       $categorie_id   = remove_junk($db->escape($_POST['categorie_id']));

       $query   = "UPDATE products SET";
       $query  .=" part_no ='{$part_no}', item_name ='{$item_name}',";
       $query  .=" unit_id ='{$unit_id}', quantity ='{$quantity}', categorie_id ='{$categorie_id}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
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
           <span>Editing :  <?php echo remove_junk(ucfirst($product['item_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'];?>">
<strong> PART NUMBER </strong>
          <div class="form-group"> 
               <input type="text" class="form-control" name="part-no" value="<?php echo remove_junk(ucfirst($product['part_no']));?>">
           </div>
<strong> ITEM NAME </strong>
           <div class="form-group">
               <input type="text" class="form-control" name="item-name" value="<?php echo remove_junk(ucfirst($product['item_name']));?>">
           </div>
<strong> UNIT </strong>
            <div class="form-group">
               <input type="text" class="form-control" name="unit-id" value="<?php echo remove_junk(ucfirst($product['unit_id']));?>">
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
               <input type="text" class="form-control" name="categorie" value="<?php echo remove_junk(ucfirst($product['categorie_id']));?>">
           </div>

           <button type="submit" name="edit_unit" class="btn btn-primary">Update Product</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
