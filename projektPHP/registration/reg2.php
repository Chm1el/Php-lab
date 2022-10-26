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
     <label>Miasto</label>
     <input type="text" name="miasto">
</div>
<div class="input-group">
     <label>Kod pocztowy</label>
     <input type="text" name="kod">
</div>
<div class="input-group">
       <label>Ulica</label>
       <input type="text" name="Ulica">
</div>
<div class="input-group">
      <label>Telefon</label>
      <input type="Number" name="tel">
</div>
<div class="input-group">
    <button type="submit" class="btn" name="reg2">Register</button>
</div>
</form>
</body>
</html>