app.service('weatherService',function() {
    // show wi icon depending on desciption we get back
    this.getIcon = function(desc) {
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
                    return 'wi-tornado';
                break;
                case 'tropical storm':
                case 'hurricane':
                    return 'wi-hurricane';
                break;
                case 'cold':
                case 'hot':
                case 'windy':
                    return 'wi-windy';
                break;
                case 'hail':
                    return 'wi-hail';
                break;
            }
        };

    // update our scope with weather
    this.update = function($scope,$http) {
        // get weather
        $http.get('http://api.openweathermap.org/data/2.5/forecast/daily?units=imperial&cnt=5&q=' + $scope.options.location)
            .success(function(data) {
	            if (data.list) {
	                // get today's weather
	                $scope.today = data.list.shift();
	                // get + days weather
	                $scope.forecast = data.list;
				}
                $scope.refreshing = false;
            })
            .error(function(data) {
                console.log('Error Getting Weather Data');
                $scope.refreshing = false;
            });
    }
});
