app.service('displayService',function() {
	this.update = function($scope,$http) {
		// get last motion time
		$http.get('display.json')
			.success(function(data) {
				// if display is off, hide display
				if (data.active !== 'undefined') {
					 $scope.show_app = data.active;
					 // pass through data
					 $scope.display = data;
				}
			})
			.error(function(data) {
				console.log('Error Getting Display Motion Data');
			});
	}
});
