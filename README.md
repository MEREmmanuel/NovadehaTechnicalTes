# Laravel NovadehaTechnicalTest Setup

## Prerequisites

Make sure you have the following installed:

- PHP ^8.2
- Composer
- MySQL or any other preferred database

## Installation

1. **Clone the repository**

   ```sh
   git clone https://github.com/MEREmmanuel/NovadehaTechnicalTes
   cd NoVadehaTechnicalTes
   ```

2. **Install dependencies**

   ```sh
   composer install
   npm install
   ```

3. **Copy the environment file and configure it**

   ```sh
   cp .env.example .env
   ```

   Edit the `.env` file and configure the database settings.

4. **Run migrations**

   ```sh
   php artisan migrate
   ```

5. **Generate the application key**

   ```sh
   php artisan passport:keys
   ```
   
   ```sh
   php artisan passport:client --personal
   ```

6. **Run the development server**

   ```sh
   php artisan serve
   ```

## API Documentation

This project uses `l5-swagger` for API documentation. To generate the documentation, run:

```sh
php artisan l5-swagger:generate
```

Access the API docs at:

```
http://127.0.0.1:8000/api/documentation
```