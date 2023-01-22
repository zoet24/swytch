# Swytch - Fullstack WordPress developer task

Custom WordPress theme that displays the 50 most popular accessories from the Swytch Dev API. Design based on [Figma wireframes] (https://www.figma.com/file/q0M01nE6AGo7aIB2OaVfyn/Full-Stack-WordPress-Developer---task-design---Zoe?node-id=14%3A481&t=josd0ns2wQJop1Zs-0) provided by Swytch.

## Initial set-up

add .env and these to wp_config.php under

require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('API_USER', getenv('API_USER'));
define('API_KEY', getenv('API_KEY'));

npm install
npm run build

cd into theme folder
composer install

## Future work

- Add extra templates
