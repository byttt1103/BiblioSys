# BiblioSys
### A comprehensive library management system with catalog organization, book lending, and built-in news blog

---
## About BiblioSys

BiblioSys is a modern, web-based library management platform designed to streamline the organization, access, and administration of bibliographic resources for physical libraries. Built to address the inefficiencies of outdated manual and legacy digital systems, it empowers library staff with intuitive tools to manage book catalogs, and track loans, while delivering a seamless, user-friendly experience for patrons to browse and interact with the library's collection digitally.

Far more than just a back-office management tool, BiblioSys serves as a public-facing hub for libraries to engage their communities. The integrated news and events blog lets institutions promote programming, share updates, highlight new acquisitions, and expand their reach beyond regular visitors, turning the system into a central resource for the entire community it serves.

BiblioSys is built on the Laravel PHP framework, leveraging its robust security, scalability, and ecosystem to deliver a reliable, maintainable solution for libraries of all sizes.

## Key Features
* **Staff Tools**: Streamlined catalog management, real-time loan tracking, and patron account administration
* **Patron Experience**: Searchable digital catalog, online loan reservations, and personal reading history
* **Community Engagement**: Built-in news and events blog to promote library services, programming, and new acquisitions
* **Scalable Architecture**: Built to support small community libraries through to large institutional collections

## Installation

### Prerequisites
Before you begin, ensure your system meets the following requirements:
- PHP 8.2 or higher
- Composer dependency manager
- MySQL 8.0 / PostgreSQL 13 or compatible database
- Web server (Apache / Nginx) with SSL support for production deployments

### Step-by-Step Setup
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
