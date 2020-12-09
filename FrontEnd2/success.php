?php
$username = ($_POST['username']);
?>
<!DOCTYPE html>
<html>
<body>

<h1>Welcome Back</h1>
<input type= "button" onclick="window.location.href='http://www.pogfinder.com/about.php';"value="About" />
<input type= "button" onclick="window.location.href='http://www.pogfinder.com/search.html';"value="Search" />
<input type= "button" onclick="window.location.href='http://www.pogfinder.com/contact.php';"value="Contact" />
<h2>Looking a Streamer?<?php echo $username?> </h2>

</body>

<body>
 <picture>
  <source media="(min-width:650px)" srcset="twitch.png">
  <source media="(min-width:465px)" srcset="twitch.png">
  <img src="twitch.png" alt="Twitch" style="width:auto;">
</picture> 
 
<p id="demo"></p>

</body>
</html>










