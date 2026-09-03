# Vibraze

Vibraze is a Laravel web application for discovering rock and metal bands. Users can search and filter bands by genre, manage a favorites list, and maintain their profile.

The project was developed for the Web Server Programming course and is currently under active development.

## Features

- Search bands by name.
- Filter bands by genre.
- Add and remove bands from a personal favorites list.
- Calculate the user's favorite genre from their favorite bands.
- Register, authenticate, and edit a user profile.
- Switch between light and dark themes.
- Responsive interface for desktop and mobile devices.

## Planned Features

- Chat rooms and groups.
- Public user profiles.
- User feedback and reviews.
- Additional interface improvements.

## Technology Stack

- [Laravel 12](https://laravel.com/) and PHP 8.2 or newer.
- [Laravel Fortify](https://laravel.com/docs/fortify) for authentication workflows.
- Blade templates.
- [Tailwind CSS 4](https://tailwindcss.com/) through Vite.
- [Vite 6](https://vite.dev/) for frontend asset bundling.
- MySQL or another Laravel-supported relational database.

## Requirements

- PHP 8.2 or newer with the required Laravel extensions.
- Composer.
- Node.js and npm.
- A running MySQL database, or another database supported by Laravel.

## Installation and Startup

Run the following steps from the project root.

1. Install the PHP dependencies:

	```bash
	composer install
	```

2. Install the frontend dependencies:

	```bash
	npm install
	```

3. Create the local environment file. On PowerShell, use:

	```powershell
	Copy-Item .env.example .env
	```

	On macOS or Linux, use:

	```bash
	cp .env.example .env
	```

4. Generate the application encryption key:

	```bash
	php artisan key:generate
	```

5. Configure the database connection in `.env`. For a typical MySQL setup, set `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` and verify the host and port values.

6. Create the database schema and load the default seed data:

	```bash
	php artisan migrate --seed
	```

7. Create the public storage link used by uploaded files:

	```bash
	php artisan storage:link
	```

8. Start the development processes:

	```bash
	composer run dev
	```

	This starts the Laravel server, Vite, the queue listener, and Laravel Pail. The application is available at `http://localhost:8000`.

To run only the application server and frontend bundler separately, use two terminals:

```bash
php artisan serve
npm run dev
```

## Testing

Run the automated test suite with:

```bash
php artisan test
```

## Screenshots

- Landing Page

![image](https://github.com/user-attachments/assets/b6481459-4712-498a-8e06-2fef1a061463)

- Bands
  
![image](https://github.com/user-attachments/assets/6008531e-c5a5-46b7-98aa-98bddb365e0f)

- Favorites

![image](https://github.com/user-attachments/assets/38d04969-69cf-4f37-a691-7f2aaf509e8b)

- Profile

![image](https://github.com/user-attachments/assets/bbbfc6b1-6be0-4cdf-86ef-fd367659dfd7)

## Author

Leonardo de Jesus Pires


