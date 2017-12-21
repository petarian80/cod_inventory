<?php
  $page_title = 'Generate Issue Report';
  require_once('includes/load.php');
 
 
  
  
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Issue Product Report </span>
         </strong>
        </div>
          <div class="panel-heading">
          <strong> 
  <span> Generate Issue Report By </span></strong>
    <div>
    <select class="select" onchange="javascript:location.href = this.value;" name="select">
            <option selected disabled> Select Type </option>    
            <option value="product_name.php" > Product Name </option>
            <option value ="part_no.php"> Part Number </option>
            <option value = "invoice.php"> Invoice Number </option>

                   </strong>
                      </select>    
                  </div>

   <?php include_once('layouts/footer.php'); ?>
