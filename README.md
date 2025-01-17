## Setup

1. Clone the Git Repository

   Open your terminal or command prompt.
   Navigate to your desired project directory.
   Use the git clone command to clone the repository.

git clone git@github.com:rbcurzon/regsys.git

2. Install Composer Dependencies

   Laravel uses Composer for PHP dependency management.
   Navigate to your project folder.
   Run composer install to install PHP dependencies.

composer install

3. Setup .env

   Duplicate the .env.example file and rename it to .env.
   Open the .env file and set your database connection details.


4. Generate an application key.

php artisan key:generate

5. Migrate the Database

   Run database migrations to create tables.

php artisan migrate

6. Seed the Database (Optional)

   If your project has seeders, use them to populate the database with sample data.

php artisan db:seed

7. Install Node.js Dependencies (Optional)

   If your project uses JavaScript or CSS, install Node.js dependencies.

npm install
# or
yarn install

8. Compile Assets (Optional)

   Compile JavaScript and CSS assets with Laravel Mix.

npm run dev
# or
yarn dev

9. Start the Development Server

   Use Artisan or XAMPP to start the Laravel development server.

php artisan serve

Happy Coding!
