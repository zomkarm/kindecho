# 🌟 KindEcho – Anonymous Gratitude Wall

KindEcho is a Laravel based web app that allows users to anonymously post positive messages, fostering a community of kindness. It features modern UI, admin moderation, sentiment tagging, and responsive design.

## ✨ Features

### User-Side
- 🌈 Post anonymous gratitude messages with mood & tags
- 🧠 AI-powered sentiment analysis (OpenAI or local fallback)
- ❤️ Like and view posts without user accounts
- 📱 Responsive grid-based UI (mobile-friendly)
- 🧭 SPA-style navigation for smooth UX

### Admin Panel
- 🛡️ Custom admin login/register (via `is_admin` flag)
- 📊 Dashboard with:
  - Monthly post chart
  - KPIs: total users, posts, today's posts, pending posts
- 👥 User Management: view, search, delete users
- 📝 Post Management:
  - View, filter, edit, delete posts
  - Change post status (approved, pending, flagged)
- ⚙️ Settings: update admin name, email, password
- 📱 Responsive admin layout with mobile sidebar toggle

## 🛠️ Tech Stack

- Backend: **Laravel 10**
- Frontend: **Blade**, **Alpine.js**, **Tailwind CSS**
- Database: **MySQL**
- Charts: **Chart.js**
- Optional AI: OpenAI API or local `sentiment` package

## 🧪 Setup Instructions

### 1. Clone the Repo
```bash
git clone https://github.com/yourusername/kindecho.git
cd kindecho

2. Install Dependencies
composer install
npm install && npm run dev

3. Configure Environment
cp .env.example .env
php artisan key:generate
Set your DB credentials in .env and optionally add OpenAI API key:

DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password

OPENAI_API_KEY=your_openai_key (optional)

4. Run Migrations
php artisan migrate
5. Seed Admin (Optional)
Use /admin/register to create your first admin, or insert via tinker:

php artisan tinker
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'is_admin' => true
]);

6. Start the Server
php artisan serve
Visit: http://localhost:8000 //check which port server is running on

Built with ❤️ to spread positivity – KindEcho
