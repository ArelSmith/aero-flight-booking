# ✈️ Aero – Flight Booking Application

Aero is a modern **flight booking application** built with **Laravel 12**.  
The goal of this project is to provide a seamless experience for searching, booking, and managing flights online.

---

## 🚀 Features

- 🔍 Search flights by destination, date, and class  
- 📅 Manage bookings with real-time status updates  
- 🧑‍🤝‍🧑 User authentication & profile management  
- 💳 Payment integration (planned)  
- 📊 Admin dashboard for managing flights and bookings (planned)  
- 📱 Responsive UI for desktop and mobile  

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)  
- **Database**: MySQL / MariaDB  
- **Frontend**: Blade / Tailwind CSS (extendable to Inertia or React if needed)  
- **Tools**: Composer, Artisan CLI, Laragon (for local dev)  

---

## 📂 Project Structure

aero/
├── app/ # Application core
├── bootstrap/ # Bootstrap files
├── config/ # Configurations
├── database/ # Migrations, Seeders, Factories
├── public/ # Public assets
├── resources/ # Views, CSS, JS
├── routes/ # Web & API routes
├── tests/ # Test files
└── ...

---

## ⚙️ Installation & Setup

1. **Clone the repository**
   ```
   git clone https://github.com/yourusername/aero.git
   cd aero
Install dependencies

composer install
npm install && npm run dev
Environment setup

Copy .env.example to .env

Configure your database and other environment variables:

bash
Copy
Edit
php artisan key:generate
Run migrations & seeders

bash
Copy
Edit
php artisan migrate --seed
Start the development server

bash
Copy
Edit
php artisan serve
🧪 Testing
Run tests with:

bash
Copy
Edit
php artisan test
🛤️ Roadmap
 Implement payment gateway (Stripe/Midtrans)

 Add role-based access (Admin, User)

 Flight seat selection system

 API support for mobile apps

🤝 Contributing
Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

📜 License
This project is open-source and available under the MIT License.
