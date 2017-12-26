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
          
            <span>Recieve Product Report </span>
         </strong>
        </div>
          <div class="panel-heading">
          <strong>
            
          <span> Generate Recieve Product Report By </span>
    </strong>
   <div>
         <form action="" id="recieve-report-select" autocomplete="off">
      <select class="select" onchange=" issueFormSelectType(this.value)" name="select">
         <option selected disabled value="0"> Select Type </option>
         <option value="1" > Product Name </option>
         <option value ="2"> Part Number </option>
         <option value = "3"> Purchase Order Number </option>
      </select>
      <div class="form-group">
           <input type="text" disabled class="form-control" id="item_name" name="item_name" onkeyup="recieveFormfetchData(this)"  >
           <div id="result" style="position:absolute" class="list-group"></div>
      </div>
            <div class="input-group">
                  <input type="text"  disabled class="datepicker form-control" name="start-date" placeholder="From" onkeyup="recieveFormfetchData(this)">
                  <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                  <input type="text"  disabled class="datepicker form-control" name="end-date" placeholder="To" onkeyup="recieveFormfetchData(this)">
                </div>
            <button disabled type="submit" name="generate_report" class="btn btn-danger">Generate Report</button>

  
   <?php include_once('layouts/footer.php'); ?>
 </form>
    </div>
    <div id="receive-table-result"></div>
