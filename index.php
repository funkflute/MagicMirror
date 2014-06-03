<!DOCTYPE html>
<html lang="en" ng-app="root">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Magic Mirror</title> 
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script>
        <script src="js/app.js"></script>
		<link rel="stylesheet" href="styles.css" type="text/css" media="screen" />
	</head>
	<body ng-controller="MagicMirror">
		<div class="top-center middle refresh" ng-show="refreshing">
		    <div class="larger lightest"><i class="fa fa-refresh fa-spin"></i></div>
		    <div class="lightest" ng-bind="refreshMessage"></div>
		</div>
		<div class="larger top-left">
			<i class="fa fa-clock-o"></i> {{time | date: 'h:mm' }}<sup>{{time | date: 'a' }}</sup>
		</div>
		<div class="larger top-right">
            <i class="fa fa-calendar-o"></i> {{time | date: 'MMM d' }}
		</div>
		<div class="bottom-right">
		    <div class="today padding-bottom margin-bottom border-bottom">
			    <div class="lightest">{{location}}</div>
    			<div class="temp-today larger">
    			    <i class="{{weatherService.getIcon(today.weather[0].description)}}"></i>
    			    <span class="temp-hi">{{today.temp.max | number: 0}}˚</span>
    			    <span class="temp-low lighter smaller">{{today.temp.min | number: 0}}˚</span>
    			</div>
		    </div>
			<table class="padding">
				<tbody ng-repeat="day in forecast">
					<tr>
						<td align="right">{{ day.dt * 1000 | date: 'EEE'}}</td>
						<td><i class="{{weatherService.getIcon(day.weather[0].description)}}"></i></td>
						<td class="temp-hi">{{day.temp.max | number: 0}}˚</td>
						<td class="temp-low lighter">{{day.temp.min | number: 0}}˚</td>
					</tr>
				</tbody>
			</table>
			
		</div>
		<div class="bottom-left">
		    <div class="border-bottom padding-bottom margin-bottom lighter"><i class="fa fa-check-square"></i> Calendar</div>
			<table class="smaller">
				<tbody>
					<tr ng-repeat-start="event in calendarData">
						<td class="event truncate">{{event.title}}</td>
					</tr>
					<tr ng-repeat-end>
						<td class="date lighter padding-bottom">{{event.date_start * 1000 | date: 'EEE MMM d @ h:mm a' }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>