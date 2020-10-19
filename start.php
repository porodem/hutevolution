<!DOCTYPE html>
<html>
<head>
	<title>Civilization TW</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="style/main.css">
	<meta charset="utf-8">
</head>
<body>

<?php
//get saved statistics of player (gold, wood, etc.)
$filename = 'save/mygame.json';
$handle = fopen($filename,'r');
$statistics = fread($handle, filesize($filename));
//print_r($statistics);
$stat = json_decode($statistics);
?>

	<div class="container overall">
		<div id="login">
			<h1>Game</h1>
		<div id="statistics">
			<span>gold: </span><span id="gold"><?= $stat->gold?></span>
			<span>wood: </span><span id="wood"><?= $stat->wood?></span>
			<span>knowlege: </span><span id="knowlege"><?= $stat->knowlege ?></span>
			<span>population: </span><span id="population">0</span>
		</div>
		<div id="map">
		</div>
	<div class="dropdown">
  	<button onclick="build(10)" class="btn" name="build">построить</button>
	</div>
  <progress id = "build_progress" value="0" max="10" ></progress>
	</div>
</div>



<script type="text/javascript">

let gold = document.getElementById("gold").innerHTML;
//document.getElementById("gold").innerHTML = gold;
let building_progress = 0;
var intervalID;
  	
function build(build_time) {
  //document.getElementById("attribDropdown").classList.toggle("show");
  //let beer = 0;
  gold -=50;
  document.getElementById("gold").innerHTML = gold;
  let d1 = new Date();
  let d1ms = d1.getTime();
  let finish_time = d1ms + (build_time * 1000);
  //alert('building start at: ' + d1 + ' ms: ' + d1ms); //show message
  console.log(finish_time - d1ms);
  intervalID = window.setInterval(myCallback, 500, );
}

function myCallback() {
	building_progress++;
	console.log(building_progress);
	if(building_progress > 10) {
		building_progress = 0; //if building complete set progress bar to zero.
		clearInterval(intervalID); // stop timer interval
	} 
	document.getElementById("build_progress").value = building_progress;
	
}

</script>
</div>
</body>
</html>