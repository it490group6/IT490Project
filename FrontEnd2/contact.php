<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
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
  <h1>Contact</h1>
<div class="topnav">
  <div class="topnav-centered">
  <a href="success.php">Home</a>
    <a href="about.php">About</a>
    <a href="search.php">Stream Search</a>
    <a href="contact.php">Contact</a>
    <a href="logout.php">Logout</a>
  </div>
</div>  

<div class="row">
  <div class="column">
    <h2>Nevin Bunag</h2>
    <body>
    	<p>email: bunag.nevin@gmail.com</p>
    	<p>Instagram: nevinbunag</p>
    	<p>Twitch: NEVI_LIVE</p>
    	
    
    </body>
  </div>
  <div class="column">
    <h3>Sabbir Khan</h3>
    <body>
    	<p>email: sabbirk1998@gmail.com</p>
    	<p>Instagram: s_khan2425</p>
    </body>
  </div>
  
  <div class="column">
  <h4>Samir Patel</h4>
    <body>
    	<p>email: patelsamir964@gmail.com</p>
    	<p>Instagram: samirpatel964</p>
    </body>
  </div>
</div>

 <div class="column">
  <h3>Geroll Vedar</h3>
    <body>
    	<p>email: Vedarg6@yahoo.com</p>
    	<p>Instagram: gvedar</p>
    	<p>Twitch: MoneyG_US</p>
    </body>
  </div>
</div>

 <div class="column">
  <h20>Zain Raza</h20>
    <body>
    	<p>email: zr38@njit.edu</p>
    	<p>Instagram: zraza_99</p>
    </body>
  </div>
</div>

</body>
</html>
