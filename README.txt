╔══════════════════════════════════════════════════════════╗
║            KAPITOL CAFE – POS & ORDER SYSTEM             ║
╚══════════════════════════════════════════════════════════╝

📁 FOLDER STRUCTURE
───────────────────
kapitol_cafe/
├── index.php            ← System hub / launcher (start here)
├── config.php           ← Database & site settings
├── database.sql         ← Import this to set up the database
├── .htaccess            ← Apache security rules
│
├── welcome.php          ← Customer-facing welcome screen (main monitor)
├── table_select.php     ← Customers choose their table
├── menu.php             ← Mobile menu & ordering page
├── order_track.php      ← Customers track their order live
├── payment.php          ← Payment screen (GCash / Maya / Cash)
├── gcash_pay.php        ← GCash QR payment page
├── goodbye.php          ← Thank-you screen after checkout
│
├── admin.php            ← Admin dashboard (orders, cashier, stats)
├── kitchen_display.php  ← Kitchen order board (auto-refresh)
├── qr_generator.php     ← Generate & print table QR codes
│
├── api/
│   └── api.php          ← All backend API endpoints (JSON)
│
└── images/              ← Coffee & menu item photos
    ├── Kapitol_Espresso.jpg
    ├── Americano.jpeg
    ├── Cappuccino.jpg
    ├── Caramel_Macchiato.jpg
    ├── Cafe_Latte.jpg
    └── White_Mocha.jpg


⚙️  SETUP INSTRUCTIONS
───────────────────────
1. Install XAMPP and start Apache + MySQL.

2. Copy the entire `kapitol_cafe` folder to:
      C:\xampp\htdocs\kapitol_cafe\

3. Open phpMyAdmin (http://localhost/phpmyadmin)
   → Create a new database named:  kapitol_cafe
   → Click "Import" → Select database.sql → Click Go

4. Edit config.php if needed:
   → Change DB_PASS if your MySQL has a password
   → Change SITE_URL to your PC's local IP if using mobile
     Example: define('SITE_URL', 'http://192.168.1.100/kapitol_cafe');

5. Open in browser:
      http://localhost/kapitol_cafe/

6. For mobile ordering:
   → Connect customer phones to the same WiFi as the PC
   → Replace "localhost" in config.php with your PC's IP
   → Find your IP: open CMD and type: ipconfig
     Look for "IPv4 Address" (e.g. 192.168.137.1)


🔐 DEFAULT LOGIN CREDENTIALS
──────────────────────────────
   Username: admin      Password: password
   Username: cashier1   Password: password
   Username: kitchen1   Password: password

⚠️  Change these passwords after first login!


📱 CUSTOMER FLOW
─────────────────
  welcome.php  →  table_select.php  →  menu.php  →  order_track.php
                                          ↓
                                     payment.php  →  goodbye.php


🖥️  STAFF SCREENS
──────────────────
  Admin:    admin.php          (full control)
  Kitchen:  kitchen_display.php (order queue)
  Cashier:  admin.php → Cashier tab


🍕 ADDING MENU PHOTOS
──────────────────────
1. Put your image file in the images/ folder
2. In phpMyAdmin → menu_items table → set image_url to:
      images/YourPhoto.jpg
   OR update the photoMap in menu.php for offline/demo mode.


💳 GCASH / MAYA SETUP
───────────────────────
Edit config.php:
   define('GCASH_NUMBER', '09XX-XXX-XXXX');
   define('GCASH_NAME',   'Your Name Here');
   define('MAYA_NUMBER',  '09XX-XXX-XXXX');
