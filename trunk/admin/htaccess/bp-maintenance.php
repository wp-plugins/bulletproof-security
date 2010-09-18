<?php
header('HTTP/1.1 503 Service Temporarily Unavailable',true,503);
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 259200'); 	// 3600=1hr 7200-2hrs 43200=12hrs 86400-24hrs 172800-48hrs 259200-72hrs
								// Enter the amount of time you expect your site to display under maintenance
								// This is only to tell the Search Engines when to return not the timer display

## BulletProof Pro includes an editable Flash Movie
## that you can customize by adding your own images and messages.
## You do not need the Flash software to edit the movie
## to add your own custom images and message.
## An interesting animated Flash movie will stick in visitors minds
## and will increase the liklihood of visitor return.
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- <meta name="robots" content="noindex,nofollow"> ONLY use noindex with a 503
If this is a brand new website that has not been indexed before --> 
<title>Website Temporarily Closed For Maintenance</title>
<style type="text/css">
<!--
body { 
	background-image:url(../wp-content/plugins/bulletproof-security/abstract-blue-bg.png);
	background-repeat:repeat;
	line-height: normal;
}

p {
    font-family: Verdana, Arial, Helvetica, sans-serif;
}

.maintenance {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size:18px;
}

.maintenance_table {
	border-color:#999999;
	position:absolute;
	top:50px;
	left:50px;
	padding:10px;
	background-color: #E9E9E9;
}

.online_text {font-family:Verdana, Arial, Helvetica, sans-serif;}

.lcdstyle{ /*Example CSS to create LCD countdown look*/
	background-color:black;
	color: #00FF00;
	font: bold 18px MS Sans Serif;
	padding: 3px;
}

.lcdstyle sup{ /*Example CSS to create LCD countdown look*/
	font-size: 80%
}

-->
</style>

<script type="text/javascript">

/***********************************************
* Dynamic Countdown script- © Dynamic Drive (http://www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

function cdtime(container, targetdate){
if (!document.getElementById || !document.getElementById(container)) return
this.container=document.getElementById(container)
this.currentTime=new Date()
this.targetdate=new Date(targetdate)
this.timesup=false
this.updateTime()
}

cdtime.prototype.updateTime=function(){
var thisobj=this
this.currentTime.setSeconds(this.currentTime.getSeconds()+1)
setTimeout(function(){thisobj.updateTime()}, 1000) //update time every second
}

cdtime.prototype.displaycountdown=function(baseunit, functionref){
this.baseunit=baseunit
this.formatresults=functionref
this.showresults()
}

cdtime.prototype.showresults=function(){
var thisobj=this


var timediff=(this.targetdate-this.currentTime)/1000 //difference btw target date and current date, in seconds
if (timediff<0){ //if time is up
this.timesup=true
this.container.innerHTML=this.formatresults()
return
}
var oneMinute=60 //minute unit in seconds
var oneHour=60*60 //hour unit in seconds
var oneDay=60*60*24 //day unit in seconds
var dayfield=Math.floor(timediff/oneDay)
var hourfield=Math.floor((timediff-dayfield*oneDay)/oneHour)
var minutefield=Math.floor((timediff-dayfield*oneDay-hourfield*oneHour)/oneMinute)
var secondfield=Math.floor((timediff-dayfield*oneDay-hourfield*oneHour-minutefield*oneMinute))
if (this.baseunit=="hours"){ //if base unit is hours, set "hourfield" to be topmost level
hourfield=dayfield*24+hourfield
dayfield="n/a"
}
else if (this.baseunit=="minutes"){ //if base unit is minutes, set "minutefield" to be topmost level
minutefield=dayfield*24*60+hourfield*60+minutefield
dayfield=hourfield="n/a"
}
else if (this.baseunit=="seconds"){ //if base unit is seconds, set "secondfield" to be topmost level
var secondfield=timediff
dayfield=hourfield=minutefield="n/a"
}
this.container.innerHTML=this.formatresults(dayfield, hourfield, minutefield, secondfield)
setTimeout(function(){thisobj.showresults()}, 1000) //update results every second
}

/////CUSTOM FORMAT OUTPUT FUNCTIONS BELOW//////////////////////////////

//Create your own custom format function to pass into cdtime.displaycountdown()
//Use arguments[0] to access "Days" left
//Use arguments[1] to access "Hours" left
//Use arguments[2] to access "Minutes" left
//Use arguments[3] to access "Seconds" left

//The values of these arguments may change depending on the "baseunit" parameter of cdtime.displaycountdown()
//For example, if "baseunit" is set to "hours", arguments[0] becomes meaningless and contains "n/a"
//For example, if "baseunit" is set to "minutes", arguments[0] and arguments[1] become meaningless etc

function formatresults(){
if (this.timesup==false){//if target date/time not yet met
var displaystring=arguments[0]+" days "+arguments[1]+" hours "+arguments[2]+" minutes "+arguments[3]+" seconds left until April 22, 2010 04:25:00"
}
else{ //else if target date/time met - add whatever you want here
var displaystring="<span class='online_text'>The [add your website name here] Website<br>Will Be Online In...</span>"
}
return displaystring
}

function formatresults2(){
if (this.timesup==false){ //if target date/time not yet met
var displaystring="<span class='lcdstyle'>"+arguments[0]+" <sup>days</sup> "+arguments[1]+" <sup>hours</sup> "+arguments[2]+" <sup>minutes</sup> "+arguments[3]+" <sup>seconds</sup></span>"
}
else{ //else if target date/time met
var displaystring="" //Don't display any text
alert("Countdown completed! [add your website name here] will resume normal website operation shortly.") //Instead, perform a custom alert
}
return displaystring
}
</script>
</head>

<body>
<table width="500" border="2" align="center" cellpadding="10" cellspacing="0" class="maintenance_table" id="Maintenance-Table" name="Maintenance-Table">
  <tr>
    <td>
<?php

// Display your website name with www by commenting out $hostname = str_replace... line of code below
$hostname = $_SERVER['SERVER_NAME']; 
$hostname = str_replace('www.', '', $hostname); ?>

<!-- CSS class "maintenance is in the head section on this page -->
<span class="maintenance"><?php echo $hostname; ?></span>

<p>[add your website name here] Website<br>Is Under Construction.</p>

<div id="countdowncontainer"></div>
<br />
<div id="countdowncontainer2"></div>
<p>Your IP Address is: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>

<script type="text/javascript">
// add the date and time that your website started maintenance below
var futuredate=new cdtime("countdowncontainer", "April 22, 2010 04:25:00")
futuredate.displaycountdown("days", formatresults)

var currentyear=new Date().getFullYear()
//dynamically get this Christmas' year value. If Christmas already passed, then year=current year+1
var thischristmasyear=(new Date().getMonth()>=11 && new Date().getDate()>25)? currentyear+1 : currentyear
// add the date and time that your website maintenance will be done below
// no need to add a year it is precalculated by +thischristmasyear+
var christmas=new cdtime("countdowncontainer2", "December 30, "+thischristmasyear+" 20:0:00")
christmas.displaycountdown("days", formatresults2)
</script>
</td></tr>
</table>
</body>
</html> 
