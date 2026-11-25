# Nestline Tiny Homes — Tiny Home Builder Website + ERP + AI

Production-ready Laravel 13 + Filament 3 platform for **Nestline Tiny Homes**, an Austin–Hill Country tiny home builder. Includes a public marketing site, full ERP admin, AI chatbot/generators, and a seeded knowledge base.

## ✨ Features
- 🏡 Public landing site with hero, services, about, dashboard preview, and contact
- 🛠️ Service detail pages for towables, park models, ADUs, custom interiors, and off-grid packages
- 📚 Blog / knowledge base with seeded Hill Country tiny-living content
- 💬 Floating WhatsApp button + public AI chatbot (FAQ demo mode or live API)
- 🧾 Filament ERP: customers, build projects, inventory, invoices, payments, appointments
- 👥 Roles: Admin, Manager, Staff (Spatie Permission + role column)
- 📊 Reports dashboard with stats widgets and charts
- ⚙️ Company settings page + AI content / automation / troubleshooting assistants
- 🌱 Realistic demo seeders for Texas SME operations

## 🧰 Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js + Tailwind CSS
- MySQL or SQLite (demo)
- OpenAI / Gemini config keys (optional; graceful FAQ fallback)

## 🚀 Installation
```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite   # if using SQLite
php artisan migrate --seed
npm install && npm run build
php artisan serve
```

Admin panel: `http://localhost:8000/admin`  
Public site: `http://localhost:8000`

**Demo login:** `admin@example.com` / `password`

## 🖼️ Screenshots / Visual Dashboard
![Nestline tiny home exterior](https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=1200&q=80)

![Tiny home wood interior](https://images.unsplash.com/photo-1542718610-a1d656d1884c?auto=format&fit=crop&w=1200&q=80)

![Compact dwelling craftsmanship](https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=1200&q=80)

## 🌐 Live Demo
Placeholder — deploy to your preferred host (Forge, Vapor, shared PHP) and link here.

## 🔍 SEO-optimized repo description suggestion
`Nestline Tiny Homes — Laravel 13 + Filament 3 tiny home builder website, ERP, AI chatbot, and knowledge base for Austin–Hill Country SMEs.`

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |

