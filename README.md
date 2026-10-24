# 💻 Pabal's Laptop Inventory Management System

A full-stack, secure inventory management web application built from scratch with procedural PHP and MySQL, containerized using Docker, and styled with a modern SaaS dark-mode interface. 

Developed as part of **IT202 (Internet Applications)** at NJIT and re-engineered for personal infrastructure production.

---

## Key Features

* **Modern SaaS Architecture:** Built entirely from scratch with procedural PHP, a centralized router (`index.php`), and modular `.inc.php` component views.
* **Responsive CSS Grid UI:** Replaced legacy 1990s HTML tables with a modern product-card layout and native HTML5 `<dialog>` modals for smooth, JavaScript-free interactions.
* **Unified Command Palette Search:** A centralized search console supporting smart prefixes (`id:`, `typeid:`) alongside real-time wildcard string matching (`LIKE`).
* **Secure Backend Operations:** Implements robust **MySQL prepared statements** (`mysqli` parameterized queries) across all SELECT, INSERT, UPDATE, and DELETE methods to completely neutralize SQL injection vulnerabilities.
* **Role-Based Session Authentication:** Secure login gateway linked directly to a hashed database table (`laptop_users`), enforcing encrypted session management and automatic redirection blocks.

---

## Tech Stack & Infrastructure

* **Frontend:** HTML5, CSS3 (Custom CSS Grid & Flexbox, Dark Terminal Theme)
* **Backend:** PHP 8.2 (Procedural & Object-Oriented Hybrid)
* **Database:** MySQL 8.0 (Relational Schema with Foreign Key Constraints & Cascade Rules)
* **Containerization:** Docker & Docker Compose (Multi-container orchestration)
* **Edge Routing:** Cloudflare Zero Trust Tunnels (Exposed securely via `laptops.pabal.dev`)

---

## Project Structure

```text
pa478-IT202-Website/
├── Dockerfile                  # PHP 8.2 + Apache image build configuration
├── docker-compose.yml          # Multi-container orchestration (Web + DB)
├── init.sql                    # Master schema and seed data setup script
├── index.php                   # Central gatekeeper & routing controller
├── database.php                # Database connection factory (getDB)
├── laptop.php                  # Laptop class & secured CRUD methods
├── laptoptype.php              # LaptopType class & category management
├── search.inc.php              # Command-palette search routing engine
├── validate.php                # Secure credential verification script
├── logout.php                  # Session destruction handler
├── ih_styles.css               # Custom dark-mode SaaS design system
└── images/                     # Dynamic fallback asset storage
