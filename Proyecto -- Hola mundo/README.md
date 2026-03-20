# 🌍 Hola Mundo — PHP + MySQL + Docker Compose

Aplicación web mínima y profesional que demuestra cómo conectar
un servidor PHP/Apache a una base de datos MySQL usando Docker Compose.

---

## 📁 Estructura del proyecto

```
proyecto-hola-mundo/
├── src/
│   └── index.php          ← Código fuente de la aplicación
├── db/
│   └── init.sql           ← Script SQL ejecutado al iniciar MySQL
├── Dockerfile             ← Imagen del servidor PHP + Apache
├── docker-compose.yml     ← Orquestación de servicios
└── README.md
```

---

## 🚀 Cómo ejecutar

### Requisitos
- Docker Desktop (o Docker Engine + Docker Compose)

### Pasos

```bash
# 1. Clonar / entrar al directorio
cd proyecto-hola-mundo

# 2. Construir imágenes y levantar servicios
docker compose up --build

# 3. Abrir en el navegador
http://localhost:8080
```

### Detener servicios

```bash
docker compose down          # Detiene y elimina contenedores
docker compose down -v       # También elimina el volumen de datos MySQL
```

---

## ⚙️ Servicios

| Servicio | Imagen          | Puerto local | Descripción              |
|----------|-----------------|--------------|--------------------------|
| `app`    | php:8.2-apache  | 8080         | Servidor de aplicación   |
| `mysql`  | mysql:8.0       | 3307         | Base de datos            |

---

## 🔑 Variables de entorno

| Variable      | Valor por defecto | Descripción            |
|---------------|-------------------|------------------------|
| `DB_HOST`     | mysql             | Host de la BD          |
| `DB_NAME`     | holaMundoDB       | Nombre de la BD        |
| `DB_USER`     | appuser           | Usuario de la BD       |
| `DB_PASSWORD` | apppassword       | Contraseña del usuario |

> ⚠️ En producción usa un archivo `.env` y nunca subas credenciales al repositorio.

---

## 🛠️ Comandos útiles

```bash
# Ver logs en tiempo real
docker compose logs -f

# Acceder al contenedor PHP
docker exec -it hola_mundo_app bash

# Acceder a MySQL
docker exec -it hola_mundo_mysql mysql -u appuser -papppassword holaMundoDB
```
