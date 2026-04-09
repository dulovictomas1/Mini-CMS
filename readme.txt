# Mini CMS & Reservation System (PHP)

This is a custom CMS and reservation system built from scratch in PHP.
The project includes an admin panel, content management, and a reservation system with enhanced UX features.

---

## Features

- **Custom routing system** for flexible page management
- **Admin panel** for managing pages and reservations
- **CRUD operations** for content management
- **Rich text editing** using TinyMCE for user-friendly content editing
- **Reservation system**:
- Integrated **Flatpickr** calendar for date selection
- Disabled past and unavailable dates to prevent errors
- Highlighted available and booked dates for better UX
- **Database abstraction** using Medoo
- Environment variables for secure configuration (`.env`)

---

## Tech Stack

- **Backend:** PHP (vanilla, no framework)
- **Database:** MySQL
- **Libraries / Tools:**
- [Medoo](https://medoo.in/) – lightweight PHP database framework
- [TinyMCE](https://www.tiny.cloud/) – WYSIWYG editor for content
- [Flatpickr](https://flatpickr.js.org/) – interactive calendar for reservations

---

## Development Highlights

- Iterative improvements: fixed date overwrite issues and form submission bugs
- Enhanced UX by integrating calendar features and rich text editor
- Used `.env` file for configuration to separate sensitive data from code
- Worked with frontend-backend integration (JS → PHP → DB)
- Learned debugging, testing, and improving features over time

---

## How to Run

1. Clone repository
2. Create a `.env` file (example `.env.example` provided)
3. Set database credentials and configuration in `.env`
4. Setup database using provided SQL or migration scripts
5. Run on local server (e.g., XAMPP, MAMP)

---

## Screenshots

- Admin panel overview
- Edit page with TinyMCE
- Reservation

---

## What I Learned

- Building a CMS and reservation system from scratch
- Integrating third-party libraries for better UX
- Using Medoo for database abstraction
- Working with environment variables for secure configuration
- Iterative bug fixing and feature improvements