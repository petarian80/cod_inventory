<?php
  $page_title = 'Print Barcode';
  require_once('includes/load.php');
 
?>

<?php
include 'barcode128.php';
echo '<p>'.bar128(stripcslashes($_POST['generate'])).'</p>';
?>
<button onclick="myFunction()" id="printpagebutton" class="btn btn-danger">Print barcode</button>

<script>
function myFunction() {

    var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
   
    window.print();
 
}
</script>


