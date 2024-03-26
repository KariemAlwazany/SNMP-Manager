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
            <li><a class="dropdown-item" href="./All System Group contents.php">All System Group contents(no system services)</a></li>
            <li><a class="dropdown-item" href="./TCP Table.php">TCP Table</a></li>
            <li><a class="dropdown-item" href="./SNMP group Statistics.php">SNMP group Statistics</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php

$deviceIP = "127.0.0.1:161";
$arpTable = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.4.22.1.2");
$arpMacTable = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.4.22.1.3");
$arpIfIndexTable = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.4.22.1.4");

echo
'
<table class="table table-hover">
  <thead>
    <tr>
      <th class="head" scope="col">IP Address</th>
      <th class="head" scope="col" >MAC Address</th>
      <th class="head" scope="col" >Interface Index</th>
    </tr>
  </thead>
  <tbody>
';

foreach ($arpTable as $index => $ipAddress)
{
    $macAddress = $arpMacTable[$index];
    $ifIndex = $arpIfIndexTable[$index];
    echo "<tr><td>$ipAddress</td><td>$macAddress</td><td>$ifIndex</td></tr>";
}
echo
'
</tbody>
</table>
';
?>

    </body>
</html>
