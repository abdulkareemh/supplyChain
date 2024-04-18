Streamlining Business-to-Business Transactions

TradeMale is a web-based system designed to facilitate seamless communication and collaboration between businesses and stores. It caters to scenarios where purchase quantities fluctuate daily and prices are subject to frequent changes.

Core functionalities:

Multi-channel Communication:
Web Portal: A dedicated web portal serves as the central hub for businesses selling goods.

Mobile App: Customers can conveniently utilize a mobile app to place orders and manage purchases.

Control Panel: The system administrators leverage a control panel to oversee overall system operations.
This comprehensive approach fosters efficient communication and streamlined transactions, ultimately leading to a more positive customer experience and enhanced business relationships.
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

