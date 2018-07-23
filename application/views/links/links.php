<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($_SESSION);
 ?>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/colorpicker.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/modal.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.datetimepicker.min.css" type="text/css">
</head>
<style>
.statsbutton {background-color: #f44336; font-size: 16px;}
</style>
<body>

<?php if($_SESSION['username']!='gmac'): ?>  
<div class="container">
  <div class="header"> </div>
 
  <div class="leftlinks">

    <?php if ($_SESSION['username'] != 'Rooty' && $_SESSION['type'] != 'zeroadmin' && $_SESSION['type']!='customprovider' && $_SESSION['type']!='connection' && $_SESSION['type']!='singleauto'): ?>

    <p><strong>Time left:</strong><br />
      <p id='demo'></p>
    <p><strong>App Management</strong><br />
      <a href="<?php echo base_url(); ?>appy/menu">Menu Options</a><br />
      <a href="<?php echo base_url(); ?>appy/home">Home Screen</a><br />
      <a href="<?php echo base_url(); ?>appy/iptv">IPTV</a><br />
      <a href="<?php echo base_url(); ?>appy/kodibuilds">Kodi Builds</a><br />
      <a href="<?php echo base_url(); ?>appy/apps">Apps</a><br />
    <a href="<?php echo base_url(); ?>appy/gaming">Gaming</a></p>
    <p><strong>Uploads</strong><br />
      <a href="<?php echo base_url(); ?>appy/gaminguploads">Gaming ROMs<br /></a>
      <a href="<?php echo base_url(); ?>appy/kodiuploads">Kodi Builds</a><br />
      <a href="<?php echo base_url(); ?>appy/appsupload">Apps</a><br />
    <?php if($_SESSION['username']!='FissNew' ): ?> 
            <p><strong>IPTV</strong><br />
              <a href="<?php echo base_url(); ?>playlist/">Upload  Playlist data</a><br />
              <a href="<?php echo base_url(); ?>playlist/movies">Movies</a><br />
              <a href="<?php echo base_url(); ?>playlist/series">TV Series</a><br />
              <a href="<?php echo base_url(); ?>playlist/ls247">24/7 Shows</a><br />
              <a href="<?php echo base_url(); ?>playlist/sports">Sports</a> </p>
      <?php elseif ($_SESSION['username']=='FissNew') : ?>
            <p><strong>IPTV</strong><br />
              <a href="<?php echo base_url(); ?>playlist/movies">Movies</a><br />
              <a href="<?php echo base_url(); ?>playlist/series">TV Series</a><br />         
    <?php endif; ?>
    <p><strong>Purchases</strong><br />
      <a href="<?php echo base_url(); ?>appy/buynew">Buy IPTV Credits</a><br />
      <a href="<?php echo base_url(); ?>appy/buyvpncredits">Buy VPN Credits</a><br />
      <a href="<?php echo base_url(); ?>appy/appedit">Request App Edit</a></p>

    <?php if ($_SESSION['username']=='FissNew') : ?>
      <p><strong>IPTV Control</strong><br />
        <a href="<?php echo base_url(); ?>iptvcontrol/review">Income Review</a><br />
        <a href="<?php echo base_url(); ?>iptvcontrol/manualedit">Manual Credit Sales</a></p>  
    <?php endif; ?>

    <p><strong>User Managment</strong><br />
      <a href="<?php echo base_url(); ?>appy/messageuser">Message Users</a><br />
      <a href="<?php echo base_url(); ?>appy/ban">Ban &amp; Allow User</a><br />
      <a href="<?php echo base_url(); ?>appy/stats">App Stats</a><br />
      <a href="<?php echo base_url(); ?>appy/iptvaccess">IPTV Access</a><br />
      <a href="<?php echo base_url(); ?>appy/iptvaccessnew">IPTV Access New</a><br />    
      <a href="<?php echo base_url(); ?>appy/vpn">VPN</a></p>
    <p><strong>Update<br />
      </strong><a href="<?php echo base_url(); ?>appy/appupdate">App Update</a></p>
    <?php if($_SESSION['username']=='FissNew'): ?>
    <p><strong>Client Managment<br /></strong>
      <a href="<?php echo base_url(); ?>dashboard/lodi">Lodi</a><br />
      <a href="<?php echo base_url(); ?>dashboard/vpn">VPN</a><br />
      <a href="<?php echo base_url(); ?>dashboard/kodihub">KodiHub</a><br />
      <a href="<?php echo base_url(); ?>dashboard/appy">Appy Zone</a><br /> 
    <?php endif; ?>       
    <?php elseif ($_SESSION['username'] == 'Rooty'): ?>
      <p><strong>IPTV Control</strong><br />
        <a href="<?php echo base_url(); ?>iptvcontrol/review">Income Review</a><br />
        <a href="<?php echo base_url(); ?>iptvcontrol/manualedit">Manual Credit Sales</a></p> 
      <p><strong>User Managment</strong><br />
        <a href="<?php echo base_url(); ?>iptvcontrol/iptvaccessnew">IPTV Access New</a><br />  
    <?php elseif ($_SESSION['type'] == 'zeroadmin'): ?>
        <p id='demo'></p>
        <p><strong>App Management</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/menu">Menu Options</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/home">Home Screen</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/iptv">IPTV</a><br />
        </p>
        <p><strong>User Managment</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/iptvaccessnew">IPTV Access Auto</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/messageuser">Message Users</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/ban">Ban &amp; Allow User</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/stats">App Stats</a><br />
        <p><strong>Purchases<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/buynew">Buy IPTV Credits</a><strong><br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/buyvpncredits">VPN Credits</a><strong><br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appedit">Request App Edit</a><br />
        </p>
        <p><strong>Update<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appupdate">App Update</a>  
        </p>          
    <?php elseif ($_SESSION['type'] == 'customprovider'): ?>
        <p id='demo'></p>
        <p><strong>App Management</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/menu">Menu Options</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/home">Home Screen</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/iptv">IPTV</a><br />
        </p>
        <p><strong>IPTV</strong><br />
          <a href="<?php echo base_url(); ?>playlist/">Upload  Playlist data</a><br />
          <a href="<?php echo base_url(); ?>playlist/movies">Movies</a><br />
          <a href="<?php echo base_url(); ?>playlist/series">TV Series</a><br />
          <a href="<?php echo base_url(); ?>playlist/ls247">24/7 Shows</a><br />
          <a href="<?php echo base_url(); ?>playlist/sports">Sports</a> 
        </p>
        <p><strong>User Managment</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/iptvaccessnew">IPTV Access Auto</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/messageuser">Message Users</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/ban">Ban &amp; Allow User</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/stats">App Stats</a><br />
        </p>
        <p><strong>Purchases<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/buyvpncredits">VPN Credits</a><strong><br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appedit">Request App Edit</a><br />
        </p>
        <p><strong>Update<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appupdate">App Update</a>  
        </p>
    <?php elseif ($_SESSION['type'] == 'connection'): ?>
        <p id='demo'></p>
        <p><strong>App Management</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/menu">Menu Options</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/home">Home Screen</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/iptv">IPTV</a><br />
        </p>
        <p><strong>IPTV</strong><br />
          <a href="<?php echo base_url(); ?>playlist/">Upload  Playlist data</a><br />
          <a href="<?php echo base_url(); ?>playlist/movies">Movies</a><br />
          <a href="<?php echo base_url(); ?>playlist/series">TV Series</a><br />
          <a href="<?php echo base_url(); ?>playlist/ls247">24/7 Shows</a><br />
          <a href="<?php echo base_url(); ?>playlist/sports">Sports</a> 
        </p>
        <p><strong>User Managment</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/messageuser">Message Users</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/ban">Ban &amp; Allow User</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/stats">App Stats</a><br />
        </p>
        <p><strong>Purchases<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/buyvpncredits">VPN Credits</a><strong><br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appedit">Request App Edit</a><br />
        </p>
        <p><strong>Update<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appupdate">App Update</a>  
        </p> 
    <?php elseif ($_SESSION['type'] == 'singleauto'): ?>
        <p id='demo'></p>
        <p><strong>App Management</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/menu">Menu Options</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/home">Home Screen</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/iptv">IPTV</a><br />
        </p>
        <p><strong>IPTV</strong><br />
          <a href="<?php echo base_url(); ?>playlist/">Upload  Playlist data</a><br />
          <a href="<?php echo base_url(); ?>playlist/movies">Movies</a><br />
          <a href="<?php echo base_url(); ?>playlist/series">TV Series</a><br />
          <a href="<?php echo base_url(); ?>playlist/ls247">24/7 Shows</a><br />
          <a href="<?php echo base_url(); ?>playlist/sports">Sports</a> 
        </p>
        <p><strong>User Managment</strong><br />
          <a href="<?php echo base_url(); ?>zeroadmin/messageuser">Message Users</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/ban">Ban &amp; Allow User</a><br />
          <a href="<?php echo base_url(); ?>zeroadmin/stats">App Stats</a><br />
        </p>
        <p><strong>Purchases<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/buyvpncredits">VPN Credits</a><strong><br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appedit">Request App Edit</a><br />
        </p>
        <p><strong>Update<br />
          </strong><a href="<?php echo base_url(); ?>zeroadmin/appupdate">App Update</a>  
        </p>               
    <?php endif; ?>

  </div>
  <script>
// Set the date we're counting down to
var countDownDate = new Date(<?php printf("'%s'",date("M j, Y H:i:s",strtotime($_SESSION["expiry_date"]))); ?>).getTime();
// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
<?php else: ?>
<div class="container">
  <div class="header"> </div>
 
  <div class="leftlinks">
    <p><strong>Time left:</strong><br />
      <p id='demo'></p>
    <p><strong>User Managment</strong><br />
      <a href="<?php echo base_url(); ?>appy/iptvaccess">IPTV Access</a></p>
  </div>
  <script>
// Set the date we're counting down to
var countDownDate = new Date(<?php printf("'%s'",date("M j, Y H:i:s",strtotime($_SESSION["expiry_date"]))); ?>).getTime();
// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
<?php endif;?>