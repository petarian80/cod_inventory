<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  
 
?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_user          = count_by_id('users');
 $c_mission          = count_by_id('mission');
 $c_unit          = count_by_id('army_units');

?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="fa fa-user" aria-hidden="true"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted">Users</p>
        </div>
       </div>
    </div>
    <div class="col-md-4" >
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
      <i class="fa fa-tasks" aria-hidden="true"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">Categories</p>
        </div>
       </div>
    </div>
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_product['total']; ?> </h2>
          <p class="text-muted">Products</p>
        </div>
       </div>
    </div>
  </div>
  
  
  <div class="row">
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
        <i class="fa fa-globe" aria-hidden="true"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_mission['total']; ?> </h2>
          <p class="text-muted">Missions</p>
        </div>
       </div>
    </div>
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
<i class="fa fa-university" aria-hidden="true"></i>        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_unit['total']; ?> </h2>
          <p class="text-muted">Units</p>
        </div>
       </div>
    </div>
  </div>

<?php
  global $db;



  

$query = " SELECT  user_level, sum(id) FROM users group by user_level ";
$res =$db->query($query);



?>





<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['id', 'user_level' ],
         <?php
		 while($row=$res->fetch_assoc())
		 {
		 
		 echo "['" .$row['user_level']."',".$row['sum(id)']."],";
		 
		 }
		 ?>
        ]);

        var options = {
          title: 'User Details'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>



<?php include_once('layouts/footer.php'); ?>
