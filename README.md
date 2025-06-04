# Portal Statistica

**Portal Statistica** is a modular web application developed using PHP and MySQL, designed to analyze, visualize, and forecast statistical indicators related to the youth population of the Republic of Moldova. The project is structured using the MVC (Model-View-Controller) architecture and includes thematic modules such as education, health, demography, and employment.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, MySQL
- **Data Visualization:** Chart.js (JavaScript library)
- **Machine Learning Models:** Prophet and XGBoost (developed externally in Python)
- **Architecture:** MVC (Model, View, Controller)

## Project Structure

portal_statistica/
├── assets/ # Static assets (CSS, JS, images)
├── controllers/ # Request handling logic per module
├── core/ # Core framework files (DB connection, routing)
├── data/ # CSV data files and model outputs
├── models/ # Database interaction logic
├── views/ # Visual components and templates
├── index.php # Entry point of the application
├── composer.json # (Optional) Composer configuration
└── database/
└── portal_statistica.sql # MySQL database export


## Key Features

- Filtering by year, gender, age, location, and education level
- Data visualization through interactive tabbed interfaces (Real Data, Comparison, Predictions)
- Data export to Excel format
- Modular, extensible, and responsive design
- Integration with predictive models for future trend analysis

## Predictive Models

The forecasting component covers the period 2025–2030 and was developed externally in Python. Models used include:

- **Prophet** – suitable for time-series forecasting (developed by Facebook)
- **XGBoost** and **Random Forest** – used for regression tasks on encoded categorical and numeric data

Prediction results are exported as `.csv` files and imported into the application for interactive visualization.

## How to Run Locally

1. Clone the repository inside your XAMPP `htdocs` directory: git clone https://github.com/username/portal_statistica.git

2. Import the `portal_statistica.sql` file into a new MySQL database using phpMyAdmin.

3. Configure the database connection inside `core/Database.php` (or your configuration file):

private $host = "localhost";
private $db_name = "portal_statistica";
private $username = "root";
private $password = "";

4. Configure the database connection inside `core/Database.php` (or your configuration file):

http://localhost/portal_statistica


