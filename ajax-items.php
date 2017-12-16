<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
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
      $recievedBy = $_POST['recieve_form_submit']["recieved_by"];
      $po_no = $_POST['recieve_form_submit']["po_no"];
      // query for parent table 
      if(is_array($ArrayOfProducts)){
        $p=insert_recieved_product($ArrayOfProducts, $recievedBy,$po_no );
        echo $p;
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
 // Auto suggetion for generate report form and to fill by part number
    $html = '';
   if(isset($_POST['product_part_no_report']) && strlen($_POST['product_part_no_report']))
   {     
     $products = find_product_by_part($_POST['product_part_no_report']);
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

   if(isset($_POST['product_by_part_report']) && strlen($_POST['product_by_part_report']))
   {     
     $product = get_product_by_part($_POST['product_by_part_report']);
     $product = $product[0];
    
     $returnArr = array(
       'name' => $product['item_name'],
     );
     //print_r($product);     
     echo json_encode($returnArr);
   }
 ?>


<?php
 // Auto suggetion for report generation form and to fill by name
    $html = '';
   if(isset($_POST['product_name_report']) && strlen($_POST['product_name_report']))
   {     
     $products = find_product_by_name($_POST['product_name_report']);
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

   if(isset($_POST['product_by_name_report']) && strlen($_POST['product_by_name_report']))
   {     
     $product = get_product_by_name($_POST['product_by_name_report']);
     $product = $product[0];
     
     $returnArr = array(
       'part' => $product['part_no'],
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
          $html  .= "<button type=\"submit\" name=\"item_recieved\" class=\"btn btn-primary\">Add sale</button>";
          $html  .= "</td>";
          $html  .= "</tr>";

        }
    } else {
        $html ='<tr><td>product name not resgister in database</td></tr>';
    }

    echo json_encode($html);
  }
 ?>
