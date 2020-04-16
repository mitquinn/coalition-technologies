## Coalition Technology Coding Challenge
### By Mitchell Quinn

##### Goals: Create a very simple Laravel web application for task management: 
* Create task (info to save: task name, priority, timestamps) 
* Edit task 
* Delete task 
* Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on. 
* Tasks should be saved to a mysql table.

##### BONUS POINT: Add project functionality to the tasks. 

* User should be able to select a project from a dropdown and only view tasks associated with that project.

#### Installation

##### Prerequisites
* You will need to have docker and docker-compose installed and configured. 

##### Installation
Clone the repo to your desired location, From that location run:
* cp .env-example .env
* docker-compose up -d
* docker-compose run coalition_technologies composer install
* docker-compose run coalition_technologies npm install
* docker-compose run coalition_technologies npm run dev
 
 Next you will need to create the database. I installed Adminer for easy of access.
 * Navigate to your Docker Host Url @ port 8080. (usually http://127.0.0.1:8080)
 * Login credentials are: Server=database, user=root, password=root
 * Create a database called laravel, collation is: 	utf8_unicode_ci
 
 Finally run migrations with command:
 * docker-compose run coalition_technologies php artisan migrate
