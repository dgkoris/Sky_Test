# Sky_Test

## Tested environment (tested on Windows 10):
1. PHP 7
2. Apache 2.4
3. MySQL Workbench 8.0
4. Symfony 4.1

## How to run (tested on Windows 10):
1. Clone or download the Sky_Test project.
2. Run cmd from the Sky_Test project folder.
3. From the project directory run the following commands to install the required components:

composer require symfony/web-server-bundle --dev
composer require symfony/orm-pack
composer require symfony/maker-bundle --dev

More detailed instuctions on these links:
https://symfony.com/doc/current/setup.html
https://symfony.com/doc/current/doctrine.html

4. Create the MySQL database by running the following command:

console doctrine:database:create --if-not-exists

If you have trouble creating the database using the console, then create it manually.

Name: sky_test
Port: 3306
Host: 127.0.0.1
User: root
Password: root

The following script should create the required table:

php bin/console doctrine:migrations:migrate

5. Start the server by running the following command***:

php bin/console server:start

***You can ignore the "[ERROR] This command needs the pcntl extension to run." and proceed executing the server:run immediately
(answer "yes").

5. Type http://localhost:8000 on your browser (tested on Chrome).
This should redirect you to http://localhost:8000/front_end/index.html
6. Press CONTROL-C to stop the server.

## Using the API without the frontend:

1. http://localhost:8000/ingest                       defaults to 5 minutes.
2. http://localhost:8000/ingest/{minutes}             where {minutes} is an integer.
3. http://localhost:8000/ingest_realtime              defaults to 5 minutes. WARNING: It actually takes 5 minutes to complete the script.
4. http://localhost:8000/ingest_realtime/{minutes}    where {minutes} is an integer WARNING: It actually takes {minutes} minutes to complete the script.
5. http://localhost:8000/show/{id}                    show a specific entry if its unique id is known.
6. http://localhost:8000/show/before/{timestamp}      show all entries before the {timestamp}.
7. http://localhost:8000/show/after/{timestamp}       show all entries after the {timestamp}.
8. http://localhost:8000/show/between/{from}/{to}     show all entries between the {from} and {to} timestamps.
