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

## Estructura principal

- `ComisionController`: valida las fechas y devuelve la respuesta.
- `CalculadorComisiones`: contiene el cálculo de las comisiones.
- `Vendedor`, `Venta` y `Regla`: modelos de la aplicación.
- `Comisiones.vue`: formulario y presentación de resultados.
