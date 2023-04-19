# Sale Management for mini online business
### Main purpose: 
Local use + take advantage of SQL storage + quick agile of web development.

### Techs:
laravel 10 (which required php 8.1+ )
mySQL

Note: This project is not for online use. Vulnerability is out of concern.

## Installation:
You could use xampp or docker
### Use with xampp
- install xampp 8.1+ , composer, git
- clone the project to: C:/xampp10/htdocs
- config default apache admin button to open the app by default
config xampp: `httpd.conf` -> `DocumentRoot "C:/xampp10/htdocs/miniOB/public"`
- config env file
- composer install
- create db
- run `php artisan migrate`
- open mySQL admin page and execute: 
`INSERT INTO carts ( customer , ship , products , created_at , updated_at) VALUES ( ' ', '0', '[]', NULL, NULL);`

### Docker
I don't have plan to implement but this is the direction:
- Pull docker image with mySQL and apache build-in (could be image from xampp??)
- clone the project to /www
- do the similar config as above
- run the image with port map

## User Guide:
- open xampp controller app
- Start apache and mySQL
- click Apache Admin button and start using the app.
