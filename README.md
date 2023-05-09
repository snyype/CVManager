# CVManager

CVManager is a web application built with Laravel that allows HR and Admins to Shortlist, Hire, Send offer letter to users email and assign task to user online.

## Installation

To install CVManager, follow these steps:

1. Clone the repository:
git clone https://github.com/snyype/CVManager.git


2. Install the dependencies:
  ```ruby
cd CVManager
composer install
```

3. Copy the .env.example file to .env and configure your environment variables:
```ruby
cp .env.example .env
```

4. Generate an application key:
```ruby
php artisan key:generate
```

5. Run the database migrations:
```ruby
php artisan migrate
```

6. Start the development server:
```ruby
php artisan serve
```

## Usage

To use CVManager, open your web browser and go to http://localhost:8000. From there, you can create a new account or log in to an existing account.

Once you're logged in, you can create a new CV, add sections to your CV, and fill in the details for each section. You can also edit and delete your CVs as needed.

## Contributing

If you would like to contribute to CVManager, please open a pull request with your changes.

## License

CVManager is open source software licensed under the MIT license.```








