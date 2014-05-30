<!DOCTYPE html>
<html lang="en" ng-app="root">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Magic Mirror</title> 
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
		<style type="text/css" media="screen">
			@import url(//cdnjs.cloudflare.com/ajax/libs/weather-icons/0.0.1/css/weather-icons.css);
			@import url(//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.css);
			* {
				margin: 0;
				padding: 0;
				font-size: 1em;
			}
			body {
				background: #000 no-repeat;
				color: #fff;
				font-family: 'Futura', sans-serif;
				text-transform: uppercase;
				letter-spacing: .1em;
			}
			body.horror {
    			background-image: url(http://3.bp.blogspot.com/-5Iauwxr70js/UYw2evCyOkI/AAAAAAAAA2c/U4vX7Z9Ab1M/s1600/SkullEye.jpg);
    			background-size: 50%;
			}
			body > div {
				position: absolute;
				padding: 3%;
				text-align: center;
			}
			table {
    			width: 100%;
    			border-collapse: collapse;
			}
			div[class*=-right] {
				right: 0;
			}
			div[class*=-left] {
				left: 0;
			}
			div[class*=top-] {
				top: 0;
			}
			div[class*=bottom-] {
				bottom: 0;
			}
			div[class*=-center] {
				left: 0;
				right: 0;
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
			table.padding td {
				padding: .25em;
			}
			.border-bottom {
    			border-bottom: 1px solid;
			}
			.event {
			    white-space: nowrap;
    			text-overflow: ellipsis;
			}
			.lighter {
				opacity: .65;
			}
			.lightest {
				opacity: .4;
			}
			.smaller {
    			font-size: .85em;
			}
			.smallest {
    			font-size: .5em;
			}
			.largest {
    			font-size: 3em;
			}
			.larger {
    			font-size: 2em;
			}
			.padding-bottom {
    		    padding-bottom: .5em;	
			}
			.margin-bottom {
    		    margin-bottom: .5em;	
			}
            .fa {
                position: relative;
                top: -1px;
            }
            .ng-show {
            }
            .refresh {
                -webkit-animation: pulse 1.5s infinite;
            }
            @-webkit-keyframes pulse {
                0%, 100% {
                    opacity: 0;
                }
                50% {
                    opacity: 1;
                }
            }
            .debug {
                outline: 1px green solid;
            }
		</style>
	</head>
	<body ng-controller="MagicMirror">
		<div class="top-center refresh" ng-show="refreshing">
		    <div class="larger lightest"><i class="fa fa-refresh fa-spin"></i></div>
		</div>
		<div class="larger top-left">
			<i class="fa fa-clock-o"></i>{{time | date: 'h:m' }}<sup>{{time | date: 'a' }}</sup>
		</div>
		<div class="larger top-right">
            <i class="fa fa-calendar-o"></i> {{time | date: 'MMM d' }}
		</div>
		<div class="bottom-right" ng-show="showWeather">
		    <div class="today padding-bottom margin-bottom border-bottom">
    			<div class="temp-today larger">
    			    <i class="{{getWeatherIcon(today.weather[0].description)}}"></i>
    			    <span class="temp-hi">{{today.temp.max | number: 0}}˚</span>
    			    <span class="temp-low lighter smaller">{{today.temp.min | number: 0}}˚</span>
    			</div>
		    </div>
			<table class="padding">
				<tbody ng-repeat="day in forecast">
					<tr>
						<td align="right">{{ day.dt * 1000 | date: 'EEE'}}</td>
						<td><i class="{{getWeatherIcon(day.weather[0].description)}}"></i></td>
						<td class="temp-hi">{{day.temp.max | number: 0}}˚</td>
						<td class="temp-low lighter">{{day.temp.min | number: 0}}˚</td>
					</tr>
				</tbody>
			</table>
			
		</div>
		<div class="bottom-left">
		    <div class="border-bottom padding-bottom margin-bottom"><i class="fa fa-check-square"></i> Calendar</div>
			<table class="smaller">
				<tbody>
					<tr>
						<td class="event lighter">Scrum Meeting</td>
					</tr>
					<tr>
						<td class="date lightest padding-bottom">Today @ 8:30<sup>am</sup></td>
					</tr>
					<tr>
						<td class="event lighter">Party Time</td>
					</tr>
					<tr>
						<td class="date lightest padding-bottom">3/21 @ 10:30<sup>pm</sup></td>
					</tr>
					<tr>
						<td class="event lighter">Dentist</td>
					</tr>
					<tr>
						<td class="date lightest">4/2 @ 11:30<sup>am</sup></td>
					</tr>
				</tbody>
			</table>
		</div>
		<script type="text/javascript">
			angular.module('root', [])
			    .controller('MagicMirror',function($scope,$http,clock) {
			        // set date/time
			        $scope.time = clock.getTime();
			        // if we're refreshing
			        $scope.refreshing = false;
			        // weather
			        $scope.showWeather = false;
			        $scope.getWeatherIcon = function(desc) {
			            switch(desc) {
                            //Thunderstorm
                            case 'thunderstorm with light rain':
                            case 'thunderstorm with rain':
                            case 'thunderstorm with heavy rain':
                            case 'light thunderstorm':
                            case 'thunderstorm':
                            case 'heavy thunderstorm':
                            case 'ragged thunderstorm':
                            case 'thunderstorm with light drizzle':
                            case 'thunderstorm with drizzle':
                            case 'thunderstorm with heavy drizzle':
                                return 'wi-thunderstorm';
                            break;

                            //Drizzle
                            case 'light intensity drizzle':
                            case 'drizzle':
                            case 'heavy intensity drizzle':
                            case 'light intensity drizzle rain':
                            case 'drizzle rain':
                            case 'heavy intensity drizzle rain':
                            case 'shower drizzle':
                                return 'wi-sprinkle';
                            break;

                            //Rain
                            case 'light rain':
                            case 'moderate rain':
                            case 'light intensity shower rain':
                            case 'shower rain':
                                return 'wi-showers';
                            break;

                            case 'heavy intensity rain':
                            case 'very heavy rain':
                            case 'extreme rain':
                                return 'wi-rain-wind';
                            break;

                            case 'heavy intensity shower rain':
                                return 'wi-rain';
                            break;

                            //Snow
                            case 'freezing rain':
                            case 'shower snow':
                            case 'sleet':
                                return 'wi-rain-mix';
                            break;

                            case 'light snow':
                            case 'snow':
                            case 'heavy snow':
                                return 'wi-snow';
                            break;

                            //Atmosphere
                            case 'mist':
                            case 'smoke':
                            case 'haze':
                            case 'Sand/Dust Whirls':
                            case 'Fog':
                                return 'wi-fog';
                            break;

                            //Clouds
                            case 'sky is clear':
                                return 'wi-day-sunny';
                            break;

                            case 'few clouds':
                            case 'scattered clouds':
                            case 'broken clouds':
                            case 'overcast clouds':
                                return 'wi-day-sunny-overcast';
                            break;

                            //Extreme
                            case 'tornado':
                            case 'tropical storm':
                            case 'hurricane':
                            case 'cold':
                            case 'hot':
                            case 'windy':
                            case 'hail':

    			            break;
			            }
			        };
			        // get weather
			        $http.get('//api.openweathermap.org/data/2.5/forecast/daily?units=imperial&cnt=5&q=brielle,nj')
			            .success(function(data) {
			                // get today's weather
    			            $scope.today = data.list.shift();
    			            // get + days weather
    			            $scope.forecast = data.list;
    			            // show weather
                            $scope.showWeather = true;
			            })
			            .error(function(data) {
    			            console.log('Error Getting Weather Data');
			            });
			    })
                .factory('clock', function() {
                    return {
                        getTime: function() {
                            var d = new Date();
                            return d.getTime();
                        }
                    }
                });

		</script>
	</body>
</html>