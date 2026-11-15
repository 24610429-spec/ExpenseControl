# ExpenseControl 💰

**Sistema de control y administración de gastos personales**

ExpenseControl es una aplicación web desarrollada con Laravel que permite administrar gastos personales mediante categorías, registrar movimientos, consultar información y visualizar estadísticas para facilitar el control financiero.

## 🚀 Características

- Registro, consulta, edición y eliminación de gastos.
- Administración de categorías.
- Asociación de gastos con sus respectivas categorías.
- Validación de datos para evitar registros incorrectos.
- Protección contra categorías duplicadas.
- Restricción para eliminar categorías que tengan gastos asociados.
- Panel principal con resumen de gastos.
- Estadísticas y gráficas de gastos.
- API REST con respuestas en formato JSON.
- Interfaz web para administrar la información.

## 🛠️ Tecnologías utilizadas

- PHP 8.2
- Laravel
- MySQL
- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- Chart.js

## 📋 Requisitos

- PHP 8.2 o superior.
- Composer.
- MySQL.
- XAMPP o un entorno de desarrollo compatible.
- Postman (para probar los endpoints de la API).

## ⚙️ Instalación

1. Clonar el repositorio:

   ```bash
   git clone URL_DEL_REPOSITORIO
   ```

2. Acceder al proyecto:

   ```bash
   cd ExpenseControl
   ```

3. Instalar dependencias:

   ```bash
   composer install
   ```

4. Crear el archivo `.env`:

   ```bash
   copy .env.example .env
   ```

5. Generar la clave de Laravel:

   ```bash
   php artisan key:generate
   ```

6. Crear una base de datos MySQL llamada `expensecontrol`.

7. Configurar las credenciales en `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=expensecontrol
   DB_USERNAME=root
   DB_PASSWORD=
   ```

8. Ejecutar las migraciones:

   ```bash
   php artisan migrate
   ```

9. Iniciar el servidor:

   ```bash
   php artisan serve
   ```

10. Abrir en el navegador:

   http://127.0.0.1:8000

## 📡 Endpoints de la API REST

Todas las rutas de la API utilizan el prefijo `/api`.

### Categorías

| Método | Endpoint | Descripción |
|---|---|---|
| GET | `/api/categorias` | Consultar todas las categorías |
| POST | `/api/categorias` | Registrar una categoría |
| GET | `/api/categorias/{id}` | Consultar una categoría |
| PUT/PATCH | `/api/categorias/{id}` | Actualizar una categoría |
| DELETE | `/api/categorias/{id}` | Eliminar una categoría |

### Gastos

| Método | Endpoint | Descripción |
|---|---|---|
| GET | `/api/gastos` | Consultar todos los gastos |
| POST | `/api/gastos` | Registrar un gasto |
| GET | `/api/gastos/{id}` | Consultar un gasto |
| PUT/PATCH | `/api/gastos/{id}` | Actualizar un gasto |
| DELETE | `/api/gastos/{id}` | Eliminar un gasto |

## 🔒 Validaciones y respuestas HTTP

La API implementa validaciones para garantizar la integridad de los datos.

| Código | Descripción |
|---|---|
| 200 | Operación realizada correctamente |
| 201 | Registro creado correctamente |
| 404 | Recurso no encontrado |
| 409 | Conflicto al eliminar una categoría con gastos asociados |
| 422 | Error de validación de datos |

## 🧪 Pruebas

Los endpoints pueden probarse utilizando Postman.

Para las solicitudes JSON se recomienda utilizar los siguientes encabezados:

- `Accept: application/json`
- `Content-Type: application/json`

## 👨‍💻 Autor

Proyecto académico desarrollado como práctica de programación y desarrollo de API REST utilizando Laravel.

## 📄 Licencia

Este proyecto utiliza el framework Laravel, distribuido bajo licencia MIT. La licencia del proyecto debe definirse según las condiciones de su autor.