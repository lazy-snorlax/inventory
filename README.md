# Inventory
A PHP website that can be used for cataloguing items. It supports dedicated users, and can be used a basis for a store front. This was created with small businesses in mind.

## Things to know
- This is an inventory list. NOT A SHOP. There is no functionality for making financial transactions (yet).
- As it is now, this is fully functional in regards to creating new users and logging in, creating, editing and deleting items and creating and deleting categories.
- Image handling has improved. If an item is deleted, the associated image is also deleted. Currently, to upload a new image for an existing item, you would have to delete the item and create a new item.
- This is a barebones application focusing more on functionality than front-end appearances. Currently using getbootstrap.com as the css. Feel free to incorporate custom css whereever necessary.

Database - SQL file included
-------------------------
### Table 1: users
- id int PRIMARY-KEY auto-increment (unique user id)
- name varchar(255)
- email varchar(255)
- password varchar(255)
- created_at datetime
- last_login datetime
-----

### Table 2: items
- id int PRIMARY-KEY auto-increment (unique item id)
- name varchar(255)
- category_id int
- description varchar(255)
- image_location varchar(255)
- user_id int
- created_at datetime
-----

### Table 3: categories
- id int PRIMARY-KEY auto-increment (unique category id)
- name varchar(255)
- user_id int (this is a created_by)
- created_at datetime
