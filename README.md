# AutoExpress.co.nf
AutoExpress a car dealership app built for both car dealer and car buyer. 
A car dealer manages the car being viewed on the website by adding, updating, 
deleting and uploading photos of a car. On the other hand, a car buyer can search 
for the vehicle he or she desired on the website. If the buyer finds the desired 
vehicle he or she can contact the seller to get more information of the vehicle. 
A car buyer can also calculate their monthly or bi-weekly payment.

### Setup
1. Clone this repo.
2. Create the database.
3. Configure `\autoexpress\admin\server\class\Dbh.php` file so it matches your web server database username and password.
4. Create the tables by importing the sql file `\db\schema.sql`.
5. Create an admin account directly by way of `INSERT` statement.
6. Now you can add car to the inventory in `admin/inventory.php`

### Features
- Advanced search
- Montly or bi-weekly payment calculator
- Administrator module

### Other features to be implemented
- Share a car via email
- Schedule a test drive
- Make an offer to the dealer

### Screenshots - Customer
![Home page](https://github.com/tramyardg/autoexpress/blob/master/image/home_page.PNG)
![Payment calculator](https://github.com/tramyardg/autoexpress/blob/master/image/calc_payment.PNG)

### Screenshots - Admin
![Admin dashboard](https://github.com/tramyardg/autoexpress/blob/master/image/admin_dashboard.PNG)
![Admin manage inventory](https://github.com/tramyardg/autoexpress/blob/master/image/admin_inventory.PNG)
