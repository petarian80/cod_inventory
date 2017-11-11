<head>

<link rel="stylesheet" href="print.css" type="text/css" media="print"> 

</head>


<?php
  $page_title = 'Issue Product';
  require_once('includes/load.php');
  
 
  $all_categories = find_all('categories');
  $all_units = find_all('units');
?>
<?php
 if(isset($_POST['item_issue'])){
   }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>ISSUE ITEM </span>
         </strong>
         
        </div>

        <div class="panel-body table-responsive"  >
          <form method="post" name="item-issue-form" id="item-issue-form" autocomplete="off" action="item_issue.php" class="print">
          <div class="panel-heading clearfix" >
          <table id="header-table" >
          <td id="iv_no"><input type="text" class="form-control" name="iv_no" placeholder="Invoice Number" ></td>
          <td id="issued_by"><input type="text" class="form-control" name="issued_by" placeholder="Issued By" ></td>
           <td id="mission">
            <input type="text" class="form-control" name="mission" id="mission" placeholder = "Mission" onkeyup="mission_list(this)" >
            <div id="result" style="position:absolute" class="list-group"></div>
            </td>

            <td id="unit_name"><input type="text" class="form-control" name="unit_name" placeholder="Unit" onkeyup="unit_list(this)"  >
            <div id="result" style="position:absolute" class="list-group"></div>
            </td>

            <td id="demand_no"><input type="text" class="form-control" name="demand_no" placeholder="Demand No"  >
            <div id="result" style="position:absolute" class="list-group"></div>
            </td>
            <td id="vocab_sec"><input type="text" class="form-control" name="vocab_sec" placeholder="VOCAB-SEC"  >
            <div id="result" style="position:absolute" class="list-group"></div>
            </td>
          <strong>
            <button type="submit" name= "item_issue" class="btn btn-info pull-right btn-sm"  ID="item_issue"> Issue Product</button>
         </strong>
        
        </div>
           </table>
          <table id="items-issue-table" class="table table-bordered">
            <thead>
              <th class="text-center" style="width: 50px;">Action</th>
              <th> Part Number </th>
              <th> Item Name </th>
               <th>A/U Unit </th> 
               <th>Qty Available </th> 
               <th> Qty Demanded</th>
              <th> Qty Issued</th>
               <th> TO FOL </th>
              <th> Rate </th>                             
              <th> Amount</th>
              <th> Pac No</th>


            </thead>
              <tbody>              
              <tr id="item-issue" attr-field="<?php echo count_row_id();?>">
                
               <td class="text-center">
                  <div class="btn-group">
                    <button onClick="deleteRow(this)" class="btn btn-danger btn-xs">
                    
                    <i class="fa fa-trash" aria-hidden="true"></i>
                   
                    </button>
                  </div>
                </td>

                <td id="part_no"><input type="text" class="form-control" name="part_no" onkeyup="listByPart(this)" >
                <div id="result" style="position:absolute" class="list-group"></div>
                </td>

                <td id="item_name"><input type="text" class="form-control" name="item_name" onkeyup="listByname(this)" >
                 <div id="result" style="position:absolute" class="list-group"></div>
                </td>

                 <td id="unit_id"><input type="text" class="form-control" name="unit_id" disabled ></td>
                 <td id="quantity">
                 <input type="number" class="form-control" name="quantity"  disabled  onkeyup="calculate(this)" >
                 <div id="quantity" style="position:absolute" class="list-group"></div>
                 </td>
                  <td id="item_demanded">                  
                    <input type="number" class="form-control" name="item_demanded" class="form-control input-number" onkeyup="calculate(this)"  >  
                     <div id="item_demanded" style="position:absolute" class="list-group"></div>
                </td>

                <td id="item_issued">
                  <input type="number" class="form-control" name="item_issued" class="form-control input-number"  onkeyup="calculate(this)" >
                    <div id="item_issued" style="position:absolute" class="list-group"></div>
            </td>  

                <td id="to_fol"><input type="number" class="form-control" name="to_fol"  disabled>
                <div id="to_fol" style="position:absolute" class="list-group"></div>
                </td>

                 <td id="rate"><input type="number" class="form-control" name="rate" disabled onkeyup="calculate(this)" >
                  <div id="rate" style="position:absolute" class="list-group"></div> 
                 </td> 

                 <td id="total"><input type="number" class="form-control" name="total" disabled >
                  <div id="total" style="position:absolute" class="list-group"></div>
                 </td>                          

                <td id="pac_no"><input type="text" class="form-control" name="pac_no"  >
                  <div id="pac_no" style="position:absolute" class="list-group"></div>
                 </td>                          

     
              </tr>                           
            </tbody>
          </table>
          <button name="add_product" id="add_product" class="btn btn-danger">Add product</button>
        </form>
        </div>

<?php include_once('layouts/footer.php'); ?>



<script>
function print_form() {

    var printButton = document.getElementById("item_issue");
    var printButton1 = document.getElementById("add_product");

        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        printButton1.style.visibility = 'hidden';
   
    window.print();
 
}
</script>

