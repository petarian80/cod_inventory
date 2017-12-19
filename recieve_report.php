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
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Recieve Product Report </span>
         </strong>
        </div>
          <div class="panel-heading">
          <strong>
            <ul>
  
  <span> Generate Recieve Report By </span>
    
    <ul>
      <li><a href="recieve_product_name.php">Product Name</a></li>
      <li><a href="recieve_part_no.php">Product Part Number</a></li>
      <li><a href="po.php">Purchase Order Number</a></li>
      <li><a href="recieve_date.php">Date Range</a></li>
         </strong>
        </div>
   <?php include_once('layouts/footer.php'); ?>
