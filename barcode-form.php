<?php
  $page_title = 'Generate Barcode';
  require_once('includes/load.php');
 
?>

<?php
 if(isset($_POST['bar_code'])){
 }

?>


<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Generate Barcode</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="bar_code.php" class="clearfix" id ="barcode" name="barcode" autocomplete="off">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
        <i class="fa fa-barcode" aria-hidden="true"></i>                  </span>
                  <input type="text" class="form-control" name="generate" placeholder="Bar Code Value" required  id = "bar-code">
              
              
               </div>
              </div>

              <button type="submit" name="submit" class="btn btn-danger">Generate</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
