# BNSP PMB - Sistem Penerimaan Mahasiswa Baru Online

## Deskripsi Aplikasi

BNSP PMB adalah aplikasi web untuk manajemen penerimaan mahasiswa baru. Sistem ini memungkinkan:
- **Admin** untuk mengelola user dan data pendaftaran mahasiswa
- **Calon Mahasiswa** untuk melakukan pendaftaran dan melihat status pendaftaran mereka

## Fitur Utama

### Untuk Admin
1. **Dashboard** - Menampilkan statistik (Total Users, Total Registrations, Approved, Pending)
2. **Kelola User** - Create, Read, Update, Delete user dengan role admin atau student
3. **Kelola Pendaftaran** - Melihat, mengedit status (pending/approved/rejected), dan menghapus data pendaftaran

### Untuk Calon Mahasiswa
1. **Dashboard** - Melihat status pendaftaran dan ringkasan data
2. **Formulir Pendaftaran** - Mengisi data pribadi, pendidikan, motivasi, dan lampiran
3. **Edit Pendaftaran** - Mengubah data pendaftaran yang sudah dibuat
4. **Lihat Detail** - Melihat informasi pendaftaran yang telah dikirimkan

## Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Database**: MySQL
- **Frontend**: Blade Template dengan Bootstrap 5
- **Authentication**: Laravel Built-in Authentication
- **Security Features**: 
  - Password Hashing
  - CSRF Protection
  - SQL Injection Prevention
  - Middleware untuk role-based access control

## Struktur Database

### Tabel Users
- id (Primary Key)
- name (string)
- email (string, unique)
- password (hashed)
- role (enum: 'admin', 'student')
- timestamps (created_at, updated_at)

### Tabel Registrations
- id (Primary Key)
- user_id (Foreign Key)
- full_name (string)
- email (string)
- phone (string)
- address (text)
- birth_place (string)
- birth_date (date)
- gender (enum: 'male', 'female')
- education_background (string)
- school_name (string)
- gpa (decimal: 3,2)
- motivation (text)
- attachment_path (string, nullable)
- status (enum: 'pending', 'approved', 'rejected', default: 'pending')
- admin_notes (text, nullable)
- timestamps (created_at, updated_at)

## Routes

### Public Routes
- `GET /` - Homepage
- `GET /login` - Login page
- `POST /login` - Login action
- `POST /logout` - Logout action

### Admin Routes (Protected by 'admin' middleware)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - List all users
- `GET /admin/users/create` - Create user form
- `POST /admin/users` - Store new user
- `GET /admin/users/{user}/edit` - Edit user form
- `PUT /admin/users/{user}` - Update user
- `DELETE /admin/users/{user}` - Delete user
- `GET /admin/registrations` - List all registrations
- `GET /admin/registrations/{registration}` - View registration detail
- `GET /admin/registrations/{registration}/edit` - Edit registration status
- `PUT /admin/registrations/{registration}` - Update registration
- `DELETE /admin/registrations/{registration}` - Delete registration

### Student Routes (Protected by 'student' middleware)
- `GET /student/dashboard` - Student dashboard
- `GET /student/registration/create` - Registration form
- `POST /student/registration` - Store registration
- `GET /student/registration` - View student's registration
- `GET /student/registration/edit` - Edit student's registration
- `PUT /student/registration` - Update registration

## Keamanan Non-Functional

1. **Database Level**: 
   - Password di-hash menggunakan bcrypt
   - Foreign key constraints
   - Type validation pada setiap field

2. **Application Level**:
   - CSRF token protection pada semua form
   - Input validation menggunakan Laravel Validator
   - Authorization check dengan middleware (admin/student)
   - SQL injection prevention dengan Eloquent ORM

3. **Web Server Level**:
   - Session management
   - Secure cookie handling
   - HTTPS ready configuration

4. **Scalability**:
   - Database queries dioptimalkan dengan eager loading
   - Support untuk 20+ concurrent users
   - Indexed database columns untuk query performance

## Instalasi & Setup

### 1. Clone atau Extract Project
```bash
cd c:\laragon\www\ijal pmb\bnsp-project
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bnsp_pmb
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migrations
```bash
php artisan migrate
```

### 6. Seed Database (Optional)
```bash
php artisan db:seed
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://127.0.0.1:8000`

## Membuat User Admin

Untuk membuat user admin pertama, jalankan:
```bash
php artisan tinker
```

Kemudian:
```php
App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

Atau gunakan Artisan command jika tersedia.

## Membuat User Student

```php
App\Models\User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => bcrypt('password'),
    'role' => 'student'
]);
```

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/LoginController.php
│   │   ├── Admin/
│   │   │   ├── UserController.php
│   │   │   └── RegistrationController.php
│   │   └── Student/
│   │       └── RegistrationController.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       └── StudentMiddleware.php
├── Models/
│   ├── User.php
│   └── Registration.php
└── Providers/
    └── AppServiceProvider.php

routes/
└── web.php

resources/views/
├── layouts/app.blade.php
├── components/
│   ├── navbar.blade.php
│   ├── admin-sidebar.blade.php
│   └── student-sidebar.blade.php
├── auth/
│   └── login.blade.php
├── admin/
│   ├── dashboard.blade.php
│   ├── users/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── registrations/
│       ├── index.blade.php
│       ├── show.blade.php
│       └── edit.blade.php
└── student/
    ├── dashboard.blade.php
    └── registration/
        ├── create.blade.php
        ├── show.blade.php
        └── edit.blade.php

database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   ├── 0001_01_01_000002_create_jobs_table.php
│   └── 2026_01_28_create_registrations_table.php
└── seeders/
    └── DatabaseSeeder.php
```

## Catatan Penting

1. **Upload File**: File lampiran disimpan di folder `storage/app/public/registrations/`
2. **File Storage**: Pastikan folder storage dapat ditulis oleh web server
3. **Symlink**: Jalankan `php artisan storage:link` untuk membuat symlink
4. **MIME Types**: Hanya PDF, DOC, dan DOCX yang diizinkan (max 5MB)

## Testing

Untuk menjalankan test:
```bash
php artisan test
```

## Performance Tips

1. Gunakan eager loading untuk menghindari N+1 queries
2. Cache statistik di admin dashboard
3. Optimize database indexes
4. Gunakan pagination untuk list data yang besar

## Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
```

### Permission Denied (Upload)
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Migrations tidak berjalan
```bash
php artisan migrate:refresh
```

## Support & Maintenance

Untuk maintenance rutin:
1. Clear cache: `php artisan cache:clear`
2. Clear routes: `php artisan route:clear`
3. Clear views: `php artisan view:clear`

## License

MIT

---

**Version**: 1.0.0  
**Last Updated**: January 28, 2026
