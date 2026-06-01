
# BiblioSys
### A book catalog management system for libraries, with book lending system and news blog.

---
## About BiblioSys

BiblioSys is a web-based book catalog management system aimed to optimize the organization, access and control of bibliographic material in physical libraries. Its purpose is to support staff in the efficient management of loans and book classification, while offering users a modern experience through a digital catalog. BiblioSys arises as a response to the limitations of traditional manual book management methods, seeking to modernize and facilitate the use of library resources for the entire community.

This system not only aims to be a practical book catalog management system, but also a web platform where the library can promote itself, expanding the library's audience and promoting its events and services.

This project is being developed in Laravel PHP framework.

## Installation

1. Clone the GitHub repository:

```bash
git clone https://github.com/<owner>/bibliosys.git
cd bibliosys
```

2. Install PHP dependencies:

```bash
composer install
```

3. Create and configure the environment file:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database and application settings, for example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bibliosys
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

4. Run database migrations and seeders:

```bash
php artisan migrate --seed
```

5. Ensure writable permissions for storage and cache:

```bash
chmod -R 775 storage bootstrap/cache
```

6. Run the application locally:

```bash
php artisan serve
```

7. For production deployment, point your web server document root to the `public` directory and make sure `storage` and `bootstrap/cache` are writable.

###### 
