<?php
  $page_title = 'Issue Product';
  require_once('includes/load.php');
  
 
  $all_categories = find_all('categories');
  $all_units = find_all('units');
?>
<?php
 if(isset($_POST['item_issue'])){
  $req_fields = array('part_no','item_name','iv_no','unit_id','rate','item_demanded','item_issued','to_fol','mission','issued_by', 'total' );
   validate_fields($req_fields);
   if(empty($errors)){
     $number  = remove_junk($db->escape($_POST['part_no']));
     $name   = remove_junk($db->escape($_POST['item_name']));
     $invoice   = remove_junk($db->escape($_POST['iv_no']));
     $unit   = remove_junk($db->escape($_POST['unit_id'])); 
     $rate   = remove_junk($db->escape($_POST['rate']));  
     $demand   = remove_junk($db->escape($_POST['item_demanded']));
     $issue   = remove_junk($db->escape($_POST['item_issued']));
     $fol   = remove_junk($db->escape($_POST['to_fol']));
     $mission   = remove_junk($db->escape($_POST['mission']));
     $by   = remove_junk($db->escape($_POST['issued_by']));
     $total   = remove_junk($db->escape($_POST['total']));

     $date    = make_date();
     $query  = " INSERT INTO issue (part_no, item_name, iv_no, unit_id, rate, item_demanded, item_issued, to_fol, mission, issued_by,date,total)  values  ( '{$number}', '{$name}','{$invoice}', '{$unit}', '{$rate}','{$demand}','{$issue}','{$fol}','{$mission}','{$by}', '{$date}' ,'{$total}'),
      ( '{$number}', '{$name}','{$invoice}', '{$unit}', '{$rate}','{$demand}','{$issue}','{$fol}','{$mission}','{$by}', '{$date}' ,'{$total}'),
       ( '{$number}', '{$name}','{$invoice}', '{$unit}', '{$rate}','{$demand}','{$issue}','{$fol}','{$mission}','{$by}', '{$date}' ,'{$total}')
      ";
     
  //    if($db->query($query)){
  //      $session->msg('s',"Product issued ");
  //      redirect('item_issue.php', false);
  //    } else {
  //      $session->msg('d',' Sorry failed to issue!');
  //      redirect('product.php', false);
  //    }

  //  } else{
  //    $session->msg("d", $errors);
  //    redirect('item_issue.php',false);
  //  }
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
          <form method="post" name="item-issue-form" id="item-issue-form" autocomplete="off" action="item_issue.php">
          <div class="panel-heading clearfix">
          <table>
          <td id="iv_no"><input type="text" class="form-control" name="iv_no" placeholder="Invoice Number" ></td>
          <td id="issued_by"><input type="text" class="form-control" name="issued_by" placeholder="Issued By" ></td>
          
          <strong>
            <button type="submit" name= "item_issue" class="btn btn-info pull-right btn-sm"> Issue</button>
         </strong>
        
        </div>
           </table>
          <table id="items-issue-table" class="table table-bordered">
            <thead>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Part Number </th>
              <th> Item Name </th>
               <th> TO FOL </th>
              <th> Mission </th>
              <th> Rate </th>
              <th> Qty Demanded</th>
              <th> Qty Issued</th>
               <th>Unit </th>                     
              <th> Amount</th>
            </thead>
              <tbody>              
              <tr id="item-issue" attr-field="<?php echo count_row_id();?>">
                <td class="text-center"><?php echo count_id();?></td>
                <td id="part_no"><input type="text" class="form-control" name="part_no" ></td>
                <td id="item_name"><input type="text" class="form-control" name="item_name" ></td>
                <td id="to_fol"><input type="text" class="form-control" name="to_fol" ></td>
                 <td id="mission"><input type="text" class="form-control" name="mission" ></td>
                 <td id="rate"><input type="number" class="form-control" name="rate" ></td>
                <td id="item_demanded">                  
                    <input type="number" class="form-control" name="item_demanded" class="form-control input-number">                
                </td>
                <td id="item_issued">
                  <input type="number" class="form-control" name="item_issued" class="form-control input-number">
                </td>  
                 <td id="unit_id"><input type="text" class="form-control" name="unit_id" ></td>              
                 <td id="total"><input type="number" class="form-control" name="total" ></td>                               
              </tr>                           
            </tbody>
          </table>
          <button name="add_product" id="add_product" class="btn btn-danger">Add product</button>
        </form>
        </div>

<?php include_once('layouts/footer.php'); ?>
