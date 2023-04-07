# API Rest de Votaciones

Este es un pequeño proyecto de API Rest desarrollado en PHP 7.4 con Composer y con una base de datos MySQL 5.7.24 para manejar votaciones.

## Endpoints

A continuación se describen los diferentes endpoints que se pueden utilizar en esta API:

### Consulta Regiones

Obtiene una lista de todas las regiones.

- Método: GET
- Endpoint: /region

### Consulta Comunas

Obtiene una lista de todas las comunas filtradas por una región en particular.

- Método: GET
- Endpoint: /comuna/region/{regionId}
- Parámetros:
    - regionId: el ID de la región por la que se desea filtrar.

### Consulta Candidatos

Obtiene una lista de todos los candidatos.

- Método: GET
- Endpoint: /candidato

### Consulta Cómo nos Conociste

Obtiene una lista de las diferentes formas en que el usuario puede haber conocido el sistema de votación.

- Método: GET
- Endpoint: /como-conociste

### Consulta si ya se Registró una Votación

Comprueba si se ha registrado una votación para un rut en particular.

- Método: GET
- Endpoint: /votacion/existe/{rut}
- Parámetros:
    - rut: el RUT del votante que se desea verificar.

### Consulta Resultados

Obtiene los resultados de todas las votaciones.

- Método: GET
- Endpoint: /votacion/resultados

### Guarda Votación

Guarda una nueva votación.

- Método: POST
- Endpoint: /votacion/guarda

## Instalación

Para instalar la aplicación, sigue estos pasos:

1. Descarga o clona el repositorio en tu computadora.
2. Instala las dependencias utilizando Composer: `composer install`.
3. Crea una base de datos para la aplicación.
4. Importar el archivo `SQL/votaciones.sql` en la base de datos
5. Copia el archivo `.env.example` y renómbralo como `.env`. Luego, modifica las variables de entorno para que coincidan con tu configuración de base de datos.
6. Inicia la aplicación: `php -S localhost:8000`.
