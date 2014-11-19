app.service('motionService',function() {
    this.update = function($scope,$http) {
        // get last motion time
        $http.get('motion.json')
            .success(function(data) {
                // get motion data
                $scope.motion = data;
            })
            .error(function(data) {
                console.log('Error Getting Motion Data');
            });
    }
});
