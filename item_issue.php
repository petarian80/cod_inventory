<?php
  $page_title = 'Product issued';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 
  $all_categories = find_all('categories');
  $all_units = find_all('units');
?>
<?php
 if(isset($_POST['issue_item'])){
  $req_fields = array('part_no','item_name','iv_no','unit_id','rate','item_demanded','item_issued','to_fol','unit','issued_by', 'total' );
   validate_fields($req_fields);
   if(empty($errors)){
     $i_number  = remove_junk($db->escape($_POST['part_no']));
     $i_name   = remove_junk($db->escape($_POST['item_name']));
     $i_v   = remove_junk($db->escape($_POST['iv_no']));
     $i_unit   = remove_junk($db->escape($_POST['unit_id'])); 
     $i_rate   = remove_junk($db->escape($_POST['rate']));  
     $i_demand   = remove_junk($db->escape($_POST['item_demanded']));
     $i_ssue   = remove_junk($db->escape($_POST['item_issued']));
     $i_fol   = remove_junk($db->escape($_POST['to_fol']));
     $i_ut   = remove_junk($db->escape($_POST['unit']));
     $i_by   = remove_junk($db->escape($_POST['issued_by']));
     $i_total   = remove_junk($db->escape($_POST['total']));

     $date    = make_date();
     $query  = "INSERT INTO issue (";
     $query .="part_no, item_name, iv_no, unit_id, rate, item_demanded, item_issued, to_fol, unit, issued_by,date,total";
     $query .=") VALUES (";
     $query .=" '{$i_number}', '{$i_name}','{$i_v}', '{$i_unit}', '{$i_rate}','{$i_demand}','{$i_ssue}','{$i_fol}','{$i_ut}','{$i_by}', '{$date}' ,'{$i_total}' ";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Product issued ");
       redirect('item_issue.php', false);
     } else {
       $session->msg('d',' Sorry failed to issue!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('item_issue.php',false);
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
            <span>ISSUE ITEM </span>
         </strong>
         
        </div>

        <div class="panel-body table-responsive">
          <form method="post" name="item-issue-form" id="item-issue-form" action="<?php ?>">
          <div class="panel-heading clearfix">
          <strong>
            <button type="submit" class="btn btn-info pull-right btn-sm"> Publish Items</button>
         </strong>
         
        </div>
          
          <table id="items-issue-table" class="table table-bordered">
            <thead>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Part No# </th>
              <th> Item Name </th>
              <th> Unit </th>
              <th> Rate </th>
              <th> Qty Demanded</th>
              <th> Qty Issued</th>              
              <th> Amount</th>
            </thead>
              <tbody>              
              <tr id="item-issue" attr-field="<?php echo count_row_id();?>">
                <td class="text-center"><?php echo count_id();?></td>
                <td id="part_no"><input type="text" class="form-control" name="part_no" onkeyup="listByPart(this)" placeholder="Part Number">
                <div id="result" style="position:absolute" class="list-group"></div>
                </td>
                <td id="item_name"><input type="text" class="form-control" name="item_name" onkeyup="listByName(this)" placeholder="Item Name">
                <div id="result" style="position:absolute" class="list-group"></div>
                </td>                
                <td id="unit" class="text-center"></td>
                <td id="rate"></td>
                <td id="qty_d">                  
                    <input type="number" class="form-control" name="qty_d" class="form-control input-number" value="1" min="1" max="10">                
                </td>
                <td id="qty_i">
                  <input type="number" class="form-control" name="qty_i" class="form-control input-number" value="1" min="1" max="10">
                </td>                
                <td id="amount"></td>                                
              </tr>                           
            </tbody>
          </table>
          <button name="add_product" id="add_product" class="btn btn-danger">Add product</button>
        </form>
        </div>

<?php include_once('layouts/footer.php'); ?>
