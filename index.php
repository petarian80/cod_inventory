<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="row">
    <div class="text-center col-sm-6">
      <img src="IMG-20171012-WA0000.png" align="centre" width="180" height="150">
      <p>CENTRAL ORDINANCE DEPOT</p>
      </div>
     
      <form method="post" action="auth.php" class="clearfix col-sm-6">
        <?php echo display_msg($msg); ?>
        <div class="form-group">

              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name= "password" class="form-control" placeholder="password">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Login</button>
        </div>
    </form>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
