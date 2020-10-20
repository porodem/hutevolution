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
require_once 'building.php';

//get saved statistics of player (gold, wood, etc.)
$filename = 'save/mygame.json'; //file where statistics about prev game is saved
$handle = fopen($filename,'r');
$statistics = fread($handle, filesize($filename));
//print_r($statistics);
$stat = json_decode($statistics);
$buildings = [];
//get buildings classes
$hut = new Building('хижина');
?>

	<div class="container overall">
		<div id="login">
			<h1>Game</h1>
		<div id="statistics">
			<span>food: </span><span id="food"><?= $stat->food ?></span>
			<span>gold: </span><span id="gold"><?= $stat->gold ?></span>
			<span>wood: </span><span id="wood"><?= $stat->wood ?></span>
			<span>knowlege: </span><span id="knowlege"><?= $stat->knowlege ?></span>
			<span>population: </span><span id="population">0</span>
			<span>вместимость: </span><span id="capacity">0</span>
		</div>
		<div id="map">
		</div>

	<div class="dropdown">
  		<button onclick="build_options()" class="dropbtn" name="build" id="hut_btn">построить</button>
  		<div id="buildDropdown" class="dropdown-content">
    	<a href="#" onclick="alertBuild(<?= $hut->time_build . ', \'' . $hut->name . '\'' ?>)"><?= $hut->name ?></a>
    	<a href="#" onclick="alertBuild(30,'garden')">огород</a>
		</div>
  	</div>

  	<button onclick="build(10)" class="btn" name="hunting" id="do_hunt">охота</button>
	</div> стройка:
  <progress id = "build_progress" class="progress" value="0" max="10" ></progress>
  добыча:
  <progress id = "build_progress" class="progress"  value="0" max="10" ></progress>
	</div>
	
	



<script type="text/javascript">

function build_options() {
  document.getElementById("buildDropdown").classList.toggle("show");
}

let gold = document.getElementById("gold").innerHTML;
if (gold <50) {
	document.getElementById("hut_btn").style.background='#000000';
}
//document.getElementById("gold").innerHTML = gold;
let building_progress = 0;
let build_time = 0;
var intervalID;
  	
//1s version of build by click
function build() {
  //document.getElementById("attribDropdown").classList.toggle("show");
  //let beer = 0;
  gold -=50;
  if (gold <50) { //if not enough gold change button color to gray
	document.getElementById("hut_btn").style.background='#b0c4de';
}
  document.getElementById("gold").innerHTML = gold;
  let d1 = new Date();
  let d1ms = d1.getTime();
  let finish_time = d1ms + (build_time * 1000);
  //alert('building start at: ' + d1 + ' ms: ' + d1ms); //show message
  console.log(finish_time - d1ms);
  intervalID = window.setInterval(myCallback, 500, );
}

function myCallback() {
	building_progress += (10 / build_time);
	console.log(building_progress);
	if(building_progress > 10) {
		building_progress = 0; //if building complete set progress bar to zero.
		clearInterval(intervalID); // stop timer interval
	} 
	document.getElementById("build_progress").value = building_progress;
	
}

function alertBuild(time, building_name) {
	let isConfirmed = confirm('Простейшее жилище\r\nлес 5 | силы 10 | знания 1 | вместимость 5\r\nПостроить хижину?');
	build_time = time;
	if(isConfirmed) {
		build();
	} else {
		//nothing
	}
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }    
  }
  
}

</script>
</div>
</body>
</html>