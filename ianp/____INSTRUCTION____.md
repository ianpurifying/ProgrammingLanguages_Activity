## HOW TO SET UP THE PROJECT

---

### 1. Start XAMPP

- Open XAMPP Control Panel
- Start **Apache** and **MySQL**
- Click **Admin** next to **MySQL** (opens phpMyAdmin)

---

### 2. Set Up the Database

1. In **phpMyAdmin**, click **"New"** on the sidebar.
2. Name the database **`ianp`** and click Create.
3. After creating the database:

   - Click on the newly created **ianp** database.
   - Go to the **Import** tab.
   - Click **Choose File** and select **`ianp.sql`** from the project folder.
   - Click **Import**.

---

### 3. Add the Project Folder to XAMPP

1. Move the entire project folder (named `ianp`) into the `htdocs` directory:

   - Example: `C:\xampp\htdocs\ianp`

---

### 4. Run the Web App

- Back in the XAMPP Control Panel, click the **"Admin" button** next to Apache to open your browser.
- Access the site using these URLs:

  - **Client Side:** [http://localhost/ianp/]
  - **Admin Panel:** [http://localhost/ianp/admin]

    - Login credentials:

      - **Username:** `admin`
      - **Password:** `admin123`

---

### Final Checks

- XAMPP (Apache & MySQL) must be running.
- The `ianp` database must be created and imported.
- Project folder must be inside `htdocs`.
- MySQL connection should match your setup:

```php
$servername = "localhost";
$username = "root";
$password = ""; // If MySQL has no password
$dbname = "ianp";
```
