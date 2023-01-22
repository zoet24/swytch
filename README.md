# swytch

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
