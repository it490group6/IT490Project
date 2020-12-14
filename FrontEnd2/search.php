<!DOCTYPE html>
<html lang="en">
<head>
<title>Search Stream</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

/* Style the header */
.header {
  background-color: #f1f1f1;
  padding: 20px;
  text-align: center;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 15px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }
}
</style>
</head>
<body>
<div class="header">
<h2>Stream Search</h2>
<div class="topnav">
  <div class="topnav-centered">
  <a href="success.php">Home</a>
    <a href="about.php">About</a>
    <a href="search.php">Stream Search</a>
    <a href="contact.php">Contact</a>
    <a href="logout.php">Logout</a>
  </div>
</div>
<p><br><br></p>

<form action="stream.php" method="POST">
Game: <input type="text" name="game"><br>
<input type="submit">
</form>

</body>
</html> 
