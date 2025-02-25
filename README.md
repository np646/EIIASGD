Esta versión del proyecto ha sido instalada en un servidor de prueba de la Escuela de Informática e Inteligencia Artifical de la PUCE-I. Los pasos a continuación permiten reproducir el proceso de instalación.
# Pasos para instalar en IIS (Windows Server 2016)
## 1. Instalar software necesario
- Internet Information Services (IIS) con los servicios de rol:
  - Características HTTP comunes
  - Desarrollo de aplicaciones -> CGI
  - Seguridad
  - Rendimiento
  - Herramientas de administración
- Agregar [URL Rewrite](https://www.iis.net/downloads/microsoft/url-rewrite)
- [PHP](https://windows.php.net/download/) (non-thread-safe version) 8.2 o superior
  - Quitar el comentario en php.ini de extension=mysqli y extension=openssl
  - Agregar PHP al PATH de las variables de entorno del sistema
- [MySQL Server](https://dev.mysql.com/downloads/mysql/8.0.html?os=2)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download)
- NPM

## 2. Desplegar el proyecto
- Copiar el proyecto dentro del servidor
```sh
C:\inetpub\wwwroot
```
- Instalar las dependencias
```sh
composer install --no-dev --optimize-autoloader
npm install
npm run build
```
- Copiar el archivo .env
```sh
copy .env.example .env
```
- Generar la key de la aplicación
```sh
php artisan key:generate
```
- Modificar la IP y URL dentro del archivo .env (si es necesario)
- Instalar el proyecto en IIS
- Agregar las IP en la tabla de hosts
```sh
127.0.0.1           localhost     
XXX.XX.XX.XXX       www.eiiadocumental.pucesi.edu.ec
```
- Correr migraciones y seeders
```sh
php artisan migrate:fresh --seed
```
- Dentro de MySQL cambiar el usuario administrador
```sh
UPDATE `bdd_eiiasgd`.`users` SET `name` = "[Nuevo usuario]", `email` = "[Nuevo email@pucesi.edu.ec]"  WHERE `id` = 1;
```
- Descargar el archivo de certificados de [CA](https://curl.se/ca/cacert.pem)
- Copiar cacert.pem en la carpeta de PHP
```sh
C:\php\extras\ssl\cacert.pem
```
- Editar php.ini con las líneas:
```sh
curl.cainfo = "C:\php\extras\ssl\cacert.pem"
openssl.cafile = "C:\php\extras\ssl\cacert.pem"
```
- Probar la aplicación con la IP del servidor o en www.eiiadocumental.pucesi.edu.ec

# Información
| Herramienta | Versión |
| ------ | ------ |
| PHP | 8.2 |
| Laravel | 11 |
| Vue | 3 |
| MySQL Server | 8.0.39 |

