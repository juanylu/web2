
create database postclickuni;
use postclickuni;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('admin', 'usuario') DEFAULT 'usuario',
    foto_perfil longblob,
    fecha_nacimiento DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //
CREATE PROCEDURE sp_insertar_usuario
(
	IN _Nombre VARCHAR(50),
    IN _Email VARCHAR(50),
    IN _Password VARCHAR(255),
    IN _FechaNacimiento DATE,
    IN _FotoPerfil LONGBLOB
)
BEGIN
	INSERT INTO usuarios(nombre, email, password, fecha_nacimiento, foto_perfil)
    VALUES(_Nombre, _Email, _Password, _FechaNacimiento, _FotoPerfil);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_select_usuarios()
BEGIN
	SELECT nombre, email, password, fecha_nacimiento, foto_perfil FROM usuarios;
END //
DELIMITER ;

DELIMITER //


CREATE PROCEDURE sp_actualizar_usuario
(
	IN _Id INT,
    IN _Nombre VARCHAR(50),
    IN _Email VARCHAR(50),
    IN _Password VARCHAR(255),
    IN _FechaNacimiento DATE,
    IN _FotoPerfil LONGBLOB
)
BEGIN
	UPDATE usuarios 
    SET nombre = _Nombre, email = _Email, password = _Password, fecha_nacimiento = _FechaNacimiento, foto_perfil = _FotoPerfil
    WHERE id = _Id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_select_usuario_por_id
(
	IN _Id BIGINT
)
BEGIN
	SELECT nombre, email, password, fecha_nacimiento, foto_perfil
    FROM usuarios
    WHERE id = _Id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_eliminar_usuario
(
	IN _Id BIGINT
)
BEGIN
	DELETE FROM usuarios
    WHERE id = _Id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_iniciar_sesion
(
    IN _Email VARCHAR(50),
    IN _Password VARCHAR(255)
)
BEGIN
    SELECT id, nombre, email, tipo_usuario 
    FROM usuarios 
    WHERE email = _Email AND password = _Password;
END //
DELIMITER ;




-- TEN CUIDADO ESTO DESACTIVA LAS FK TEMPORALMENTE
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE comentarios;
SET FOREIGN_KEY_CHECKS = 1;

-- TABLA CATEGORIA

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLA PUBLICACIONES
CREATE TABLE publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    contenido TEXT NOT NULL,
    imagen LONGBLOB,
    categoria_id INT NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- TABLA PARA REACCIONES

CREATE TABLE reacciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    publicacion_id INT NOT NULL,
    tipo ENUM('like', 'dislike') NOT NULL,
    UNIQUE(usuario_id, publicacion_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (publicacion_id) REFERENCES publicaciones(id)
);

-- TABLA COMENTARIOS

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenido TEXT NOT NULL,
    usuario_id INT NOT NULL,
    publicacion_id INT NOT NULL,
    fecha_comentario DATETIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (publicacion_id) REFERENCES publicaciones(id)
);














-- ACTUALIZACION DEL CHAT
use postclick;

CREATE TABLE IF NOT EXISTS chat (
	Id BIGINT AUTO_INCREMENT,
    Mensaje VARCHAR(255),
    Id_Primer_Usuario INT,
    Id_Segundo_Usuario INT,
    Id_Usuario_Mensaje INT,
    PRIMARY KEY(Id)
);


DELIMITER //
CREATE PROCEDURE sp_insertar_mensaje
(
	_Mensaje VARCHAR(255),
    _Id_Primer_Usuario INT,
    _Id_Segundo_Usuario INT,
    _Id_Usuario_Mensaje INT
)
BEGIN
	INSERT INTO chat(Mensaje, Id_Primer_Usuario, Id_Segundo_Usuario, Id_Usuario_Mensaje)
    VALUES(_Mensaje, _Id_Primer_Usuario, _Id_Segundo_Usuario, _Id_Usuario_Mensaje);
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE sp_select_usuario_por_nombre
(
	IN _Nombre VARCHAR(50)
)
BEGIN
	SELECT id, nombre, email, password, fecha_nacimiento, foto_perfil
    FROM usuarios
    WHERE nombre = _Nombre;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE sp_obtener_mensajes
(
	_Id_Primer_Usuario INT,
    _Id_Segundo_Usuario INT
)
BEGIN
	SELECT C.Mensaje, U.nombre, U.id, U.foto_perfil
    FROM chat C
    INNER JOIN usuarios U
    ON C.Id_Usuario_Mensaje = U.id
    WHERE 
		(C.Id_Primer_Usuario = _Id_Primer_Usuario AND C.Id_Segundo_Usuario = _Id_Segundo_Usuario)
        OR
        (C.Id_Primer_Usuario = _Id_Segundo_Usuario AND C.Id_Segundo_Usuario = _Id_Primer_Usuario);
END //
DELIMITER ;

-- TABLA NUEVA MENSAJES

CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emisor_id INT NOT NULL,
    receptor_id INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio DATETIME NOT NULL,
    FOREIGN KEY (emisor_id) REFERENCES usuarios(id),
    FOREIGN KEY (receptor_id) REFERENCES usuarios(id)
);

CREATE TABLE musica_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    cancion VARCHAR(255) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- PARA REPORTES 


DELIMITER //
CREATE PROCEDURE sp_contar_usuarios(OUT total INT)
BEGIN
    SELECT COUNT(id) INTO total FROM usuarios;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_contar_usuarios_simple()
BEGIN
    SELECT COUNT(id) AS total_usuarios FROM usuarios;
END //
DELIMITER ;

-- REPORTE CONTEO PUBLICACIONES

DELIMITER //
CREATE PROCEDURE sp_contar_publicaciones_simple()
BEGIN
    SELECT COUNT(id) AS total_publicaciones FROM publicaciones;
END //
DELIMITER ;

-- REPORTE CONTEO DE PUBLICACIONES DE USUARIO POR NOMBRE
DELIMITER //
CREATE PROCEDURE sp_contar_publicaciones_usuario(IN nombre_usuario VARCHAR(50))
BEGIN
    SELECT COUNT(p.id) AS total_publicaciones
    FROM publicaciones p
    INNER JOIN usuarios u ON p.usuario_id = u.id
    WHERE u.nombre = nombre_usuario;
END //
DELIMITER ;








DELIMITER //
CREATE PROCEDURE ObtenerPublicacionesPorUsuario(IN usuarioId INT)
BEGIN
    SELECT p.id, p.contenido, p.imagen, p.fecha_publicacion, c.nombre AS categoria
    FROM publicaciones p
    JOIN categorias c ON p.categoria_id = c.id
    WHERE p.usuario_id = usuarioId
    ORDER BY p.fecha_publicacion DESC;
END //
DELIMITER ;

