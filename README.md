## Challenge AIVO

Por cuestiones de tiempo esta prueba la hice con Laravel que es el framework que más conozco, pero
lo aplicado acá también se haría con Slim!

## Setup

 1. Levantar el proyecto con docker `cd aivo && ./vendor/bin/sail up`
 2. Escucha en el puerto `http://0.0.0.0:80`
 
 ## Consideraciones
 
 * Ruta `/api/v1/albums?q=[banda]` dentro de  `routes/api.php`
 
 * Se agregó spotify como servicio en `config/services`
 
 ### Test  