# DataVault Project

## Installation Instructions

Follow these steps to set up and run the **DataVault** project.

### Prerequisites
- [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/) installed on your local machine.
- MySQL database server running.
- A web browser for accessing the application.

---

### Setup Instructions

1. **Import the Database**
   - Locate the `datavault.sql` file in the project folder.
   - Import the SQL file into your MySQL database:
     1. Open **phpMyAdmin** or your preferred database management tool.
     2. Create a new database (e.g., `datavault`).
     3. Import the `datavault.sql` file into the newly created database.

2. **Place Project Files**
   - Copy all files and folders **excluding** the `datavault.sql` file into:
     - `xampp\htdocs` (if using XAMPP), or
     - `wamp64\www` (if using WAMP).

3. **Start Your Server**
   - Ensure that your Apache and MySQL services are running in XAMPP or WAMP.

4. **Access the Application**
   - Open a web browser and navigate to:  
     `http://localhost/<your_project_folder>`

5. **Login Credentials**
   - Use the following credentials to log in:
     - **Username:** `admin`
     - **Password:** `admin123`

---

### Features
- Secure login system
- User-friendly interface
- Data visualization features

---

### Troubleshooting
- If the application does not load, verify that:
  1. The Apache and MySQL services are running.
  2. The project files are correctly placed in the `htdocs` or `www` directory.
  3. The database was successfully imported.
- For further assistance, check the project logs or contact the development team.

 
### Author
Developed by Masroor Ejaz.
