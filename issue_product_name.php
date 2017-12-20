<?php
$page_title = 'Issue Report';
$results = '';
  require_once('includes/load.php');
  
   
?>
<?php
  if(isset($_POST['submit'])){
    $name = array('item_name');
    validate_fields($name);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $name     = remove_junk($db->escape($_POST['item_name']));
      $results      = find_issue_by_name($start_date,$end_date,$name);
    else:
      $session->msg("d", $errors);
      redirect('product_name.php', false);
    endif;

  } else {
    $session->msg("d", "Select dates");
    redirect('product_name.php', false);
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
           <strong>From <?php if(isset($start_date)){ echo  ($start_date);}?> To <?php if(isset($end_date)){echo $end_date;}?> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>Date</th>
              <th>Part Number</th>
              <th>Product Name</th>
              <th>Invoice Number</th>
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
              <h5><?php echo remove_junk($result['iv_no']);?></h5>
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
        redirect('issue_report.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
