const mix = require("laravel-mix");

const BASE_BOWER_PATH = "resources/bower_components";

mix.js("resources/js/app.js", "js")
  .postCss("resources/css/app.css", "css")
  .copyDirectory(`${BASE_BOWER_PATH}/laravel-ui/js`, "public/js")
  .copyDirectory(`${BASE_BOWER_PATH}/laravel-ui/css`, "public/css")
  .copyDirectory(`${BASE_BOWER_PATH}/laravel-ui/fonts`, "public/fonts")
  .copyDirectory(`${BASE_BOWER_PATH}/laravel-ui/assets`, "public/assets");
