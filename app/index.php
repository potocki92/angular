<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>AngularJS Form Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>
<body ng-controller="myController">
    <h2>AngularJS Form</h2>
    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" ng-model="formData.name"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" ng-model="formData.email"><br><br>
        <button type="button" ng-click="submitForm()">Submit</button>
    </form>

    <div ng-if="response">
        <h3>Response from server:</h3>
        <p>Name: {{ response.name }}</p>
        <p>Email: {{ response.email }}</p>
    </div>

    <script>
        angular.module('myApp', [])
            .controller('myController', function ($scope, $http) {
                $scope.formData = {};

                $scope.submitForm = function () {
                    $http.post('process_form.php', $scope.formData)
                        .then(function (response) {
                            $scope.response = response.data;
                        })
                        .catch(function (error) {
                            console.error('Error:', error);
                        });
                };
            });
    </script>
</body>
</html>
