# Pila LEMP (Nginx + MariaDB + PHP-FPM) con Docker Compose
Pila LEMP completa y en una versión moderna y actualizada, ideal para levantar en segundos sin saber tanto de docker y poder así comenzar a practicar y aprender.


Este repositorio proporciona una configuración moderna y funcional de la pila LEMP, orquestada mediante Docker Compose. Incluye MariaDB (base de datos) y phpMyAdmin para la gestión visual de la DB, todo listo para desarrollo.

##  Estructura del Proyecto

Asegúrate de que tu proyecto tenga la siguiente estructura de carpetas y archivos. Si faltan directorios, créalos.. aunque en principio los he dejado todos aqui, no deberia fallarte ni faltarte nada. (espero que entiendas la estructura de directorios, me costo hacerla legible, si sabes otra forma de organizarla en el readme acepto commits previa aprobacion).

├── app/
│   └── index.php           # Código de la aplicación (Web Root)

├── config/
│   └── nginx/
│       └── default.conf    # Configuración principal de Nginx

├── docker/
│   └── php.Dockerfile      # Configuración de la imagen PHP (añade extensiones)

├── .env                    # Variables de entorno (credenciales y puertos)
└── docker-compose.yml      # Definición de servicios (El orquestador)


##  Requisitos Previos

Antes de comenzar, asegúrate de tener instalado y configurado lo siguiente:
Docker: Entorno de ejecución de contenedores.
Docker Compose (o Docker CLI v2): Herramienta para definir y ejecutar aplicaciones multi-contenedor.


#  Archivos de Configuración Esenciales

1. Archivo .env (Variables de Entorno)Este archivo es crucial para las credenciales de MariaDB y debe estar en la raíz del proyecto. Personaliza los valores (especialmente las contraseñas).

### --- Configuración de la Aplicación ---

APP_NAME=mi_proyecto_lemp
APP_ENV=development

### --- Configuración de MariaDB ---
MYSQL_ROOT_PASSWORD=TuContraseñaRootSegura
MYSQL_DATABASE=my_app_db
MYSQL_USER=my_app_user
MYSQL_PASSWORD=TuContraseñaUsuarioSegura

2. Archivo config/nginx/default.conf
   
Este archivo le indica a Nginx cómo manejar las peticiones, especialmente cómo pasar los archivos .php al contenedor php:9000. 
  Nota: Este archivo ya debe estar configurado con la lógica de doble bloque (location / y location ~ \.php$).
  
3. Archivo docker/php.DockerfileDefine que la imagen de PHP incluya las extensiones necesarias para conectar con MariaDB.FROM php:8.3-fpm-alpine
RUN docker-php-ext-install pdo pdo_mysql mysqli \
    && rm -rf /tmp/*

# ⚙️ Proceso de Instalación y EjecuciónSigue estos pasos para levantar toda la pila:

**Paso 1: Clonar el Repositorio**

Clona este repositorio en tu máquina local: git clone y clonas el repo
cd [nombre del repositorio] (esto en tu maquina, no te lies)

**Paso 2: Configurar las Variables de Entorno**

Crea el archivo .env si no existe (que si lo haces bien deberia existir porque repito, aqui esta todo) y rellénalo con las variables de credenciales descritas anteriormente.

**Paso 3: Construir y Levantar los Contenedores**

Utiliza docker compose up con la bandera --build para construir la imagen de PHP y levantar todos los servicios en segundo plano (-d): `docker compose up -d --build`

**Paso 4: Verificar el Estado de los Servicios**

Asegúrate de que todos los contenedores estén en estado Up (activo): docker compose ps (y miras que se hayan iniciado todos)

#  Acceso a los Servicios

Esto lo podras hacer si lo hiciste bien y seguiste todos los pasos de arriba.

Una vez que todos los servicios estén levantados, puedes acceder a tu entorno usando las credenciales que hayas puesto en el .env

🛑 Detener y Limpiar

  Para detener y eliminar todos los contenedores y redes creadas (manteniendo los datos de MariaDB): docker compose down
  Si deseas eliminar también los datos persistentes de la base de datos (el volumen mariadb_data):docker compose down --volumes


Si llegaste hasta aqui y despues de un rato de intentar implementar el stack y al final de ha funcionado, te agradeceria que me dejaras tu estrella, para mi es de ayuda que se reconozca el esfuerzo que le he puesto a esto.

**www.linkedin.com/in/bryanlozanoaguilar**
