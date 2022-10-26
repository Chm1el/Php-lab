<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
</head>
<style>
    <?php include "style.css" ?>
</style>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>

  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	   <label>Imię</label>
  	   <input type="text" name="imie">
  	</div>
  	<div class="input-group">
      <label>Nazwisko</label>
      <input type="text" name="nazwisko">
    </div>
    <div class="input-group">
         <label>Miasto</label>
         <input type="text" name="miasto">
    </div>
    <div class="input-group">
         <label>Kod pocztowy</label>
         <input type="text" name="kod">
    </div>
    <div class="input-group">
           <label>Ulica</label>
           <input type="text" name="ulica">
    </div>
    <div class="input-group">
          <label>Telefon</label>
          <input type="Number" name="tel">
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>