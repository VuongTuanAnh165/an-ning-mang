<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

---

# 🎓 Nghiên cứu An ninh mạng trong môi trường Đại học số

Dự án demo xây dựng bằng **Laravel 12 + Breeze + MySQL + TailwindCSS**, phục vụ nghiên cứu các tình huống rủi ro an ninh mạng:

1. **Email phishing** – Giả lập trang login để đánh cắp tài khoản.  
2. **Rò rỉ điểm số (SQL Injection)** – Demo lỗi truy vấn không an toàn.  
3. **Ransomware trong phòng lab** (chạy riêng bằng Python).  

---

## 🚀 Cài đặt Project

### 1. Clone & cài đặt
```bash
git clone <your-repo-url>
cd <your-project-folder>
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate

2. Cấu hình Database

Trong file .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_pass

3. Migrate & seed dữ liệu
php artisan migrate --seed


Seeder mặc định tạo 1 tài khoản quản trị:

Email: admin@example.com

Password: password123

4. Cài Laravel Breeze (Auth + Tailwind)
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate

5. Chạy server
php artisan serve
