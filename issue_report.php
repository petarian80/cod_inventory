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
   <i class="fa fa-file-text" aria-hidden="true"></i>
   <span class="glyphicon glyphicon-th"></span>
   <span>Issue Product Report </span>
   </strong>
</div>
<div class="panel-heading">
<strong> 
<span> Generate Issue Report By </span></strong>
<div>
   <form action="" id="issue-report-select" autocomplete="off">
      <select class="select" onchange=" issueFormSelectType(this.value)" name="select">
         <option selected disabled value="0"> Select Type </option>
         <option value="1" > Product Name </option>
         <option value ="2"> Part Number </option>
         <option value = "3"> Invoice Number </option>
         <option value = "4"> Date Range </option>
      </select>
       <input type="text" disabled class="form-control" id="item_name" name="item_name" onkeyup="issueFormfetchData(this)" >
           <div id="result" style="position:absolute" class="list-group"></div>

            <button disabled type="submit" name="generate_report" class="btn btn-danger">Generate Report</button>

   </form>
</div>
<?php include_once('layouts/footer.php'); ?>