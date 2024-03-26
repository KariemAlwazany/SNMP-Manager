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
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./All System Group contents.php">All System Group contents(no system services)</a></li>
            <li><a class="dropdown-item" href="./ARP Table.php">ARP Table</a></li>
            <li><a class="dropdown-item" href="./SNMP group Statistics.php">SNMP group Statistics</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php

$deviceIP = "127.0.0.1:161";
$LocalAddress  = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.6.13.1.2");
$LocalPort  = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.6.13.1.3");
$RemoteAddress = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.6.13.1.4");
$RemotePort = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.6.13.1.5");
$ConnectionState = snmp2_walk($deviceIP, "public", ".1.3.6.1.2.1.6.13.1.1");

echo
'
<table class="table table-hover">
  <thead>
    <tr>
      <th class="head" scope="col">LocalAddress</th>
      <th class="head" scope="col" >LocalPort</th>
      <th class="head" scope="col" >RemoteAddress</th>
      <th class="head" scope="col" >RemotePort</th>
      <th class="head" scope="col" >ConnectionState</th>
    </tr>
  </thead>
  <tbody>
';
foreach ($LocalAddress as $index => $localAddress) {
    $localPort = $LocalPort[$index];
    $remoteAddress = $RemoteAddress[$index];
    $remotePort = $RemotePort[$index];
    $connectionState = $ConnectionState[$index];

    echo "<tr>
        <td>$localAddress</td>
        <td>$localPort</td>
        <td>$remoteAddress</td>
        <td>$remotePort</td>
        <td>$connectionState</td>
    </tr>";
}

echo "</table>";

?>

    </body>
</html>
