app.service('calendarService',function(config) {
    this.get = function($scope,$http) {
        // get calendar
        $http.get('https://www.googleapis.com/calendar/v3/calendars/' + config.google_calendar_id + '/events?maxResults=4&orderBy=startTime&singleEvents=true&fields=items(description%2Cstart%2Csummary)%2Csummary&key=' + config.google_api_key)
            .success(function(data) {
	            console.log(data);
                $scope.calendarData = data;
                $scope.refreshing = false;
            })
            .error(function(data, status, headers, config) {
	            console.log('Error Getting Calendar Data ' + status);
                $scope.refreshing = false;
            });
    }
});