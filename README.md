# Simple Blog System Laravel Application

This repository contains a simple blog system application.

## Installation

Follow these steps to install and run the application locally:

1. **Clone the Repository:**
   ```
   git clone https://github.com/janiszakis03/simple-blog-system
   ```

2. **Install Composer Dependencies:**
   ```
   cd simple-blog-system
   composer install
   ```

3. **Create Environment File:**
   ```
   cp .env.example .env
   ```

4. **Generate Application Key:**
   ```
   php artisan key:generate
   ```

5. **Set Up the Database:**
   - Configure your `.env` file with your database connection details.
   - Create a new database for the application.

6. **Run Database Migrations:**
   ```
   php artisan migrate
   ```

7. **Run Database Seeders (Optional):**
   If you want to populate the database with sample data, you can run seeders:
   ```
   php artisan db:seed
   ```

8. **Serve the Application:**
   ```
   php artisan serve
   ```

9. **Compile Assets:**
   Compile CSS and JavaScript assets:
   ```
   npm run dev
   ```

10. **Serve the Application:**
   ```
   php artisan serve
   ```

11. **Access the Application:**
   Open your web browser and navigate to `http://127.0.0.1:8000`.

## Dependencies

- PHP
- Composer
- Node.js
- NPM
- Laravel
- Laravel Breeze

## Contributing

Contributions are welcome! Please follow the [Contribution Guidelines](CONTRIBUTING.md).

## License

This project is licensed under the [MIT License](LICENSE).