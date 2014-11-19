var app = angular.module('root', []);

app.controller('MagicMirror',function($scope,$http,$interval,config,weatherService,calendarService,motionService) {

	$scope.appReady = false;
    // set default location
    $scope.location = config.location;
    // weather service
    $scope.weatherService = weatherService;
    // global date
    $scope.date = new Date();

    // if we're refreshing
    $scope.refreshing = false;
    $scope.refreshMessage = 'Refreshing';

    // update time every minute
    $interval(function() {
	    $scope.date = new Date();
        $scope.time = $scope.date.getTime();
	}, 1000);

	// get the weather
    weatherService.update($scope,$http);
    // calendar service
    calendarService.get($scope,$http);

	// check for motion
    $interval(function() {
        motionService.update($scope,$http);
	}, 4000);

    // update every hour
    $interval(function() {
        $scope.refreshing = true;
        weatherService.update($scope,$http);
        calendarService.get($scope,$http);
	}, 60 * 60 * 1000);

    // reveal app
    $interval(function() {
		$scope.appReady = true
	}, 2000);
});