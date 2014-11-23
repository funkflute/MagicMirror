app.service('configService',function() {

	options = this.options = {};
	
	this.get = function(option) {
		return this.options[option];
	}

    this.load = function($scope,$http) {
		// get calendar
		$http.get('config.json')
			.success(function(data) {
				$scope.start(data);
			})
			.error(function(data, status, headers) {
				console.log('Error Getting Config File');
			});
	}

});
