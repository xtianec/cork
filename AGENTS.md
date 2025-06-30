# Instrucciones para agentes

Este repositorio implementa un sistema con arquitectura MVC en PHP.

## Organización
- `controlador/`: archivos de controladores (`*Controller.php`).
- `modelos/`: modelos de base de datos.
- `vistas/`: vistas asociadas a cada entidad.
- `config/`: contiene la conexión y utilidades.
- `app/`: recursos estáticos utilizados por las vistas.
- `index.php`: punto de entrada que resuelve la URL y carga el controlador y método solicitados.
- Los errores se registran en `logs/errors.log` mediante `logError()`.

## Contribuir
- Mantén el estilo existente y comentarios en español.
- Al crear una nueva funcionalidad sigue el patrón MVC: modelo, controlador y vista.
- Reutiliza la conexión definida en `config/Conexion.php` y usa `logError()` para registrar errores.

## Scripts útiles
- `scripts/generate_views.php` genera las vistas y archivos JS para un controlador cuando no existen.

## Pruebas
- Para validar la sintaxis de los archivos PHP modificados, ejecuta:
  ```
  php -l <archivo.php>
  ```
- Si `php` no está disponible, indica dicha limitación en la sección de pruebas.

# Repository Guidelines

This project uses the MySQL dump script `db.sql` to recreate the database `pacific_compressor`.
When modifying database-related code or the dump itself, follow these instructions:

1. Keep compatibility with MariaDB 10.4 syntax and defaults.
2. Use `ALTER TABLE` statements instead of re-creating tables when updating the schema.
3. Preserve existing default values, timestamps and foreign key constraints unless a change is required.
4. Document any new tables or schema changes directly in `db.sql` using SQL comments.
5. After editing the file, test the script by importing it with `mysql` or `phpMyAdmin` to ensure it runs cleanly.

These guidelines apply to the whole repository.
