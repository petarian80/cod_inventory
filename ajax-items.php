<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>


<?php
 // issue report form 
   if(isset($_POST['issue_report_submit']))
   {     
      $ArrayOfProducts = $_POST['issue_report_submit']['input_value'];
      $Array = $_POST['issue_report_submit']['selected_type'];

      switch($Array) {
        case "1":
        
        $p=find_issue_by_item_name($ArrayOfProducts);
        print_r($p);
        //echo $p;

       
         $html = '';

        $html .='<div class="panel-body">';
        $html .='<table class="table table-bordered">';
        $html.= ' <thead>';
        $html.= '<tr>';
        $html.= '<th class="text-center" >S.No</th>';
        $html.= '<th class="text-center" style="width: 25%;">Part Number</th>';
        $html.= '<th class="text-center" style="width: 25%;">Product Name</th>';
        $html.= '<th class="text-center"  style="width: 15%;"> Invoice Number </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Rate </th>';
        $html.= '<th class="text-center" style="width: 20%;"> Item demanded </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Item issued </th>';
        $html.= '</tr>';
        $html.= '</thead>';
        $html.= '<tbody>';
        foreach ($p as $product):
        $html.= '<tr>';
        $html .='<td class="text-center">'.  count_id() . '</td>';
        $html .='<td class="text-center">' .  remove_junk($product["part_no"]) . '</td>';
        $html .='<td class="text-center">' .  remove_junk($product["item_name"]) . '</td>';
        $html .='<td> '                     .  remove_junk($product["iv_no"]). '</td>';
        $html .='<td class="text-center">'  .  remove_junk($product["rate"]). '</td>';
        $html .='<td class="text-center">' . remove_junk($product["item_demanded"]).'</td>';
        $html .='<td class="text-center">' .  remove_junk($product["item_issued"]).'</td>';                
        $html .='</tr>';
        $html .=' </tr>';
              endforeach; 
         $html .='</tbody>';
        $html .='</tabel>';
        $html .='</div>';
         echo $html;
         break;
       
       
        case "2":

        $p = find_issue_by_part_no($ArrayOfProducts);
        print_r($p);
        //echo $p;

         $html = '';

        $html .='<div class="panel-body">';
        $html .='<table class="table table-bordered">';
        $html.= ' <thead>';
        $html.= '<tr>';
        $html.= '<th class="text-center" style="width: 50px;">S.No</th>';
        $html.= '<th class="text-center" style="width: 15%;">Part Number</th>';
        $html.= '<th class="text-center">    Invoice Number </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Rate </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Item demanded </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Item issued </th>';
        $html.= '</tr>';
        $html.= '</thead>';
        $html.= '<tbody>';
        foreach ($p as $product):
        $html.= '<tr>';
        $html .='<td class="text-center">'.  count_id() . '</td>';
        $html .='<td class="text-center">' .  remove_junk($product["part_no"]) . '</td>';
        $html .='<td> '                     .  remove_junk($product["iv_no"]). '</td>';
        $html .='<td class="text-center">'  .  remove_junk($product["rate"]). '</td>';
        $html .='<td class="text-center">' . remove_junk($product["item_demanded"]).'</td>';
        $html .='<td class="text-center">' .  remove_junk($product["item_issued"]).'</td>';                
        $html .='</tr>';
        $html .=' </tr>';
              endforeach; 
         $html .='</tbody>';
        $html .='</tabel>';
        $html .='</div>';
         echo $html;

            break;
        
        
        case "3":
       
        $p=find_issue_by_invoice_no($ArrayOfProducts);
        print_r($p);
        //echo $p;
      
       $html = '';

        $html .='<div class="panel-body">';
        $html .='<table class="table table-bordered">';
        $html.= ' <thead>';
        $html.= '<tr>';
        $html.= '<th class="text-center" style="width: 50px;">S.No</th>';
        $html.= '<th class="text-center" style="width: 15%;">Part Number</th>';
        $html.= '<th class="text-center">    Invoice Number </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Rate </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Item demanded </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Item issued </th>';
        $html.= '</tr>';
        $html.= '</thead>';
        $html.= '<tbody>';
        foreach ($p as $product):
        $html.= '<tr>';
        $html .='<td class="text-center">'.  count_id() . '</td>';
        $html .='<td class="text-center">' .  remove_junk($product["part_no"]) . '</td>';
       // $html .='<td> '                     .  remove_junk($product["iv_no"]). '</td>';
        $html .='<td class="text-center">'  .  remove_junk($product["rate"]). '</td>';
        $html .='<td class="text-center">' . remove_junk($product["item_demanded"]).'</td>';
        $html .='<td class="text-center">' .  remove_junk($product["item_issued"]).'</td>';                
        $html .='</tr>';
        $html .=' </tr>';
              endforeach; 
         $html .='</tbody>';
        $html .='</tabel>';
        $html .='</div>';
         echo $html;
          break;
      
        case "4":
        
        break;

         }


      
        
      }
      


 ?>


