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
	SELECT id FROM usuarios WHERE email = _Email AND password = _Password;
END //
DELIMITER ;



