make a api for user and products using repository pattern

Technologies Used

Laravel
MySQL

Setup Instructions

Clone the repository:

  git clone https://github.com/abdulkareemh/supplyChain.git

Navigate to the project directory:

  cd project-directory

Install dependencies:

  composer install

Create a .env file by copying the .env.example file:

  cp .env.example .env

Generate an application key:

  php artisan key:generate

Configure your database settings in the .env file.

Run database migrations to create tables:

  php artisan migrate 

Serve the application:

  php artisan serve

Access the application in your browser at http://localhost:8000.



License

MIT License

