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
            <li><a class="dropdown-item" href="./ARP Table.php">ARP Table</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
$namesWalk = array(
  '1' => 'snmpInPkts',
  '2' => 'snmpOutPkts',
  '3' => 'snmpInBadVersions',
  '4' => 'snmpInBadCommunityNames',
  '5' => 'snmpInBadCommunityUses',
  '6' => 'snmpInASNParseErrs',
  '7' => 'snmpInTooBigs',
  '8' => 'snmpInNoSuchNames',
  '9' => 'snmpInBadValues',
  '10' => 'snmpInReadOnlys',
  '11' => 'snmpInGenErrs',
  '12' => 'snmpInTotalReqVars',
  '13' => 'snmpInTotalSetVars',
  '14' => 'snmpInGetRequests',
  '15'=> 'snmpInGetNexts',
  '16' => 'snmpInSetRequests',
  '17' => 'snmpInGetResponses',
  '18' => 'snmpInTraps',
  '19' => 'snmpOutTooBigs',
  '20' => 'snmpOutNoSuchNames',
  '21' => 'snmpOutBadValues',
  '22' => 'snmpOutGenErrs',
  '23' => 'snmpOutGetRequests',
  '24' => 'snmpOutGetNexts',
  '25' => 'snmpOutSetRequests',
  '26' => 'snmpOutGetResponses',
  '27' => 'snmpOutTraps',
  '28' => 'snmpEnableAuthenTraps',
);
$namesGet = array(
  '1' => 'snmpInPkts',
  '2' => 'snmpOutPkts',
  '3' => 'snmpInBadVersions',
  '4' => 'snmpInBadCommunityNames',
  '5' => 'snmpInBadCommunityUses',
  '6' => 'snmpInASNParseErrs',
  '8' => 'snmpInTooBigs',
  '9' => 'snmpInNoSuchNames',
  '10' => 'snmpInBadValues',
  '11' => 'snmpInReadOnlys',
  '12' => 'snmpInGenErrs',
  '13' => 'snmpInTotalReqVars',
  '14' => 'snmpInTotalSetVars',
  '15' => 'snmpInGetRequests',
  '16'=> 'snmpInGetNexts',
  '17' => 'snmpInSetRequests',
  '18' => 'snmpInGetResponses',
  '19' => 'snmpInTraps',
  '20' => 'snmpOutTooBigs',
  '21' => 'snmpOutNoSuchNames',
  '22' => 'snmpOutBadValues',
  '24' => 'snmpOutGenErrs',
  '25' => 'snmpOutGetRequests',
  '26' => 'snmpOutGetNexts',
  '27' => 'snmpOutSetRequests',
  '28' => 'snmpOutGetResponses',
  '29' => 'snmpOutTraps',
  '30' => 'snmpEnableAuthenTraps',
);
echo
'
</head>
<table class="outer-table">
<tr>
  <td>
    <table class="inner-table">
    <thead>
    by walk method
    </thead>
';
for($i=1 ; $i<29 ; $i++)
{
  if($i == 7)
    continue;
  if($i == 23)
    continue;
$SNMP_arr = snmp2_walk("127.0.0.1:161", "public", "1.3.6.1.2.1.11.$i");
echo "'<tr><td>$i</td><td>'".$namesWalk[$i]."'</td><td>'".$SNMP_arr[0]."'</td></tr>'";
}
echo
'
</table>
</td>
';
echo 
'
<td>
<table class="inner-table">
<thead>
<br><br>
by get method
</thead>
';
  
for($i=1 ; $i<31 ; $i++)
{
  if($i == 7)
    continue;
  if($i == 23)
    continue;
$SNMP = snmp2_get("127.0.0.1:161", "public", "1.3.6.1.2.1.11.$i.0");
echo "'<tr><td>$i</td><td>'".$namesGet[$i]."'</td><td>'".$SNMP."'</td></tr>'";
}
echo 
'
</table>
</td>
</tr>
';
?>

    </body>
</html>
