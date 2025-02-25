Esta versión de la aplicación corre en localhost con la autenticación de usuarios registrados en la base de datos local. 
# Pasos para instalar en localhost
## 1. Instalar software necesario
- [PHP](https://windows.php.net/download/) (non-thread-safe version) 8.2 o superior
  - Quitar el comentario en php.ini de extension=mysqli y extension=openssl
  - Agregar PHP al PATH de las variables de entorno del sistema
- [MySQL Server](https://dev.mysql.com/downloads/mysql/8.0.html?os=2)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download)
- NPM

## 2. Desplegar el proyecto
- Copiar el proyecto
- Instalar las dependencias
```sh
composer install
npm install
```
- Copiar el archivo .env
```sh
copy .env.example .env
```
- Generar la key de la aplicación
```sh
php artisan key:generate
```
- Correr los servidores de prueba
```sh
php artisan serve
npm run dev
```
- Correr migraciones y seeders
```sh
php artisan migrate:fresh --seed
```
- Probar la aplicación en localhost 
```sh
http://127.0.0.1:8000
```
- Iniciar sesión con el usuario administrador
```sh
Email: admin@example.com
Contraseña: password
```
# Información
| Herramienta | Versión |
| ------ | ------ |
| PHP | 8.2 |
| Laravel | 11 |
| Vue | 3 |
| MySQL Server | 8.0.39 |