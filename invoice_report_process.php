<?php
$page_title = 'Issue Report';
$results = '';
  require_once('includes/load.php');
  
   
?>
<?php
  if(isset($_POST['submit'])){
 $req = array('iv_no');
    validate_fields($req);


    if(empty($errors)):
      $iv_no   = remove_junk($db->escape($_POST['iv_no']));
      $results      = find_issue_by_invoice($iv_no);
    else:
      $session->msg("d", $errors);
      redirect('invoice.php', false);
    endif;

  } else {
    $session->msg("d", "Enter Invoice Number");
    redirect('invoice.php', false);
  }
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Report</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
        text-align: center;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="sale-head pull-right">
           <h1>Issue Report</h1>
           <strong>Invoice Number #  <?php if(isset($iv_no)){ echo  ($iv_no);}?>  </strong>
       </div>

       
      <table class="table table-border">
        <thead>
          <tr>
              <th>Date</th>
              <th>Part Number</th>
              <th>Product Name</th>
              <th>Item Demanded</th>
              <th>Item Issued</th>
              <th>Rate</th>
              
          </tr>
        </thead>
        <tbody >
          <?php foreach($results as $result): ?>
           <tr >
              <td class="desc"><h5><?php echo remove_junk($result['date']);?></h5></td>
              <td class="desc">
                <h5><?php echo remove_junk(ucfirst($result['part_no']));?></h5>
              </td>
              <td class="desc">
              <h5><?php echo remove_junk($result['item_name']);?></h5>
              </td>
              <td class="desc">
              <h5><?php echo remove_junk($result['item_demanded']);?></h5>
              </td>
              <td class="desc"><h5><?php echo remove_junk($result['item_issued']);?></h5></td>
              <td class="desc"><h5><?php echo remove_junk($result['rate']);?></h5></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "Sorry no sales has been found. ");
        redirect('invoice.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
