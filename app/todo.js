angular.module("toDoApp", []).controller("ToDoController", function () {
  var todoList = this;
  todoList.todos = [
    { text: "learn Angular", done: false },
    { text: "build an Anuglar app", done: false },
  ];

  todoList.addTodo = function () {
    todoList.todos.push({ text: todoList.todoText, done: false });
    todoList.todoText = "";

    console.log("added to");
  };

  todoList.remaining = function () {
    var count = 0;
    angular.forEach(todoList.todos, function (todo) {
      count += todo.done ? 0 : 1;
    });
    return count;
  };

  todoList.archive = function () {
    var oldTodos = todoList.todos;
    todoList.todos = [];
    angular.forEach(oldTodos, function (todo) {
      if (!todo.done) todoList.todos.push(todo);
    });
  };

  todoList.getTotalTodos = function () {
    return todoList.todos.length;
  };
});
