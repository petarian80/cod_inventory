<?php
  $page_title = 'Product received';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 
  $all_categories = find_all('categories');
  $all_units = find_all('units');
?>
<?php
 if(isset($_POST['item_recieve'])){

      // $session->msg('s',"Product added ");
       //redirect('add_product.php', false);
         // $session->msg('d',' Sorry failed to added!');
       //redirect('product.php', false);
     

   
     //$session->msg("d", $errors);
     //redirect('item_received.php',false);
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
            <span>RECIEVE ITEM </span>
         </strong>
         
        </div>

        <div class="panel-body table-responsive">
          <form method="post" name="item-recieve-form" id="item-recieve-form" autocomplete="off" action="item_received.php">
          <div class="panel-heading clearfix">
          <table id="header-table">
          <td id="received_by"><input type="text" class="form-control" name="received_by" placeholder="received By" ></td>
           <td id="po_no"><input type="text" class="form-control" name="po_no" placeholder="PO NUMBER" required ></td>
          <strong>
            <button type="submit" name= "item_recieve" class="btn btn-info pull-right btn-sm"> Recieve Product</button>
         </strong>
        
        </div>
           </table>
          <table id="items-recieve-table" class="table table-bordered">
            <thead>
              <th class="text-center" style="width: 50px;">Action</th>
              <th> Part Number </th>
              <th> Item Name </th>
               <th> Unit </th>
              <th> Qty received </th>
              <th> ALP Number </th>
              <th> Categorie</th>
              <th> Rate</th>                 
              <th> DRS</th>
              <th> CRV Number</th>
              <th>Firm</th>
              <th> Remarks</th>
            </thead>
              <tbody>              
              <tr id="item-recieve" attr-field="<?php echo count_row_id();?>">

                  <td class="text-center">
                  <div class="btn-group">
                    <button onClick="deleteRow(this)" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </div>
                </td>
                </td>
                <td id="part_no"><input type="text" class="form-control" name="part_no" onkeyup="listByPart_recieve(this)" >
                <div id="result" style="position:absolute" class="list-group"></div>
                </td>
                <td id="item_name"><input type="text" class="form-control" name="item_name" onkeyup="listByname_recieve(this)" >
                 <div id="result" style="position:absolute" class="list-group"></div>
                </td>
                <td id="unit_id"><input type="text" class="form-control" name="unit_id" disabled ></td>
                 <td id="quantity"><input type="text" class="form-control" name="quantity" ></td>
                 <td id="alp_no"><input type="text" class="form-control" name="alp_no" ></td>
                <td id="categorie">                  
                    <input type="text" class="form-control" name="categorie" class="form-control input-number" disabled>                
                </td>
                <td id="rate">
                  <input type="number" class="form-control" name="rate" class="form-control input-number">
                </td>                
                 <td id="drs_no"><input type="text" class="form-control" name="drs_no" ></td>
                 <td id="crv_no"><input type="text" class="form-control" name="crv_no" ></td>                               
                 <td id="firm"><input type="text" class="form-control" name="firm" ></td>
                 <td id="remarks"><input type="text" class="form-control" name="remarks" ></td>
              </tr>                           
            </tbody>
          </table>
          <button name="add_product" id="add_product" class="btn btn-danger">Add product</button>
        </form>
        </div>

<?php include_once('layouts/footer.php'); ?>
