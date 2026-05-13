CREATE DATABASE IF NOT EXISTS mx3l CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mx3l;

DROP TABLE IF EXISTS repartiments;
DROP TABLE IF EXISTS linies_comanda;
DROP TABLE IF EXISTS comandes;
DROP TABLE IF EXISTS productes;
DROP TABLE IF EXISTS clients;
DROP TABLE IF EXISTS usuaris;
DROP TABLE IF EXISTS estats_comanda;
DROP TABLE IF EXISTS rols;

CREATE TABLE rols (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    descripcio VARCHAR(255)
);

CREATE TABLE usuaris (
    id_usuari INT AUTO_INCREMENT PRIMARY KEY,
    id_rol INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    estat VARCHAR(20) DEFAULT 'actiu',
    FOREIGN KEY (id_rol) REFERENCES rols(id_rol)
);

CREATE TABLE clients (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    id_usuari INT NOT NULL,
    nom_comercial VARCHAR(150) NOT NULL,
    nif_cif VARCHAR(20),
    adreca VARCHAR(255),
    telefon VARCHAR(30),
    tipus_client VARCHAR(50),
    descompte DECIMAL(5,2) DEFAULT 0,
    FOREIGN KEY (id_usuari) REFERENCES usuaris(id_usuari)
);

CREATE TABLE productes (
    id_producte INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    categoria VARCHAR(80),
    format VARCHAR(100),
    preu_base DECIMAL(10,2) NOT NULL,
    estoc INT DEFAULT 0,
    imatge VARCHAR(150),
    actiu TINYINT(1) DEFAULT 1
);

CREATE TABLE estats_comanda (
    id_estat INT AUTO_INCREMENT PRIMARY KEY,
    nom_estat VARCHAR(50) NOT NULL UNIQUE,
    descripcio VARCHAR(255),
    ordre_flux INT
);

CREATE TABLE comandes (
    id_comanda INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_estat INT NOT NULL,
    data_comanda DATETIME DEFAULT CURRENT_TIMESTAMP,
    import_total DECIMAL(10,2) DEFAULT 0,
    observacions TEXT,
    FOREIGN KEY (id_client) REFERENCES clients(id_client),
    FOREIGN KEY (id_estat) REFERENCES estats_comanda(id_estat)
);

CREATE TABLE linies_comanda (
    id_linia INT AUTO_INCREMENT PRIMARY KEY,
    id_comanda INT NOT NULL,
    id_producte INT NOT NULL,
    quantitat INT NOT NULL,
    preu_unitari DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_comanda) REFERENCES comandes(id_comanda),
    FOREIGN KEY (id_producte) REFERENCES productes(id_producte)
);

CREATE TABLE repartiments (
    id_repartiment INT AUTO_INCREMENT PRIMARY KEY,
    id_comanda INT NOT NULL,
    id_camioner INT NOT NULL,
    data_sortida DATETIME,
    data_entrega DATETIME,
    incidencia TEXT,
    FOREIGN KEY (id_comanda) REFERENCES comandes(id_comanda),
    FOREIGN KEY (id_camioner) REFERENCES usuaris(id_usuari)
);

INSERT INTO rols (nom, descripcio) VALUES
('client', 'Client professional amb accés al portal'),
('client_especial', 'Client amb descompte comercial'),
('magatzem', 'Treballador de magatzem'),
('camioner', 'Repartidor o conductor'),
('tecnic', 'Tècnic informàtic'),
('admin', 'Administrador del sistema');

INSERT INTO usuaris (id_rol, nom, email, password_hash, estat) VALUES
(1, 'Client Bar La Plaça', 'client@mx3l.cat', '$2y$12$Ydk12QfSsZcqwoKIAd6oAO7DDYVnbTJXXQWQ9fFUUQl4f96OpS0ru', 'actiu'),
(2, 'Client Especial El Racó', 'especial@mx3l.cat', '$2y$12$Ydk12QfSsZcqwoKIAd6oAO7DDYVnbTJXXQWQ9fFUUQl4f96OpS0ru', 'actiu'),
(3, 'Treballador Magatzem', 'magatzem@mx3l.cat', '$2y$12$Ydk12QfSsZcqwoKIAd6oAO7DDYVnbTJXXQWQ9fFUUQl4f96OpS0ru', 'actiu'),
(4, 'Camioner Mx3L', 'camioner@mx3l.cat', '$2y$12$Ydk12QfSsZcqwoKIAd6oAO7DDYVnbTJXXQWQ9fFUUQl4f96OpS0ru', 'actiu'),
(5, 'Tècnic Mx3L', 'tecnic@mx3l.cat', '$2y$12$Ydk12QfSsZcqwoKIAd6oAO7DDYVnbTJXXQWQ9fFUUQl4f96OpS0ru', 'actiu'),
(6, 'Administrador Mx3L', 'admin@mx3l.cat', '$2y$12$Ydk12QfSsZcqwoKIAd6oAO7DDYVnbTJXXQWQ9fFUUQl4f96OpS0ru', 'actiu');

