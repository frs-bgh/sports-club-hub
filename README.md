# Sports Club Hub (Laravel 12)

This project was made for the Backend Web course (EhB).
It is a small data-driven website for a sports club with authentication, profiles, news, FAQ and a contact form, plus an admin panel.

---

## Features (Assignment Requirements)

### Login System
- Register / Login / Logout
- Remember Me
- Forgot Password / Reset Password

### Users And Admin
- A user is either a normal user or an admin
- Only admins can promote or demote other users
- Only admins can create a user manually (and choose if the new user is admin)

### Profile Page
- Every user has a public profile page visible for everyone (also visitors)
- Visitors can browse a “Members” page with search
- Logged-in users can edit their own profile
- Profile fields are optional: Username, Birthday, Profile Photo (stored on the server), About Me text

### News
- Visitors can see a list of news items and a detail page per news item
- Admins can create, edit and delete news items (Only admins can manage news)
- News fields: Title, Image (stored on the server), Content, Published At
- Relations:
    - One-to-many: User (Author) -> News Items
    - Many-to-many: News Items <-> Tags

### FAQ
- Visitors can see the FAQ page grouped by category
- Admins can create, edit and delete categories and questions/answers

### Contact
- Visitors can fill in the contact form
- On submit:
    - The message is saved in the database
    - The admin receives an email with the content of the form

### Extra Feature
- Admins can view and delete all contact messages in the admin panel

---

## Default Admin Account (Required)
- Name: Admin
- Email: admin@ehb.be
- Password: Password!321

---

## Setup (How To Run)

### Requirements
- PHP 8.2+
- Composer
- Node + NPM
- A database (The teacher will use their own `.env`)

### Install Steps

1) Clone the repository and enter the folder
```bash
git clone https://github.com/frs-bgh/sports-club-hub.git
cd sports-club-hub
```

2) Install PHP dependencies
```bash
composer install
```

3) Create `.env` and generate the app key

Windows:
```bash
copy .env.example .env
php artisan key:generate
```

macOS / Linux:
```bash
cp .env.example .env
php artisan key:generate
```

4) Run migrations + seed (Teacher can run this)
```bash
php artisan migrate:fresh --seed
```

5) Create storage link (Profile Photos + News Images)
```bash
php artisan storage:link
```

6) Install frontend dependencies and build
```bash
npm install
npm run build
```

7) Run locally
```bash
php artisan serve
```

Open the website in your browser:
- http://127.0.0.1:8000
- Or your local Herd/Valet URL (Example: http://sports-club-hub.test)

---

## Mail For Contact Form
For development it is OK to use:
```env
MAIL_MAILER=log
```

Then the email content is written to:
```txt
storage/logs/laravel.log
```

---

## Important Notes
- The project supports `php artisan migrate:fresh --seed`
- `vendor` and `node_modules` are in `.gitignore`
- Images are stored on the public disk (`storage/app/public`) and shown via `php artisan storage:link`