<?php
 // recieve report form 
   if(isset($_POST['recieve_report_submit']))
   {     
      $ArrayOfProducts = $_POST['recieve_report_submit']['input_value'];
      $Array = $_POST['recieve_report_submit']['selected_type'];

      switch($Array) {
        case "1":
        
        $p=find_recieve_by_item_name($ArrayOfProducts);
        print_r($p);
        // echo $p;
        $html = '';

        $html .='<div class="panel-body">';
        $html .='<table class="table table-bordered">';
        $html.= ' <thead>';
        $html.= '<tr>';
        $html.= '<th class="text-center" style="width: 50px;">S.No</th>';
        $html.= '<th class="text-center" style="width: 15%;">Part Number</th>';
        $html.= '<th class="text-center">    Invoice Number </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Rate </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Item demanded </th>';
        $html.= '<th class="text-center" style="width: 10%;"> Item issued </th>';
        $html.= '</tr>';
        $html.= '</thead>';
        $html.= '<tbody>';
        foreach ($p as $product):
        $html.= '<tr>';
        $html .='<td class="text-center">'.  count_id() . '</td>';
        $html .='<td class="text-center">' .  remove_junk($product["part_no"]) . '</td>';
        $html .='<td> '                     .  remove_junk($product["item_name"]). '</td>';
        $html .='<td class="text-center">'  .  remove_junk($product["rate"]). '</td>';
        $html .='<td class="text-center">' . remove_junk($product["po_no"]).'</td>';
        $html .='<td class="text-center">' .  remove_junk($product["quantity"]).'</td>';                
        $html .='</tr>';
        $html .=' </tr>';
              endforeach; 
         $html .='</tbody>';
        $html .='</tabel>';
        $html .='</div>';
         echo $html;


       
         break;
       
       
        case "2":

        $p = find_recieve_by_part_no($ArrayOfProducts);
        print_r($p);
        echo $p;

            break;
        
        
        case "3":
       
        $p=find_recieve_by_po_no($ArrayOfProducts);
        print_r($p);
        echo $p;
      
          break;
      
        case "4":
        
        break;

         }  
      }
      
 ?>




<?php
 // Issue Form Post 
   if(isset($_POST['issue_form_submit']))
   {     
      $ArrayOfProducts = $_POST['issue_form_submit']["form"];
      $invoiceNo =  $_POST['issue_form_submit']["invoice"];
      $issuedBy = $_POST['issue_form_submit']["issued_by"];
      $mission = $_POST['issue_form_submit']["mission"];
      $unit_name = $_POST['issue_form_submit']["unit_name"];
      $demand_no = $_POST['issue_form_submit']["demand_no"];
      $vocab_sec = $_POST['issue_form_submit']["vocab_sec"];
      // query for parent table 
      if(is_array($ArrayOfProducts)){
        $p=insert_issued_product($ArrayOfProducts, $invoiceNo, $issuedBy, $mission, $unit_name, $demand_no, $vocab_sec );
        $inv= insert_invoice($invoiceNo, $issuedBy);
        session_start();
        $_SESSION['totalcolumns'] = $_POST['issue_form_submit']; 
        echo $p;
        echo $inv;
        
        }
        
      

}
 ?>

