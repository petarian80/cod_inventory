<?php
  $page_title = 'Generate Recieve Report';
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
<i class="fa fa-file-text" aria-hidden="true"></i>
            <span class="glyphicon glyphicon-th"></span>
            <span>Recieve Product Report </span>
         </strong>
        </div>
          <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
          <span> Generate Recieve Report By </span>
    
   <div>
            <span class="glyphicon glyphicon-th"></span>

        <select class="select" onchange="javascript:location.href = this.value;" name="select">
            <option selected disabled> Select Type </option>    
            <option value="recieve_product_name.php" > Product Name </option>
            <option value ="recieve_part_no.php"> Part Number </option>
            <option value = "po.php"> Purchase Order Number </option>
            <option value = "recieve_date.php"> Date Range </option>

                   </strong>
                      </select>    
                  </div>
      </div>
   <?php include_once('layouts/footer.php'); ?>
