var app = angular.module('root', []);

app.controller('MagicMirror',function($scope,$http,$interval,configService,weatherService,calendarService,displayService) {

    // refreshing
    $scope.refreshing = true;
    $scope.refreshMessage = 'Loading';

	// get config file
	configService.load($scope,$http);

	// init after we get config
	$scope.start = function(options) {

		// set options
		$scope.options = options;
	    // global date
	    $scope.date = new Date();
	    // update time every minute
	    $interval(function() {
		    $scope.date = new Date();
	        $scope.time = $scope.date.getTime();
		}, 1000);

	    // weather service
		$scope.weatherService = weatherService;

		// get the weather
	    weatherService.update($scope,$http);
	    // calendar service
	    calendarService.get($scope,$http);

	    // update services every hour
	    $interval(function() {
	        $scope.refreshing = true;
	        weatherService.update($scope,$http);
	        calendarService.get($scope,$http);
		}, options.service_refresh * 60 * 1000);

		// check for motion
	    $interval(function() {
	        displayService.update($scope,$http);
		}, 4000);

		// show our app
		$scope.show_app = true;
	}

});