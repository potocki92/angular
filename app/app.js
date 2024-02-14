angular.module("myApp", []).controller("MainController", function ($http) {
  var mainCtrl = this;
  mainCtrl.connected = false;
  mainCtrl.userData = [];

  mainCtrl.connectToDatabase = function () {
    $http
      .get("connect.php")
      .then(function (response) {
        console.log(response);
        mainCtrl.connected = true;
        mainCtrl.userData = response.data; // Przypisanie danych do zmiennej
      })
      .catch(function (error) {
        console.error("Error connecting to database:", error);
      });
  };
});
