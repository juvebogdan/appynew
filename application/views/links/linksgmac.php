<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($_SESSION);
 ?>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
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