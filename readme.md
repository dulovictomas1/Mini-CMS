# SaaS Reservation System with Custom CMS (PHP)

This project is a lightweight SaaS-style reservation system built in PHP, combined with a custom CMS that serves as both an administrative and presentation layer.

The system is designed as a full web application with two main components:

- **Reservation system (core logic)** – handles booking availability, reservation validation, and database operations
- **Custom CMS (admin & presentation layer)** – allows content management, user role control, and dynamic creation of pages used to present the system

The CMS includes a role-based access system:

- **Super Admin** can manage content, create new pages, and control the structure of the website
- **Registered users** have access to their own dashboard, where they can manage reservations, view their API key, and interact with the system

The application also includes asynchronous (AJAX-based) availability checking, improving user experience by providing real-time feedback without page reloads.

This project simulates a simplified SaaS model where the CMS acts as the interface for presenting and managing the reservation system.

---

## Features

### Core System

- Reservation system with availability control and prevention of double bookings  
- User dashboard for managing reservations and viewing personal API key  
- Role-based access system (Super Admin / User)  
- API-ready structure for integration (e.g. WordPress plugin)

### Custom CMS (Admin & Presentation Layer)

- Dynamic page creation and content management  
- Rich text editing with TinyMCE  
- Separation of admin and user views  
- Super Admin can manage website structure and presentation pages  

### User Experience

- Interactive calendar using Flatpickr  
- Highlighted available and booked dates  
- Disabled unavailable dates to prevent invalid bookings  
- AJAX-based availability checking (no page reload)  
- Improved form handling and feedback for better UX  

### Backend & Data

- PHP backend with custom routing  
- MySQL database with relational structure  
- SQL queries (SELECT, JOIN, GROUP BY)  
- CRUD operations for reservations and content  
- Data exchange between backend and frontend (JSON)

### Architecture & Development

- Separation of concerns (CMS vs reservation logic)  
- Environment configuration via `.env`  
- Modular structure (pages, parts, API layer)  
- Iterative improvements based on real issues (bugs, UX problems)

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
2. Create a `.env` file (example `inc/.env.example` provided)
3. Set database credentials and configuration in `.env`
4. Setup database using schema.sql
5. Run on local server (e.g., XAMPP, MAMP)

---

## User Roles / Admin Access

The system supports role-based access:

- 1 → Admin (full access)
- 3 → User (limited access)

By default, newly registered users are created with a viewer role.
To test admin functionality, update the user role in the database:
UPDATE users SET user_role = 1 WHERE id = 1;

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