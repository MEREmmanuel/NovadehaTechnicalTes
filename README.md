Hazlo en inglés
# Proyecto Laravel

Este es un proyecto basado en Laravel que utiliza Passport para autenticación y Swagger para documentación de la API.

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm (para compilación de assets)
- MySQL o SQLite (según la configuración de base de datos)

## Instalación

1. Clona el repositorio:
   
sh
   git clone <url-del-repositorio>
   cd <nombre-del-proyecto>


2. Instala las dependencias de PHP con Composer:
   
sh
   composer install


3. Instala las dependencias de Node.js:
   
sh
   npm install


4. Copia el archivo de entorno y configura las variables necesarias:
   
sh
   cp .env.example .env

   Luego, edita el archivo .env para configurar la conexión a la base de datos.

5. Genera la clave de la aplicación:
   
sh
   php artisan key:generate


6. Ejecuta las migraciones y los seeders:
   
sh
   php artisan migrate --seed


7. Genera la documentación de la API:
   
sh
   php artisan l5-swagger:generate


## Ejecución del Proyecto

Para levantar el servidor de desarrollo y otras tareas necesarias, usa el siguiente comando:
sh
composer run dev

Esto ejecutará Laravel, la cola de trabajo y Vite en paralelo.

También puedes ejecutar el servidor manualmente:
sh
php artisan serve


## Generación de Tokens de Autenticación (Laravel Passport)

Ejecuta el siguiente comando para configurar Passport:
sh
php artisan passport:install

Esto generará las claves de acceso para los tokens de autenticación.

## Documentación de la API

La documentación de la API generada con Swagger estará disponible en:
http://localhost:8000/api/documentation


## Compilación de Assets (Opcional)

Para compilar los assets con Vite, usa:
sh
npm run dev

Para una versión optimizada:
sh
npm run build