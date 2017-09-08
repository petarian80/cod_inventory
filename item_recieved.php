<?php
  $page_title = 'Product Recieved';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 
  $all_categories = find_all('categories');
  $all_units = find_all('units');
?>
<?php
 if(isset($_POST['item_recieve'])){
   $req_fields = array('part_no','item_name','unit_id','quantity','alp_no','categorie_id','rate','po_no','drs_no','crv_no','firm','remarks' );
   validate_fields($req_fields);
   if(empty($errors)){
     $r_number  = remove_junk($db->escape($_POST['part_no']));
     $r_name   = remove_junk($db->escape($_POST['item_name']));
     $r_unit   = remove_junk($db->escape($_POST['unit_id']));
     $r_qty   = remove_junk($db->escape($_POST['quantity'])); 
     $r_alp   = remove_junk($db->escape($_POST['alp_no']));
     $r_cat   = remove_junk($db->escape($_POST['categorie_id']));
     $r_rate   = remove_junk($db->escape($_POST['rate']));
     $r_po   = remove_junk($db->escape($_POST['po_no']));
     $r_drs   = remove_junk($db->escape($_POST['drs_no']));
     $r_crv   = remove_junk($db->escape($_POST['crv_no']));
     $r_firm   = remove_junk($db->escape($_POST['firm']));
      $r_remarks   = remove_junk($db->escape($_POST['remarks']));
     $date    = make_date();
     $query  = "INSERT INTO recieved (";
     $query .="part_no, item_name,unit_id,quantity,alp_no,categorie_id,po_no,date,drs_no,crv_no,rate,firm,remarks";
     $query .=") VALUES (";
     $query .=" '{$r_number}', '{$r_name}','{$r_unit}', '{$r_qty}', '{$r_alp}','{$r_cat}','{$r_po}', '{$date}','{$r_drs}','{$r_crv}','{$r_rate}','{$r_firm}','{$r_remarks}'";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('item_recieved.php',false);
   }

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
          <form method="post" name="item-recieve-form" id="item-recieve-form" autocomplete="off" action="item_recieved.php">
          <div class="panel-heading clearfix">
          <table>
          <td id="iv_no"><input type="text" class="form-control" name="iv_no" placeholder="Invoice Number" ></td>
          <td id="recieved_by"><input type="text" class="form-control" name="issued_by" placeholder="Recieved By" ></td>
          
          <strong>
            <button type="submit" name= "item_recieve" class="btn btn-info pull-right btn-sm"> Recieve</button>
         </strong>
        
        </div>
           </table>
          <table id="items-recieve-table" class="table table-bordered">
            <thead>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Part Number </th>
              <th> Item Name </th>
               <th> Unit </th>
              <th> Qty Recieved </th>
              <th> ALP Number </th>
              <th> Categorie</th>
              <th> Rate</th>
               <th> PO Number </th>                     
              <th> DRS</th>
              <th> CRV Number</th>
              <th>Firm</th>
              <th> Remarks</th>
            </thead>
              <tbody>              
              <tr id="item-issue" attr-field="<?php echo count_row_id();?>">
                <td class="text-center"><?php echo count_id();?></td>
                <td id="part_no"><input type="text" class="form-control" name="part_no" onkeyup="listByPart(this)" >
                <div id="result" style="position:absolute" class="list-group"></div>
                </td>
                <td id="item_name"><input type="text" class="form-control" name="item_name" onkeyup="listByname(this)" >
                 <div id="result" style="position:absolute" class="list-group"></div>
                </td>
                <td id="unit_id"><input type="text" class="form-control" name="unit_id" ></td>
                 <td id="quantity"><input type="text" class="form-control" name="quantity" ></td>
                 <td id="alp_no"><input type="text" class="form-control" name="alp_no" ></td>
                <td id="categorie">                  
                    <input type="text" class="form-control" name="categorie" class="form-control input-number">                
                </td>
                <td id="rate">
                  <input type="number" class="form-control" name="rate" class="form-control input-number">
                </td>  
                 <td id="po_no"><input type="text" class="form-control" name="po_no"  ></td>              
                 <td id="drs"><input type="text" class="form-control" name="drs" ></td>
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
