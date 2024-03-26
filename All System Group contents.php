<?php
$flag = 0;
if(isset($_POST['submit']))
{		
$Location = $_POST['Location'];
$Contact = $_POST['Contact'];
$Name = $_POST['Name'];
$Location = snmp2_set("127.0.0.1", "public", ".1.3.6.1.2.1.1.6.0","s",$Location);
$Contact = snmp2_set("127.0.0.1", "public", ".1.3.6.1.2.1.1.4.0","s",$Contact);
$systemName = snmp2_set("127.0.0.1", "public", ".1.3.6.1.2.1.1.5.0","s",$Name);
$flag = 1;
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel=stylesheet href="./style.css">
        <title>SNMP Manager</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="./mainPage.php">SNMP Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./mainPage.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pages
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./TCP Table.php">TCP Table</a></li>
            <li><a class="dropdown-item" href="./ARP Table.php">ARP Table</a></li>
            <li><a class="dropdown-item" href="./SNMP group Statistics.php">SNMP group Statistics</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php
$deviceIP = '127.0.0.1:161';
$systemName = snmp2_get("$deviceIP", "public", ".1.3.6.1.2.1.1.5.0");
$systemName = substr($systemName,7);
$systemDescreption = snmp2_get("$deviceIP", "public", ".1.3.6.1.2.1.1.1.0");
$systemDescreption = substr($systemDescreption,7);
$systemUpTime = snmp2_get("$deviceIP", "public", ".1.3.6.1.2.1.1.3.0");
$systemUpTime = substr($systemUpTime,7);
$Location = snmp2_get("$deviceIP", "public", ".1.3.6.1.2.1.1.6.0");
$Location = substr($Location,7);
$systemOID = snmp2_get("$deviceIP", "public", ".1.3.6.1.2.1.1.2.0");
$systemOID = substr($systemOID,7);
$Contact = snmp2_get("$deviceIP", "public", ".1.3.6.1.2.1.1.4.0");
$Contact = substr($Contact,7);
?>
<table class="table table-hover">
  <thead>
    <tr>
      <th class="head" scope="col">Content</th>
      <th class="head" scope="col" >Text</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>System OID</td>
      <td><?php echo $systemOID?></td>
    </tr>
    <tr>
    <td>System Name</td>
      <td><?php echo $systemName?></td>
    </tr>
    <tr>
    <td>System Description</td>
      <td><?php echo $systemDescreption?></td>
    </tr>
    <tr>
    <td>System Location</td>
      <td><?php echo $Location?></td>
    </tr>
    <tr>
    <td>System Contact</td>
      <td><?php echo $Contact?></td>
    </tr>
    <td>System Up Time</td>
      <td><?php echo $systemUpTime?></td>
    </tr>
  </tbody>
</table>
<h3 class="title">Change system Contents</h3>
<?php
if($flag==1)
echo 'Changed Successfully';
?>
<form class="row g-3 needs-validation" novalidate method="post" action="./All System Group contents.php">
<div class="col-md-4">
    <label for="validationCustom02"  class="form-label">Name</label>
    <input type="text" name="Name" class="form-control" id="validationCustom02" required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom01"  class="form-label">Contact</label>
    <input type="text" name="Contact" class="form-control" id="validationCustom01"  required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02"  class="form-label">Location</label>
    <input type="text" name="Location" class="form-control" id="validationCustom02" required>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" name="submit" type="submit" value="submit">Submit</button>
  </div>
</form>
    </body>
</html>
