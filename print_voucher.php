<link rel="stylesheet" href="libs/css/print.css" />
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


<body>
 <?php for($x=1 ;$x<6 ; $x++){ ?>
    <from class="mainForm">
        <table class="main-table">
                <tr class="header-row">
                        <th class="header-no">  <?php echo '<span style="font-size: 32pt">' . $x . '</span>';  ?></th>    
                        <th class="header-cons" >
                                <span class="cons-top"> CONSIGNED TO </span>
                                <span class="cons-text"> <?php echo $_SESSION['totalcolumns']["mission"] . " , " . $_SESSION['totalcolumns']["unit_name"]; ?></span>                                
                        </th>   
                        <th class="header-heading"> ISSUE VOUCHER</th>
                        <th class="header-cons"> 
                                <span class="cons-top"> VOCAB-SEC </span>
                                <span class="cons-text"> <?php echo $_SESSION['totalcolumns']["vocab_sec"]; ?></span>                                
                        </th> 
                </tr>
        </table>
        <table class="main-table">
                <tr  class="header-row">
                        <th class="demand-no">
                        <span class="demand-heading"> DEMAND No</span>
                        <span class = "demand-text"><?php echo  ( $_SESSION['totalcolumns']["demand_no"]);?></span>
                        </th>
         
         
                        <th class="date" >
                        <span class="date-heading"> DATE </span>
                        <span class="date-text"><?php echo   date("Y/m/d");?> </span>
                        </th>

        
        <th class="type">
        <span class = "type-heading"> TYPE </span>
         <span class="type-text"><?php    ?>
        </th>

        <th class="pri">
        <span class="pri-heading"> PRI</span>
         <span class="pri-text"> <?php         ?>
        </th>

        <th class="invoice">
        <span class="invoice-heading"> I.V No </span>
        <span class="invoice-text"><?php  echo  ( $_SESSION['totalcolumns']["invoice"]); ?></span>
        </th>
        
        <th class="date" >
        <span class="date-heading"> DATE </span>
        <span class="date-text"><?php echo   date("Y/m/d");?> </span>
        </th>
        
        </tr>
        
</table>

<table class="main-table">
<tr>
        <th class="part-no">PART No / DESIGNATION</th>
        <th class="a-u" >A/U</th>
        <th class ="demand" >DEMANDED</th>
        <th class="demand" >ISSUED</th>
        <th class ="to-fol">TO FOL</th>
        <th class="to-fol" >RATE</th>
        <th class="value" >VALUE </th>
        <th class="value" >PAC No</th>

</tr>
 <tbody>

 <?php 
        for ( $i = 0 ; $i < 8 ; $i++){
 //foreach (  $ArrayOfProducts as $product):?>
              <tr >
                
                <td  class="table-cells">  <?php
                 //$var = ($var > 2 ? true : false);  
                 echo  ( isset($ArrayOfProducts[$i]['part_no'] ) ? $ArrayOfProducts[$i]['part_no'] : "" ); 
                echo "</br>";
                 ?>

               <?php
               echo ( isset($ArrayOfProducts[$i]['item_name'] ) ? $ArrayOfProducts[$i]['item_name'] : "" ); ?> 
                
                </td>
                <td  class="table-cells">    <?php echo ( isset($ArrayOfProducts[$i]['unit_id'] ) ? $ArrayOfProducts[$i]['unit_id'] : "" ); ?> </td>
                <td  class="table-cells">    <?php echo ( isset($ArrayOfProducts[$i]['item_demanded'] ) ? $ArrayOfProducts[$i]['item_demanded'] : "" ); ?>  </td>
                <td  class="table-cells">    <?php echo ( isset($ArrayOfProducts[$i]['item_issued'] ) ? $ArrayOfProducts[$i]['item_issued'] : "" ); ?>  </td>
                <td  class="table-cells">    <?php echo ( isset($ArrayOfProducts[$i]['to_fol'] ) ? $ArrayOfProducts[$i]['to_fol'] : "" ); ?>  </td>   
                 <td  class="table-cells">    <?php echo ( isset($ArrayOfProducts[$i]['rate'] ) ? $ArrayOfProducts[$i]['rate'] : "" ); ?>  </td> 
                <td  class="table-cells">   <?php echo  ( isset($ArrayOfProducts[$i]['total'] ) ? $ArrayOfProducts[$i]['total'] : "" ); ?>  </td>  
                <td  class="table-cells">    <?php echo  ( isset($ArrayOfProducts[$i]['pac_no'] ) ? $ArrayOfProducts[$i]['pac_no'] : "" ); ?>  </td>                
               
                  
                
              </tr>
             <?php }; 
             
 
             ?>

              
            </tbody>



</table>
</form>

<?php 
 }
?>

</body>
 