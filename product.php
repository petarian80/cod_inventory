<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
 
  
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
             

       <?php echo display_msg($msg); ?>
    
     
    <div class="col-md-12">
    
      

<div class="panel-body table-responsive"  >
     <form action="search.php" method="post" id="search" >
   <div class="pull-right">
<i class="fa fa-search" aria-hidden="true"></i>
<input type="text" name="searchProduct"  placeholder="Search Product.." id="searchProduct" required  autocomplete="off" >
 <div id="result" style="position:absolute" class="list-group"></div>
<input type="submit" name="search" value="Search">
</div>
</form>
 </div>

        <strong>
       <h1 class="text-center"><u>PRODUCT DETAILS</u></h1>
       </strong>
         <a href="add_product.php" class="btn btn-info pull-right">Add New Product</a>
      </div>
    </div>
 </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">S.No</th>
                <th class="text-center" style="width: 15%;">Part Number</th>
                <th class="text-center">     Product Title </th>
                <th class="text-center" style="width: 10%;"> Categorie </th>
                <th class="text-center" style="width: 10%;"> Instock </th>
                <th class="text-center" style="width: 10%;"> Rate </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($product['part_no']); ?></td>
                <td class="text-center">                      <?php echo remove_junk($product['item_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['rate']); ?></td>                
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                  <i class="fa fa-pencil-square" aria-hidden="true"></i>                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                 <i class="fa fa-trash" aria-hidden="true"></i>                    </a>
                   </div>
                </td>
              </tr>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
     
</div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
