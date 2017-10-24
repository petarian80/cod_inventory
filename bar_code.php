

<?php
include 'barcode128.php';
echo '<p>'.bar128(stripcslashes($_POST['generate'])).'</p>';
?>
<button onclick="myFunction()" id="printpagebutton">Print barcode</button>

<script>
function myFunction() {

    var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
   window.save();
    window.print();
 
}
</script>


