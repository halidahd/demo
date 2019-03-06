## Api Demo

Sau khi clone về thực hiện các bước dưới đây để setup 
- Coppy file .env.example > .env
- Chạy lệnh php artisan key:generate
- Setup lại thông tin DB trong .env
- Run composer install 
- Cài đặt Passport
	+ php artisan migrate
	+ php artisan passport:install
    + php artisan make:auth

## Route API
##### Register User 
[POST] /api/user/register

Param:
- email: required | email | max:191 | unique:users
- password: required | string
- fullname: required | string | max:191
- tel: string | max:20
- address: string | max:191
 
 Header
+ X-Requested-With:XMLHttpRequest
+ Content-Type:application/x-www-form-urlencoded

##### Login
[POST] /api/login

Param:
- email: required | email 
- password: required | string

 Header
+ X-Requested-With:XMLHttpRequest
+ Content-Type:application/x-www-form-urlencoded

##### Update User 
[POST] /api/user/update

Param:
- password: nullable | string
- fullname: required | string | max:191
- tel: string | max:20
- address: string | max:191

 Header
+ X-Requested-With: XMLHttpRequest
+ Content-Type: application/x-www-form-urlencoded
+ authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiI...