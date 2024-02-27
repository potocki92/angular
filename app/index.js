angular
  .module("crudApp", [])
  .controller("todosController", function ($scope, $http) {
    $scope.todos = [];
    $scope.tempTodosData = {};
    const URL = "http://localhost:63342/angular/app/display.php";

      $scope.getRecords = () => {
          $http
              .get(URL, {
                  params: {
                      type: "view",
                  },
              })
              .then(function (response) {
                  console.log("Data received from database:", response.data);
                  if (response.data.status == "OK") {
                      $scope.todos = response.data.records;
                  }
              })
              .catch(function (error) {
                  console.error("Error fetching data from database:", error);
              });
      };

    $scope.saveTodo = (type) => {
      let data = $.param({ data: $scope.tempTodosData, type: type });
      let config = { headers: { "Content-Type": "application/json" } };

      $http
        .post(URL, data, config)
        .success(function (response) {
          if (response.status == "OK") {
              if (type == "edit") {
              $scope.todos[$scope.index] = angular.copy($scope.tempTodosData);
            } else {
              $scope.todos.push(response.data.data);
            }

            $scope.todoForm.$setPristine();
            $scope.tempTodosData = {};
            $(".formData").slideUp();

            console.log("Success");
          } else {
            console.log("Error:", response.data);
          }
        })
        .catch(function (error) {
          console.error("Error saving todo:", error);
        });
    };

    $scope.addTodo = () => {
      $scope.saveTodo("add");
    };

    $scope.editTodo = (index) => {
      $scope.tempTodosData = angular.copy($scope.todos[index]);
      $scope.index = index;
    };

    $scope.updateTodo = () => {
      $scope.saveTodo("edit");
    };
    $scope.deleteTodo = () => {
      console.log("DELETE");
    };
  });
