CREATE DATABASE Estacionamiento;

use Estacionamiento;

CREATE TABLE IF NOT EXISTS perfiles (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO 
  `Perfiles`(`nombre`) 
VALUES 
  ("user"),
  ("admin");

CREATE TABLE IF NOT EXISTS sexos (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO 
  `Sexos`(`nombre`) 
VALUES 
  ("Masculino"),
  ("Femenino");

CREATE TABLE IF NOT EXISTS turnos (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO 
  `Turnos`(`nombre`) 
VALUES 
  ("mañana"),
  ("tarde"), 
  ("noche");

CREATE TABLE IF NOT EXISTS cocheras (
    `id` INT NOT NULL AUTO_INCREMENT,
    `ReservadoDiscEmbar` BOOLEAN  NOT NULL DEFAULT 0,
    `nombre` VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO 
  `Cocheras`(`ReservadoDiscEmbar`,`nombre`) 
VALUES 
  ("1","102"),
  ("1","283"), 
  ("1","197"),
  ("0","151"),
  ("0","127"),
  ("0","387");

CREATE TABLE IF NOT EXISTS empleados (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(50) UNIQUE NOT NULL,
    `password` VARCHAR(50) NOT NULL,    
    `turno` INT NOT NULL,
    `sexo` INT NOT NULL,
    `perfil` INT NOT NULL,
    `suspendido` BOOLEAN  NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`turno`) REFERENCES `Turnos`(`id`),
    FOREIGN KEY (`sexo`) REFERENCES `Sexos`(`id`),
    FOREIGN KEY (`perfil`) REFERENCES `Perfiles`(`id`)
);

INSERT INTO 
  `Empleados`(`email`, `password`, `turno`, `sexo`, `perfil`,`suspendido`) 
VALUES 
  ("Vladimir001@estacionamiento.com","25021544","1","1","2","0"), 
  ("Jorge001@estacionamiento.com","45678921","2","1","1","0"), 
  ("Dulce001@estacionamiento.com","42512354","3","2","1","0"),
  ("suspendido001@estacionamiento.com","suspendido001@estacionamiento.com","1","1","1","1");

CREATE TABLE IF NOT EXISTS logueos (
    `id` INT NOT NULL AUTO_INCREMENT,
    `empleado` INT,
    `fecha` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`empleado`) REFERENCES `Empleados`(`id`) ON DELETE SET NULL
);

INSERT INTO 
  `Logueos`(`empleado`,`fecha`) 
VALUES 
  ("1",CURRENT_TIME),
  ("2",CURRENT_TIME),
  ("3",CURRENT_TIME),
  ("1",CURRENT_TIME),
  ("2",CURRENT_TIME),
  ("3",CURRENT_TIME);

CREATE TABLE IF NOT EXISTS vehiculos (
    `id` INT NOT NULL AUTO_INCREMENT,
    `patente` VARCHAR(50) NOT NULL,
    `Color` VARCHAR(50) NOT NULL,
    `Marca` VARCHAR(50) NOT NULL,
    `Foto` VARCHAR(50) NOT NULL,
    `IDEmpleadoIngreso` INT,
    `HoraDeEntrada` DATETIME NOT NULL,
    `Cochera` INT NOT NULL,
    `IDEmpleadoSalida` INT,
    `HoraDeSalida` DATETIME,
    `importe` Decimal(19,2),
    `tiempo_seg` BIGINT,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`IDEmpleadoIngreso`) REFERENCES `Empleados`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`IDEmpleadoSalida`) REFERENCES `Empleados`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`Cochera`) REFERENCES `Cocheras`(`id`)
);

INSERT INTO 
  `Vehiculos`(`patente`, `Color`, `Marca`, `Foto`,`IDEmpleadoIngreso`,`HoraDeEntrada`,`Cochera`) 
VALUES 
  ("ABC123","Rojo","Peugeot","1_ABC123.png","1","2017-10-31 13:12:05","2"), 
  ("ABC124","Azul","Peugeot","1_ABC124.png","2","2017-10-31 15:24:05","5"), 
  ("ABC125","Verde","Peugeot","1_ABC125.png","3","2017-10-31 23:09:12","5"),
  ("ABC126","Blanco","Peugeot","1_ABC126.png","1","2017-10-31 13:12:05","3"), 
  ("ABC127","Negro","Peugeot","1_ABC127.png","2","2017-10-31 15:24:05","5"), 
  ("ABC129","Gris","Peugeot","1_ABC129.png","3","2017-10-31 23:09:12","3");