INSERT INTO clients (id_usuari, nom_comercial, nif_cif, adreca, telefon, tipus_client, descompte) VALUES
(1, 'Bar La Plaça', 'B12345678', 'Plaça Major 12, Saragossa', '976111222', 'normal', 0.00),
(2, 'Restaurant El Racó', 'B87654321', 'Carrer Centre 8, Saragossa', '976333444', 'especial', 10.00),
(1, 'Cafeteria Central', 'B11223344', 'Avinguda Estació 25, Saragossa', '976555666', 'normal', 0.00);

INSERT INTO estats_comanda (nom_estat, descripcio, ordre_flux) VALUES
('pendent', 'Comanda rebuda pendent de preparar', 1),
('en preparació', 'Comanda en procés de preparació al magatzem', 2),
('preparada', 'Comanda preparada per repartir', 3),
('en repartiment', 'Comanda en ruta de repartiment', 4),
('entregada', 'Comanda entregada al client', 5),
('incidència', 'Comanda amb incidència registrada', 6);

INSERT INTO productes (nom, categoria, format, preu_base, estoc, imatge, actiu) VALUES
('Pack Coca-Cola 24 llaunes', 'Refrescos', 'Pack 24 llaunes 330ml', 18.50, 120, 'cocacola_pack.jpg', 1),
('Pack Pepsi 24 llaunes', 'Refrescos', 'Pack 24 llaunes 330ml', 17.90, 100, 'pepsi_pack.jpg', 1),
('Pack Coca-Cola Zero 24 llaunes', 'Refrescos', 'Pack 24 llaunes 330ml', 18.70, 95, 'cocacola_zero_pack.jpg', 1),
('Caixa San Miguel 24 ampolles', 'Cervesa', 'Caixa 24 ampolles 330ml', 21.80, 80, 'sanmiguel_caixa.jpg', 1),
('Caixa Mahou 24 ampolles', 'Cervesa', 'Caixa 24 ampolles 330ml', 22.10, 75, 'mahou_caixa.jpg', 1),
('Caixa San Miguel 0,0 24 ampolles', 'Cervesa sense alcohol', 'Caixa 24 ampolles 330ml', 20.90, 60, 'sanmiguel_00_caixa.jpg', 1),
('Pack Schweppes Tònica 24 ampolles', 'Tòniques', 'Pack 24 ampolles 250ml', 19.60, 70, 'schweppes_tonica_pack.jpg', 1),
('Pack Schweppes Llimona 24 ampolles', 'Refrescos', 'Pack 24 ampolles 250ml', 18.40, 65, 'schweppes_llimona_pack.jpg', 1),
('Pack 7UP 24 llaunes', 'Refrescos', 'Pack 24 llaunes 330ml', 16.90, 90, '7up_pack.jpg', 1),
('Pack Aquarius 24 llaunes', 'Refrescos', 'Pack 24 llaunes 330ml', 20.20, 85, 'aquarius_pack.jpg', 1),
('Pack Nestea 24 llaunes', 'Refrescos', 'Pack 24 llaunes 330ml', 19.80, 78, 'nestea_pack.jpg', 1),
('Pack aigua mineral 6 ampolles', 'Aigua', 'Pack 6 ampolles 1,5L', 4.90, 200, 'aigua_pack.jpg', 1),
('Pack aigua amb gas 12 ampolles', 'Aigua', 'Pack 12 ampolles 500ml', 7.60, 140, 'aigua_gas_pack.jpg', 1),
('Caixa vi negre Rioja 6 ampolles', 'Vi', 'Caixa 6 ampolles 750ml', 36.00, 40, 'vi_negre_rioja_caixa.jpg', 1),
('Caixa vi blanc Verdejo 6 ampolles', 'Vi', 'Caixa 6 ampolles 750ml', 32.50, 45, 'vi_blanc_verdejo_caixa.jpg', 1),
('Caixa vi rosat 6 ampolles', 'Vi', 'Caixa 6 ampolles 750ml', 31.00, 35, 'vi_rosat_caixa.jpg', 1),
('Caixa cava brut 6 ampolles', 'Cava', 'Caixa 6 ampolles 750ml', 38.50, 55, 'cava_brut_caixa.jpg', 1),
('Caixa cava semi-sec 6 ampolles', 'Cava', 'Caixa 6 ampolles 750ml', 37.90, 42, 'cava_semisec_caixa.jpg', 1),
('Pack suc de taronja 12 ampolles', 'Sucs', 'Pack 12 ampolles 1L', 14.20, 90, 'suc_taronja_pack.jpg', 1),
('Pack cafè Bombón 12 unitats', 'Cafè', 'Pack 12 paquets 250g', 26.80, 50, 'cafe_bombon_pack.jpg', 1);

INSERT INTO comandes (id_client, id_estat, import_total, observacions) VALUES
(1, 1, 37.00, 'Comanda inicial de prova'),
(2, 3, 64.80, 'Entregar al matí');

INSERT INTO linies_comanda (id_comanda, id_producte, quantitat, preu_unitari, subtotal) VALUES
(1, 1, 2, 18.50, 37.00),
(2, 14, 2, 36.00, 72.00);

INSERT INTO repartiments (id_comanda, id_camioner, data_sortida, data_entrega, incidencia) VALUES
(2, 4, NULL, NULL, NULL);
