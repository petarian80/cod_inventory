<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
 
  
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         
         <h1>Database of UNMSD</h1> 

      </div>
    </div>
 </div>
 <form action="" method="post" >
   <div align = "right">

<input type="text" name="searchProduct" placeholder="Search Product.." onkeyup="findProduct(this)">
<input type="submit" name="search" value="Search ">
</div>
</form>
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
                <td>                      <?php echo remove_junk($product['item_name']); ?></td>
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
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
