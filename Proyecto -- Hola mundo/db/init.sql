-- ══════════════════════════════════════════════════════════════
--  Script de inicialización — holaMundoDB
--  Se ejecuta automáticamente la primera vez que MySQL arranca
-- ══════════════════════════════════════════════════════════════

USE holaMundoDB;

-- Tabla de ejemplo
CREATE TABLE IF NOT EXISTS mensajes (
    id         INT          AUTO_INCREMENT PRIMARY KEY,
    mensaje    VARCHAR(255) NOT NULL,
    creado_en  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- Registro inicial de prueba
INSERT INTO mensajes (mensaje) VALUES ('¡Hola Mundo desde MySQL!');
