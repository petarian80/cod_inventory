<head>

<link rel="stylesheet" href="print.css" type="text/css" media="print"> 

</head>

<?php
session_start();
if(isset($_SESSION['totalcolumns']))
{     
     // print_r($_SESSION['totalcolumns']);
      $ArrayOfProducts = $_SESSION['totalcolumns']["form"];
      $invoiceNo =  $_SESSION['totalcolumns']["invoice"];
      $mission = $_SESSION['totalcolumns']["mission"];
      $unit_name = $_SESSION['totalcolumns']["unit_name"];
      $vocab_sec = $_SESSION['totalcolumns']["vocab_sec"];
      $demand_no = $_SESSION['totalcolumns']["demand_no"]; 
      // query for parent table 
      
      //  $issue = $_SESSION['totalcolumns'] ;
      

}

?>



    <from>
<div>

    <table border="1" class="collapse" >
    
       
        <tr>
    <th width="35px" height="50px" > 
       <?php 
 for($x=1 ;$x<2 ; $x++){

         echo '<span style="font-size: 32pt">' . $x . '</span>';
 } 

?>  
   </th>    
 <th width="235px" height="50px" valign="top">
        CONSIGNED TO
         <?php
         echo "</br>";
         echo "-------------------------------------------";
         echo "</br>";
          echo  ( $_SESSION['totalcolumns']["mission"]); 
                echo " , ";
                echo  ( $_SESSION['totalcolumns']["unit_name"]); 
                 ?>
        </th>
         
        <th width="435px"> ISSUE VOUCHER</th>
        <th width="125px" valign="top"> VOCAB-SEC
         <?php
         echo "</br>";
         echo "-----------------------";
         echo "</br>";
                echo  ( $_SESSION['totalcolumns']["vocab_sec"]); 
                 ?>
        </th> 
        </tr>

        <tbody>
         
                
        
        </tbody>
  
        
</table>
<table border="1" class="collapse">
        <tr>
        <th width="160px" height="50px" valign="top">DEMAND No
        <?php
         echo "</br>";
         echo "------------------------------";
         echo "</br>";
                echo  ( $_SESSION['totalcolumns']["demand_no"]); 
                 ?>
        </th>
        <th width="130px" valign="top">DATE
         <?php
         echo "</br>";
         echo "------------------------";
         echo "</br>";

        
         echo   date("Y/m/d") . "<br>";
        

         
                 ?>
        </th>
        <th width="125px" valign="top">TYPE
         <?php
         echo "</br>";
         echo "-----------------------";
         echo "</br>";
          
                 ?>
        </th>
        <th width="121px" valign="top">PRI
         <?php
         echo "</br>";
         echo "----------------------";
         echo "</br>";
        
                 ?>
        </th>
        <th width="150px" valign="top">I.V No
        <?php
         echo "</br>";
         echo "----------------------------";
         echo "</br>";
          echo  ( $_SESSION['totalcolumns']["invoice"]); 
                 ?>
        </th>
        <th width="130px" valign="top">DATE
        <?php
         echo "</br>";
         echo "------------------------";
         echo "</br>";
           echo   date("Y/m/d") . "<br>";
        
                 ?>
        </th>
        
        </tr>
        
</table>

<table border="1" class="collapse">
<tr>
        <th width="220px" height="30px" valign="top">PART No / DESIGNATION</th>
        <th width="100px" valign="top">A/U</th>
        <th width="100px" valign="top">DEMANDED</th>
        <th width="85px" valign="top">ISSUED</th>
        <th width="80px" valign="top">TO FOL</th>
        <th width="80px" valign="top">RATE</th>
        <th width="70px" valign="top">VALUE </th>
        <th width="75px" valign="top">PAC No</th>

</tr>
 <tbody>

 <?php foreach (  $ArrayOfProducts as $product):?>
              <tr>
                
                <td> <center>  <?php echo  ($product['part_no']); 
                echo "</br>";
                 ?></center>

              <center>  <?php echo  ($product['item_name']); ?> </center>
                
                </td>
                <td> <center>    <?php echo ($product['unit_id']); ?> </center> </td>
                <td>  <center>  <?php echo ($product['item_demanded']); ?> </center> </td>
                <td>  <center>  <?php echo ($product['item_issued']); ?> </center> </td>
                <td>  <center>  <?php echo ($product['to_fol']); ?> </center> </td>   
                 <td>  <center>  <?php echo ($product['rate']); ?> </center> </td> 
                <td>  <center>  <?php echo  ($product['total']); ?> </center> </td>  
                <td>  <center>  <?php echo  ($product['pac_no']); ?> </center> </td>                
               
                  
                
              </tr>
              </tr>
             <?php endforeach; 
             
 
             ?>

              
            </tbody>



</table>
</form>
 