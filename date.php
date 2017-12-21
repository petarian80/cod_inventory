<?php
  $page_title = 'Issue Product Report ';
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
            <span>Issue Product Report By Date Range </span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post"  autocomplete="off" action="issue_report_process.php" >
             
             <div class="input-group">
                  <input type="text" class="datepicker form-control" name="start-date" placeholder="From">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  <input type="text" class="datepicker form-control" name="end-date" placeholder="To">
                </div>
               <div > 
            <button type="submit" name="submit"  class="btn btn-primary">Generate Report</button>
            </div>
        </form>
        </div>
  <?php include_once('layouts/footer.php'); ?>