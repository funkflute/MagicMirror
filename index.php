<?php

class config {
	public static $location = 'Brooklyn, NY';
	public static $cal_url = '';
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Magic Mirror</title> 
		<style type="text/css" media="screen">
			@import url(//cdnjs.cloudflare.com/ajax/libs/weather-icons/0.0.1/css/weather-icons.css);
			* {
				margin: 0;
				padding: 0;
			}
			body {
				background: #000;
				color: #fff;
				font-family: 'Futura', sans-serif;
				text-transform: uppercase;
				letter-spacing: .1em;
			}
			h1 {
				font-weight: normal;
			}
			body > div {
				position: absolute;
				padding: 3%;
				text-align: center;
			}
			div[class^=top-] {
				top: 0;
			}
			div[class$=-right] {
				right: 0;
			}
			div[class^=bottom-] {
				bottom: 0;
			}
			div[class$=-left-] {
				left: 0;
			}
			.center {
				left: 33.333%;
				top: 33.333%;
				bottom: 33.333%;
				text-align: center;
			}
			sup {
				font-size: .5em;
			}
			.light {
				opacity: .5;
			}
			td {
				padding: 2%;
				white-space: nowrap;
			}
		</style>
	</head>
	<body>
		<div class="top-left">
			tl
		</div>
		<div class="top-right">
			<h1>10:30<sup>am</sup></h1>
			<p>Fri March 5th</p>
		</div>
		<div class="center">
		</div>
		<div class="bottom-right">
			<h1>Fri <span class="wi-day-cloudy"></span></h1>
			<div class="temp-today">
				<span class="temp-hi">65˚</span> <span class="temp-low light">45˚</span>
			</div>
			<hr/>
			<table width="100%">
				<tbody>
					<tr>
						<td align="right">Sat</td>
						<td><span class="wi-day-sunny"></span> <span class="temp-hi">78˚</span> <span class="temp-low light">65˚</span></td>
					</tr>
					<tr>
						<td align="right">Sun</td>
						<td><span class="wi-rain"></span> <span class="temp-hi">72˚</span> <span class="temp-low light">52˚</span></td>
					</tr>
					<tr>
						<td align="right">Mon</td>
						<td><span class="wi-windy"></span> <span class="temp-hi">65˚</span> <span class="temp-low light">45˚</span></td>
					</tr>
				</tbody>
			</table>
			
		</div>
		<div class="bottom-left">
			bl
		</div>
	</body>
</html>