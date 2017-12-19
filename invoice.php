<?php
  $page_title = ' Issue Product Report ';
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
            <span>Issue Product Report By Invoice Number </span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post"  autocomplete="off" action="invoice_report_process.php" >
            <div class="form-group">
                <input type="text" class="form-control" id="iv_no" name="iv_no" required placeholder="Invoice Number">
                <div id="result" style="position:absolute" class="list-group"></div>
           </div>
     
            <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
            
        </form>
        </div>
  <?php include_once('layouts/footer.php'); ?>
