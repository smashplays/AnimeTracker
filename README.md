# AnimeTracker

AnimeTracker es una aplicación hecha para poder hacer un seguimiento de los animes que uno está viendo, a través de una lista
con los mismos, una lista de capítulos que pueden ser marcados como visto o no visto y un calendario para ver la fecha de próximos capítulos.

## Instalación

Una vez clonado el repositorio o descargados los archivos haremos unas instalaciones necesarias, tanto en el Backend como en el Frontend.

### Backend

Entraremos en la carpeta AnimeTrackerBackend.

```bash
  cd AnimeTrackerBackend
```

Instalaremos las dependencias (necesario tener [PHP](https://www.php.net/downloads) y [Composer](https://getcomposer.org/) instalados).

```bash
  composer install
```

Ahora abriremos el archivo **.env.example** y lo duplicaremos, ese duplicado lo renombraremos como **.env** y añadiremos algunos datos, como por ejemplo el nombre de la base de datos que será **animetracker**.

![plot](./AnimeTrackerFrontend/Capturas%20Readme/Archivo-env.png)

Ahora vamos a ejecutar unos cuantos comandos, entre varias cosas para crear la base de datos, generar una key de encriptación y poder hacer funcionar el sistema de login (que es Passport).

```bash
    php artisan migrate
    php artisan key:generate
    php artisan passport:install
```

Y vamos a ejecutar el siguiente comando para tener unos cuantos usuarios por defecto (revisar el archivo UsersSeeder en database/seeders para ver las contraseñas sin cifrar).

```bash
    php artisan db:seed --class=UsersSeeder
```

Para terminar con el backend lanzaremos el siguiente comando para ejecutar Laravel (importante estar ejecutando un servidor de base de datos para que funcione).

```bash
    php artisan serve
```

### Frontend

Ahora volveremos a la carpeta raíz del proyecto.

```bash
    cd ..
```

Iremos a la carpeta AnimeTrackerFrontend e instalaremos las dependencias (requiere tener [npm](https://nodejs.org/es) instalado)

```bash
  cd AnimeTrackerFrontend
  npm install
```

Una vez finalizada la instalación, ejecutaremos el siguiente comando para abrir la aplicación en nuestro navegador por defecto (requiere tener instalado [Angular CLI](https://angular.io/cli) de manera global)

## Capturas y explicación

Lo primero que veremos al ejecutar será la pantalla de login, la cual tiene también un botón para ir a la pantalla de registro en caso de no tener una cuenta

![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Login.png)
![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Register.png)

Una vez iniciemos sesión o nos registremos seremos dirigidos a una vista con los animes mejor valorados, el cual tiene paginación.

![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Rated%20Anime%20and%20Portada.png)

Tras pasearnos por los animes mejores valorados nos puede apetecer ver alguno de ellos, entonces podemos hacer clic en la foto y seremos redirigidos a una vista más detallada del mismo.

![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Detail%20Anime%20Info.png)

Dandole al botón grande debajo del nombre podemos añadir el anime a nuestra lista personal, si la serie es muy nueva podemos ir a home y ver los capitulos más recientes en un calendario.

![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Calendar.png)

Otra forma de buscar series es con el buscador que tenemos en la parte derecha de la barra de navegación, es un buscador que responde con una sugerencia a lo que le escribamos, una vez encontrado la serie que queremos clicamos encima de ella

![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Searching.png)

Para terminar podemos ver nuestra propia lista y seleccionar una serie, una vez dentro podemos marcar episodios como vistos o no vistos

![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Personal%20List.png)
![App Screenshot](./AnimeTrackerFrontend/Capturas%20Readme/Personal%20Anime%20Info.png)
