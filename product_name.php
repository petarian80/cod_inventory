<?php
   $page_title = ' Issue Product Report';
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
   <span>Issue Product Report  By Name </span>
   </strong>
</div>
<div class="panel-body">
   <form method="post" id="product-name-search" autocomplete="off" action="issue_product_name.php"  >
      <div class="form-group">
         <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Product Name" onkeyup="listByname_report(this)">
         <div id="result" style="position:absolute" class="list-group"></div>
      </div>
      <button type="submit" name="submit"class="btn btn-danger">Generate Report</button>
   </form>

   


</div>
<div id="format-table"></div>

<?php include_once('layouts/footer.php'); ?>