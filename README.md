
# EM Ticketing System
This system is designed and developed for the assignment of Elegent Media. System will contain features like placing a
ticket, checking status and interacting with the agen/client and ticket administration. For more information you can 
check on the [Requirement.md](https://github.com/nuwanchamp/EM-ticketing-system/blob/main/Requirements.md) and 
screenshots are available inside the docs' folder.
![Ticketing System Screenshot]('https://github.com/nuwanchamp/EM-ticketing-system/blob/main/doc/screenshots/Screenshot-from-2025-07-28-00-29-15.png')

## Installation
you can install the system using the following ways.
### Github  
```shell
cd /your/path #cd into target folder
 git clone https://github.com/nuwanchamp/EM-ticketing-system.git .
```
Dependency installation

```shell
composer install
npm install # Requires node 20 || 20+ for vite server
```
Create an Env file using the sample
```shell
cp .env.example .env
php artisan key:generate
```
Database setup:
```shell
touch database/database.sqlite
php artisan migrate:fresh
php artisan db:seed # Optional
```
Start the dev server:
```shell
composer run dev
```

### Zip
If you are using the zip file you can extract it by using following command

```sh
    cd /your/target/path
    unzip <zip-filename.zip> 
```
Then you can move it to the project folder and continue the above steps from `Dependency Installation`
