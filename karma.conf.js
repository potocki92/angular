module.exports = function (config) {
  config.set({
    basePath: "./app",

    files: ["lib/angular/angular.js"],

    autoWatch: true,
    frameworks: ["jasmine"],
    browsers: ["Chrome"],
    plugins: ["karma-jasmine", "karma-chrome-launcher"],
  });
};
