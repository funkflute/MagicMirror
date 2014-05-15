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
				left: 30%;
				top: 30%;
				bottom: 30%;
				text-align: center;
			}
			sup {
				font-size: .5em;
			}
			.light {
				opacity: .5;
			}
			table.pad td {
				padding: 3%;
			}
			.today {
    			padding: .5em;
			}
			.border-bottom {
    			border-bottom: 1px solid;
			}
			.event {
			    white-space: nowrap;
    			text-overflow: ellipsis;
			}
			.small {
    			font-size: smaller;
			}
			.large {
    			font-size: larger;
			}
		</style>
	</head>
	<body>
		<div class="top-left">
		    <h1 class="border-bottom">Mar 15</h1>
			<table width="100%" class="small">
				<tbody>
					<tr>
						<td class="date" align="right">Today</td>
						<td class="time">8:30<sup>am</sup></td>
					</tr>
					<tr>
						<td colspan="2" class="event light">Scrum Meeting</td>
					</tr>
					<tr>
						<td class="date" align="right">3/21</td>
						<td class="time">10:30<sup>pm</sup></td>
					</tr>
					<tr>
						<td colspan="2" class="event light">Party Time</td>
					</tr>
					<tr>
						<td class="date" align="right">4/2</td>
						<td class="time">11:30<sup>am</sup></td>
					</tr>
					<tr>
						<td colspan="2" class="event light">Dentist</td>
					</tr>
				</tbody>
			</table>
			
		</div>
		<div class="top-right">
			<h1>10:30<sup>am</sup></h1>
		</div>
		<div class="center">
		</div>
		<div class="bottom-right">
		    <div class="today border-bottom">
    			<div class="temp-today large">
    			    <span class="wi-day-cloudy"></span> <span class="temp-hi">65˚</span> <span class="temp-low light">45˚</span>
    			</div>
		    </div>
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