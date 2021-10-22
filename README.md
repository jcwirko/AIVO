## Challenge AIVO

Por cuestiones de tiempo esta prueba la hice con Laravel que es el framework que más conozco, pero
lo aplicado acá también se haría con Slim!

 ## Setup 
 
* Copiar `.env.local` a `.env`
* Levantar los contenedores: `./vendor/bin/sail up`
* Ingresas al contenedor `docker exec -it aivo_aivo_1 bash`
    * Ejecutar `composer install`
* Importar Postman que se encuentra en `/postman/aviso.postman_collection`

 
 ## Consideraciones
 
  Hay dos endpoints, uno que devuelve todos los artistas y otro que devuelve el album
  de un artista. Esto es así ya que el endpoint que devuelve los artistas busca por
  coincidencia y devuelve varios, entonces de ahí obtenemos el ID y vamos
  a buscar los albums.
  
  1. Artistas: `http://0.0.0.0/api/v1/spotify/artistas?q="los piojos"`
  2. Albums: `http://0.0.0.0/api/v1/spotify/discografia-by-banda?q=0SnyKkoyBaB2fG8IJH4xmU`
 
 * Branch `git checkout main`
 * Ruta `/api/v1/albums?q=[banda]` dentro de  `routes/api.php`
 
 * Se agregó spotify como servicio en `config/services`
 
## Planteamiento

* Se agrego las siguientes clases 
* Un adapter que se encarga de la comunicación con spotify `app/Adapters/SpotifyAdaptaer.php` 
e implementa una interfaz `app/Contracts/MusicaService.php` 
* Un resource que realiza el formateo de los datos antes de ser devueltos al front `app/Http/Resources/MusicaResources.php` 
* Las variables de entorno utilizadas dentro del adapter se encuentran en `/config/services.php`

## TEST

Los tests a realizar que se harían en este escenario serían:

* Unit Tests: 
    * Testear los métodos del adaptador mockeado, tanto con exceptions como casos de exito.
    * Testear el resource para el formateo de los datos
    
* Integration test
    * Testear los endpoints con el adapter mockeado tanto los
       casos correctos como las exceptios
       
* E2E
    * Testear los endpoints sin mockear el adapter y aca se puede 
    
 En caso de ser necesaria esta implementación la puedo hacer, pero ahora
 presento así para no atrasar más la prueba.   