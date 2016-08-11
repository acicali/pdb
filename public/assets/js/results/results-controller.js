angular
.module('Results')
.controller('ResultsController', [
    '$q',
    '$scope',
    'Grid',
function(
    $q,
    $scope,
    Grid
){
    $scope.results = $q.when([{
        fruit: 'apples'
    }, {
        fruit: 'bananas'
    }, {
        fruit: 'oranges'
    }]);
    var resultsGrid = Grid.from($scope.results, 'results');
}]);
