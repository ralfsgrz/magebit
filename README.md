# Magebit Web Developer Test

This repository contains 3 test tasks:
- **magebit_task1** - HTML/CSS
- **magebit_task2** - JavaScript
- **magebit_task3** - PHP/MYSQL



## Installation

Tasks **magebit_task1** and **magebit_task2** don't require any installation. Just run ``index.html`` in a browser.

To run **magebit_task3** the folder has to be placed on a local web server with PHP and MySQL installed. To create the necessary database and table for the task: 
1. Edit the database connection data in ``magebit_task3/db/database.php``.
2. Run the database initialization file ``magebit_task3/db/install.php`` in a browser (ex.: http://localhost/magebit_task3/db/install.php).

If the database with table is created, a success message will be displayed. To see the front page, open ``index.php`` in the browser, and to see the table with subscriptions - open ``subscriptions.php`` in the browser.
