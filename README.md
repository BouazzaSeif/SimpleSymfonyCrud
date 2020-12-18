# Simple Symfony Crud Project

A simple symfony project contains crud for two simple entities 

To make it work follow this **steps** : 
 
## 1. Run the Wampp or xampp Server 
 
## 2. open a the project in new terminal 

## 3. execute this CMD to get the symfony dev bundle : 
 ```bash
	 composer require symfony/web-server-bundle
   ```
 
## 4. execute this CMD to create the database : 
  ```bash
	  php bin/console doctrine:database:create 
   ```
 
## 5. To make the migration :
   ```bash
	php bin/console make:migration 
   ```

##  6. To persist the migration : 
  ```bash
	  php bin/console doctrine:migration:migrate 
  ```

##  7. now start the symfony server : 
   ```bash
 	 php bin/console server:run 
  ```

## Enjoy ! 
