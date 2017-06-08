# client-address-book
A simple PHP Bootstrap application involving CRUX operations with MySQL database to manage clients details.

Follow these simple steps to get up and running with the Client Manager

1. Download and install XAMPP, start Apache and MySQL from the control panel
2. Clone the repository and paste it in C:\xampp\htdocs folder
3. Open localhost/phpmyadmin
4. From the left panel, create a new database, name it as 'client_address_book'
5. Create a users table with id being primary key, email, name and password. (See the attached images for references)
6. Run the sql query INSERT INTO users (id, email, name, password)
   VALUES (NULL, 'avinashsp93@gmail.com', 'Avinash', '$2y$10$..BXCsXoINJ55yxH2vZ6Mun5QtgI/RZ94zegU2aCCeoTgD5tPh4W.');
   you can also do this manually by entering the data
7. Open the index.php in the browser as localhost/client-address-book/index.php
8. Login with the following credentials
   username - avinashsp93@gmail.com
   password - avi
9. Now you can go on by Adding, Editing or Deleting the Clients
10.For further queries, drop a mail at avinashsp93@gmail.com
