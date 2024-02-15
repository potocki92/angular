angular.module("myApp", []).controller("userCtrl", [
  "$scope",
  "$http",
  function ($scope, $http) {
    $http({
      method: "get",
      url: "display.php",
    }).then(function successCallback(response) {
      $scope.users = response.data;
    });
  },
]);
