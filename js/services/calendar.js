app.service('calendarService',function(configService) {
    this.get = function($scope,$http) {
	    // api url
	    var url = 'https://www.googleapis.com/calendar/v3/calendars/' + $scope.options.google_calendar_id + '/events?maxResults=4&orderBy=startTime&singleEvents=true&fields=items(description%2Cstart%2Csummary)%2Csummary&timeMin=' + $scope.date.toISOString() + '&key=' + $scope.options.google_api_key;
        // get calendar
        $http.get(url)
            .success(function(data) {
                $scope.calendarData = data;
                $scope.refreshing = false;
            })
            .error(function(data, status, headers) {
	            console.log('Error Getting Calendar Data ' + status);
                $scope.refreshing = false;
            });
    }
});