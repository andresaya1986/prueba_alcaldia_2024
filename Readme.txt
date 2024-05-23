##Parte 1
#1. Conéctate a una base de datos MySQL.
use prueba_aya_alcaldia24;

#2. Crea una tabla llamada usuarios con los siguientes campos: id (autoincremental), nombre, email y contraseña.
CREATE TABLE `prueba_aya_alcaldia24`.`usuarios` (
	`id` INT NOT NULL AUTO_INCREMENT , 
	`nombre` VARCHAR(255) NOT NULL , 
	`correo` VARCHAR(255) NOT NULL UNIQUE, 
	`password` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)) ENGINE = InnoDB;

#3. Inserta al menos tres registros en la tabla usuarios.	
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`) VALUES (NULL, 'Jaime Aya', 'jaimeandresaya@gmail.com', 'aya7412*24');
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`) VALUES (NULL, 'Andres Aya', 'jaimeandresayaluna@outlook.com', '25ad123*@');
INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`) VALUES (NULL, 'Ricardo Restrepo', 'ricrestrepo@gmail.com', 'rr2024*#2598');

#4. Implementa una función que reciba el email de un usuario como parámetro y devuelva su nombre.
DELIMITER $$

CREATE FUNCTION obtener_nombre_por_correo(email VARCHAR(255)) 
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    DECLARE nombreret VARCHAR(255);
    
    SELECT nombre INTO nombreret
    FROM usuarios
    WHERE correo = email
    LIMIT 1;
    
    RETURN nombreret;
END $$

DELIMITER ;

#llamado a la funcion
SELECT obtener_nombre_por_correo('jaimeandresaya@gmail.com') AS nombre;

#5. Implementa una función que reciba el nombre de un usuario como parámetro y actualice su contraseña en la base de datos.
DELIMITER $$

CREATE FUNCTION actualizar_clave_por_nombre(
    userName VARCHAR(255), 
    newPassword VARCHAR(255)
) 
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    DECLARE mensaje VARCHAR(255);
    
    UPDATE usuarios
    SET password = newPassword
    WHERE nombre = userName;
    
    IF ROW_COUNT() > 0 THEN
        SET mensaje = 'Contraseña actualizada correctamente.';
    ELSE
        SET mensaje = 'Usuario no encontrado.';
    END IF;
    
    RETURN mensaje;
END $$

DELIMITER ;

#llamado a la funcion
SELECT actualizar_clave_por_nombre('Jaime Aya', 'nuevaContraseña123') AS resultado;


##parte 2
#1. Ejecute una tarea automática programada que se ejecute cada día a las 12:00 PM.
#2. La tarea automática debe realizar una copia de seguridad de la base de datos MySQL creada en la Parte 1 y almacenarla en una carpeta específica del servidor.

#!/bin/bash

# Configuración
USER="root"
PASSWORD=""
DATABASE="prueba_aya_alcaldia24"

BACKUP_DIR="/copias_backup/"
DATE=$(date +\%F)

# Crear la carpeta de backup si no existe
mkdir -p $BACKUP_DIR

# Realizar la copia de seguridad
mysqldump -u $USER -p$PASSWORD $DATABASE > $BACKUP_DIR/backup_$DATABASE_$DATE.sql

# Confirmar que la copia de seguridad se ha realizado
if [ $? -eq 0 ]; then
    echo "Copia de seguridad realizada con éxito el $DATE"
else
    echo "Error al realizar la copia de seguridad el $DATE"
fi

# darle permisos para crear el archivo
chmod +x backup_mysql.sh

# abre el archivo crontab
crontab -e

# se agrega la línea para que tome el comando automatico
0 12 * * * /copias_backup/backup_mysql.sh


##parte 3
se publica la carpeta prueba_jaal con los ficheros y archivos del proyecto php

##parte 4

# por nodejs se conecta a mongo DB y se crea el archivo crear_productos.js con la conexión y la inserción en la collección productos
node crear_productos.js

##parte 5
se crea la carpeta miproyecto_mongo

##parte 6
se crea la carpeta miApp en la carpeta miproyecto_mongo