<?php
 // recieve Form Post 
   if(isset($_POST['recieve_form_submit']))
   {     
      $ArrayOfProducts = $_POST['recieve_form_submit']["form"];
      $receivedBy = $_POST['recieve_form_submit']["received_by"];
      $po_no = $_POST['recieve_form_submit']["po_no"];
      // query for parent table 
      if(is_array($ArrayOfProducts)){
        $p=insert_received_product($ArrayOfProducts, $receivedBy,$po_no );
        $d = insert_po_no($po_no,$receivedBy);
        echo $p;
        echo $d;
      }
      

}
 ?>

 


<?php
 // Auto suggetion for issue form and to fill mission
    $html = '';
   if(isset($_POST['mission_list']) && strlen($_POST['mission_list']))
   {     
     $mission = find_mission($_POST['mission_list']);
     if($mission){
        foreach ($mission as $miss):
           $html .= "<li class=\"list-group-item\">";
           $html .= $miss['mission'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);


   }
   
 ?>

<?php
 // Auto suggetion for searching product
    $html = '';
   if(isset($_POST['search_product']) && strlen($_POST['search_product']))
   {     
     $products = search_product($_POST['search_product']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['item_name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);


   }
   
 ?>




 <?php
 // Auto suggetion for issue form and to fill unit
    $html = '';
   if(isset($_POST['unit_list']) && strlen($_POST['unit_list']))
   {     
     $unit = find_unit($_POST['unit_list']);
     if($unit){
        foreach ($unit as $unt):
           $html .= "<li class=\"list-group-item\">";
           $html .= $unt['unit_name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);


   }
   
 ?>


<?php
 // Auto suggetion for invoice number form invoice table
    $html = '';
   if(isset($_POST['invoice_list']) && strlen($_POST['invoice_list']))
   {     
     $invoice = find_invoice($_POST['invoice_list']);
     if($invoice){
        foreach ($invoice as $inv):
           $html .= "<li class=\"list-group-item\">";
           $html .= $inv['iv_no'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);


   }
   
 ?>


 <?php
 // Auto suggetion for po number form purchase order table
    $html = '';
   if(isset($_POST['po_list']) && strlen($_POST['po_list']))
   {     
     $invoice = find_po($_POST['po_list']);
     if($invoice){
        foreach ($invoice as $inv):
           $html .= "<li class=\"list-group-item\">";
           $html .= $inv['po_no'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);


   }
   
 ?>






<?php
 // Auto suggetion for issue form and to fill by part number
    $html = '';
   if(isset($_POST['product_part_no']) && strlen($_POST['product_part_no']))
   {     
     $products = find_product_by_part($_POST['product_part_no']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['part_no'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);
   }

   if(isset($_POST['product_by_part_no']) && strlen($_POST['product_by_part_no']))
   {     
     $product = get_product_by_part($_POST['product_by_part_no']);
     $product = $product[0];
     $product_unit = get_product_unit_by_id($product['unit_id']);
     $product_unit = $product_unit[0]['name'];
  
     $returnArr = array(
       'name' => $product['item_name'],
       'unit' => $product_unit,
       'rate' =>$product['rate'],
       'qty_avaiable' =>$product['quantity'],

     );
     //print_r($product);     
     echo json_encode($returnArr);
   }
 ?>


<?php
 // Auto suggetion for issue form and to fill by name
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {     
     $products = find_product_by_name($_POST['product_name']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['item_name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);
   }

   if(isset($_POST['product_by_name']) && strlen($_POST['product_by_name']))
   {     
     $product = get_product_by_name($_POST['product_by_name']);
     $product = $product[0];
     $product_unit = get_product_unit_by_id($product['unit_id']);
     $product_unit = $product_unit[0]['name'];
     
     $returnArr = array(
       'part' => $product['part_no'],
       'unit' => $product_unit,
       'rate' => $product['rate'],
       'quantity' => $product['quantity'],
     );
     //print_r($product);     
     echo json_encode($returnArr);
   }
 ?>




<?php
 // Auto suggetion for recieve form and to fill by part number
    $html = '';
   if(isset($_POST['product_part_no_recieve']) && strlen($_POST['product_part_no_recieve']))
   {     
     $products = find_product_by_part($_POST['product_part_no_recieve']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['part_no'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);
   }

   if(isset($_POST['product_by_part_no_recieve']) && strlen($_POST['product_by_part_no_recieve']))
   {     
     $product = get_product_by_part($_POST['product_by_part_no_recieve']);
     $product = $product[0];
     $product_unit = get_product_unit_by_id($product['unit_id']);
     $product_unit = $product_unit[0]['name'];
     $product_categorie = get_product_categorie_by_id($product['categorie_id']);
     $product_categorie = $product_categorie[0]['name'];
  
     $returnArr = array(
       'name' => $product['item_name'],
       'unit' => $product_unit,
       'categorie' =>$product_categorie,
     );
     //print_r($product);     
     echo json_encode($returnArr);
   }
 ?>


<?php
 // Auto suggetion for recieve form and to fill by name
    $html = '';
   if(isset($_POST['product_name_recieve']) && strlen($_POST['product_name_recieve']))
   {     
     $products = find_product_by_name($_POST['product_name_recieve']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['item_name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }
      echo json_encode($html);
   }

   if(isset($_POST['product_by_name_recieve']) && strlen($_POST['product_by_name_recieve']))
   {     
     $product = get_product_by_name($_POST['product_by_name_recieve']);
     $product = $product[0];
     $product_unit = get_product_unit_by_id($product['unit_id']);
     $product_unit = $product_unit[0]['name'];
     $product_categorie = get_product_categorie_by_id($product['categorie_id']);
     $product_categorie = $product_categorie[0]['name'];
     
     $returnArr = array(
       'part' => $product['part_no'],
       'unit' => $product_unit,
       'categorie' =>$product_categorie,
     );
     //print_r($product);     
     echo json_encode($returnArr);
   }
 ?>


 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {

          $html .= "<tr>";

          $html .= "<td id=\"s_name\">".$result['name']."</td>";
          $html .= "<input type=\"hidden\" name=\"s_id\" value=\"{$result['id']}\">";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"price\" value=\"{$result['sale_price']}\">";
          $html  .= "</td>";
          $html .= "<td id=\"s_qty\">";
          $html .= "<input type=\"text\" class=\"form-control\" name=\"quantity\" value=\"1\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"total\" value=\"{$result['sale_price']}\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date\" data-date data-date-format=\"yyyy-mm-dd\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<button type=\"submit\" name=\"item_received\" class=\"btn btn-primary\">Add sale</button>";
          $html  .= "</td>";
          $html  .= "</tr>";

        }
    } else {
        $html ='<tr><td>product name not resgister in database</td></tr>';
    }

    echo json_encode($html);
  }

  // find all product
  if(isset($_POST['product-name-search']) && strlen($_POST['product-name-search']))
  {
    $product_title = remove_junk($db->escape($_POST['product-name-search']));
    $html = '';
    if($results = get_product_by_name($product_title)){
        print_r($results);
        foreach ($results as $result) {
           
           foreach($result as $r){
              $html .= '<div>' . $r .'</div><br/>';
           }  

        }
    } else {
        $html ='<tr><td>product name not resgister in database</td></tr>';
    }

    echo json_encode($html);
  }

 ?>
