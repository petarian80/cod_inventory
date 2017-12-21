<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  
   /*--------------------------------------------------------------*/
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.id,p.part_no,p.item_name,p.quantity,p.rate,p.date,c.name";
    $sql  .=" AS categorie";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
   
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/


// for mission
   function find_mission($mission_from_list){
     global $db;
     $p_name = remove_junk($db->escape($mission_from_list));
     $sql = "SELECT mission FROM mission WHERE mission like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

// for search product
   function search_product($search_product_list){
     global $db;
     $p_name = remove_junk($db->escape($search_product_list));
     $sql = "SELECT item_name FROM products WHERE item_name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }
function findProduct($search){
     global $db;
     $p_name = remove_junk($db->escape($search));
    $sql  =" SELECT p.id,p.part_no,p.item_name,p.quantity,p.rate,p.date,c.name";
     $sql  .=" AS categorie";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
   
    $sql  .=" where item_name='$p_name'";   
    
     $result = find_by_sql($sql);
     return $result;
   }


   // for unit
   function find_unit($unit_from_list){
     global $db;
     $p_name = remove_junk($db->escape($unit_from_list));
     $sql = "SELECT unit_name FROM army_units WHERE unit_name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

   
// for part number
   function find_product_by_part($product_part_name){
     global $db;
     $p_name = remove_junk($db->escape($product_part_name));
     $sql = "SELECT part_no FROM products WHERE part_no like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

   
// for part number
   function get_product_by_part($product_part_name){
     global $db;
     $p_name = remove_junk($db->escape($product_part_name));
     $sql = "SELECT * FROM products WHERE part_no = '$p_name'";
     $result = find_by_sql($sql);
     return $result;
   }

   // for item name
   function find_product_by_name($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT item_name FROM products WHERE item_name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

   
// for item name
   function get_product_by_name($product_by_name){
     global $db;
     $p_name = remove_junk($db->escape($product_by_name));
     $sql = "SELECT * FROM products WHERE item_name = '$p_name'";
     $result = find_by_sql($sql);
     return $result;
   }

  
function get_product_by_name_from_issue($product_by_name){
     global $db;
     $p_name = remove_junk($db->escape($product_by_name));
     $sql = "SELECT * FROM issue WHERE item_name = '$p_name'";
     $result = find_by_sql($sql);
     return $result;
   }
  
  
// for part number & for name
   function get_product_unit_by_id($unit_id){
     global $db;
     $p_name = remove_junk($db->escape($unit_id));
     $sql = "SELECT name FROM units WHERE id = '$p_name' LIMIT 1";
     $result = find_by_sql($sql);
     return $result;
   }
   // for recieve
   function get_product_categorie_by_id($categorie_id){
     global $db;
     $p_name = remove_junk($db->escape($categorie_id));
     $sql = "SELECT name FROM categories WHERE id = '$p_name' LIMIT 1";
     $result = find_by_sql($sql);
     return $result;
   }

// insert Issue Object in table
   function insert_issued_product($ArrayOfProducts, $invoiceNo, $issuedBy, $mission, $unit_name, $demand_no, $vocab_sec){
 global $db;
 
    $sql = "INSERT INTO issue (part_no, item_name, iv_no, unit_id, rate, item_demanded, item_issued, to_fol, mission,unit_name, issued_by,total,pac_no,demand_no,vocab_sec) VALUES ";
    
for ($i = 0; $i <count($ArrayOfProducts) ; ++$i)
{
    $row = $ArrayOfProducts[$i];
    if ($i > 0) $sql .= ", ";
        
        $part_no = mysql_real_escape_string( $row['part_no'] );
        $item_name = mysql_real_escape_string( $row['item_name'] );
        $iv_no = mysql_real_escape_string( $invoiceNo );
        $unit_id = mysql_real_escape_string( $row['unit_id'] );
        $rate = (int) $row['rate'];
        $item_demanded = (int) $row['item_demanded'];
        $item_issued = (int) $row['item_issued'];
        $to_fol = (int) $row['to_fol'];
        $mission = mysql_real_escape_string($mission );
        $unit_name = mysql_real_escape_string( $unit_name );
        $issued_by = mysql_real_escape_string( $issuedBy );
        $total = (int) $row['total'];
       $pac_no = mysql_real_escape_string($row['pac_no'] );
       $demand_no = mysql_real_escape_string( $demand_no );
       $vocab_sec = mysql_real_escape_string( $vocab_sec );
        
        $sql.= "('$part_no', '$item_name', '$iv_no', '$unit_id', '$rate', '$item_demanded', '$item_issued', '$to_fol', '$mission', '$unit_name','$issued_by', '$total' ,'$pac_no','$demand_no','$vocab_sec') ";
     $pr_qtyArray[$part_no] = $item_issued;
        
}
     $db->query($sql);
      print_r($pr_qtyArray);
    
       foreach ($pr_qtyArray as $key => $val) {
      $sql1 ="UPDATE products SET quantity = (quantity - $val) where part_no= '$key' ";
      $db->query($sql1);
    
        



   }
  
   }
// insert invoice number into invoice table
   function insert_invoice($invoiceNo, $issuedBy){
 global $db;
 
    $sql = "INSERT INTO invoice ( iv_no, issued_by) VALUES ";
    
        $iv_no = mysql_real_escape_string( $invoiceNo );
        $issued_by = mysql_real_escape_string( $issuedBy );
        $sql.= "('$iv_no','$issued_by') ";
        

     $db->query($sql);

   }
  
   


// insert recieve Object in table
   function insert_recieved_product($ArrayOfProducts, $recievedBy, $po_no){

  global $db;  
  $pr_qtyArray = array(); 
    $sql = "INSERT INTO recieved (part_no, item_name, unit_id, quantity, alp_no, categorie_id, po_no,drs_no,crv_no,rate,recieved_by,firm,remarks) VALUES ";
  
for ($i = 0; $i <count($ArrayOfProducts) ; ++$i)
{
    $row = $ArrayOfProducts[$i];
    if ($i > 0) $sql .= ", ";
  

        $part_no = mysql_real_escape_string( $row['part_no'] );
        $item_name = mysql_real_escape_string( $row['item_name'] );
        $unit_id = mysql_real_escape_string( $row['unit_id'] );
        $quantity = (int) $row['quantity'];
        $alp_no = mysql_real_escape_string( $row['alp_no'] );
        $categorie_id = mysql_real_escape_string( $row['categorie'] );
        $po_no = mysql_real_escape_string($po_no );
        $drs_no = mysql_real_escape_string($row['drs_no'] );
        $crv_no = mysql_real_escape_string($row['crv_no'] );
        $rate = (int) $row['rate'];
        $recieved_by = mysql_real_escape_string( $recievedBy );
        $firm = mysql_real_escape_string($row['firm'] );
        $remarks = mysql_real_escape_string($row['remarks'] );
        $sql.= "('$part_no', '$item_name', '$unit_id', '$quantity', '$alp_no', '$categorie_id', '$po_no', '$drs_no', '$crv_no', '$rate','$recieved_by', '$firm' ,'$remarks') ";
      
        $pr_qtyArray[$part_no] = $quantity;
        

}
    $db->query($sql);
    print_r($pr_qtyArray);
    
    foreach ($pr_qtyArray as $key => $val) {
      $sql1 ="UPDATE products SET quantity = (quantity + $val), rate = $rate where part_no= '$key' ";
      $db->query($sql1);
    }
    
   return true;

   }


  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM products ";
    $sql .= " WHERE item_name ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;
   $sql   = " SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM products p";
   $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product($limit){
   global $db;
   $sql  = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON p.id = s.product_id ";
   $sql .= " GROUP BY s.product_id";
   $sql .= " ORDER BY SUM(s.qty) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT i.id,i.iv_no,i.rate,i.item_demanded,i.item_issued,s.date,p.name";
   $sql .= " FROM issue i";
   $sql .= " LEFT JOIN products p ON s.product_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit){
  global $db;
  $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate issue report by two dates
/*--------------------------------------------------------------*/
function find_issue_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date+1));
  $sql  = "SELECT part_no, item_name, iv_no,rate, item_demanded, item_issued,date ";
  $sql .= " FROM issue  ";
  $sql .= " WHERE date BETWEEN '{$start_date}' AND '{$end_date}'";
 $sql .= " ORDER BY date(date) DESC";
  return $db->query($sql);
}

// generate issue report by name and date range
function find_issue_by_name($start_date,$end_date,$name){
  global $db;
  $name   = remove_junk($db->escape($_POST['item_name'])); 
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date+1));
  $sql  = "SELECT part_no, item_name, iv_no,rate, item_demanded, item_issued,date ";
  $sql .= " FROM issue  ";
  $sql .= " WHERE item_name = '$name' AND date BETWEEN '{$start_date}' AND '{$end_date}'";
 $sql .= " ORDER BY date(date) DESC";
  return $db->query($sql);
}




// generate issue report by invoice number
function find_issue_by_invoice($iv_no){
  global $db;
 $iv_no   = remove_junk($db->escape($_POST['iv_no']));  
  $sql  = "SELECT part_no, item_name, iv_no,rate, item_demanded, item_issued,date ";
  $sql .= " FROM issue  ";
  $sql .= " WHERE iv_no='$iv_no'";
  return $db->query($sql);
}


/*--------------------------------------------------------------*/
/* Function for Generate recieve report by two dates
/*--------------------------------------------------------------*/
function find_recieve_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date+1));
  $sql  = "SELECT part_no, item_name,quantity,date,rate ";
  $sql .= " FROM recieved  ";
  $sql .= " WHERE date BETWEEN '{$start_date}' AND '{$end_date}'";
 $sql .= " ORDER BY date(date) DESC";
  return $db->query($sql);
}

/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year,$month){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}

?>