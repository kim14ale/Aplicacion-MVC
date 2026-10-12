# Comisiones de vendedores

Aplicación académica desarrollada con Laravel 12 y Vue 3. Permite consultar las
ventas realizadas en un rango de fechas y calcular la comisión total de cada
vendedor según reglas definidas por monto.

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- SQLite (configuración predeterminada) o PostgreSQL

## Instalación

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
```

Crea el archivo `database/database.sqlite` o configura otra base de datos en
`.env`. Después ejecuta:

```powershell
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

La aplicación estará disponible en `http://127.0.0.1:8000/comisiones`.

Para trabajar con recarga automática del frontend, usa `npm run dev` en otra
terminal en lugar de `npm run build`.

## Despliegue de demostración en Render

El proyecto incluye `Dockerfile` y `render.yaml`. El despliegue usa SQLite y
vuelve a crear los datos de ejemplo mediante los seeders cada vez que inicia el
contenedor. Esta configuración es adecuada para una demostración, pero no para
guardar información nueva de forma permanente.

1. Sube el proyecto a un repositorio de GitHub.
2. Genera una clave para producción con `php artisan key:generate --show`.
3. En Render selecciona **New > Blueprint** y conecta el repositorio.
4. Cuando Render solicite `APP_KEY`, pega la clave generada en el paso anterior.
5. Confirma la creación del servicio y espera a que finalice el despliegue.

Render detectará `render.yaml`, construirá Vue, instalará Laravel, ejecutará
las migraciones y cargará las ventas de ejemplo automáticamente.

## Estructura principal

- `ComisionController`: valida las fechas y devuelve la respuesta.
- `CalculadorComisiones`: contiene el cálculo de las comisiones.
- `Vendedor`, `Venta` y `Regla`: modelos de la aplicación.
- `Comisiones.vue`: formulario y presentación de resultados.
