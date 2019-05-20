-- Taula empresa
INSERT INTO `empresa` (`id`, `username`, `nom`, `tipusVia`, `direccio`, `numDireccio`, `password`, `email`, `visibilitat`) 
VALUES 
(NULL, 'Clein', 'Clein Frankfurt', 'Carrer', 'Rambla Sant Isidre', '26', 'cleinclein', 'clein@clein.es', '0'), 
(NULL, 'Krusty', 'Krusty Burger', 'Avinguda', 'Evergreen Terrace (Springfield)', '11', 'krustykrusty', 'krusty@krusty.com', '0'),
(NULL, 'BobEsponja', 'Crustáceo crujiente', 'Carrer', 'Piña debajo del mar', '12', 'bobesponja', 'bobesponja@gmail.com', '0'), 
(NULL, 'centralPerk', 'Central Perk Cafe', 'Avinguda', 'la quinta avenida', '5', 'centralPerk', 'illbethereforyou@friends.com', '0'), 
(NULL, 'Baviera', 'Baviera Frankfurt', 'Carrer', 'Leida (Igualada)', '87', 'bavierabaviera', 'baviera@igualada.com', '0');

-- Taula producte
INSERT INTO `producte` (`codi`, `empresa`, `nom`, `descripcio`) 
VALUES 
(NULL, '13', 'CangreBurger', 'Hamburguesa realizada for the one and only Señor Patricio'), 
(NULL, '12', 'KrustyBurger', 'Hamburguesa de animal extinguido hecha por el chico de los granos'), 
(NULL, '14', 'Café con amigos', 'Nosotros ponemos el café, tú los amigos'), 
(NULL, '15', 'Aigua de pluja de l\'Amazones', 'Aigua purificada amb propietats curatives'), 
(NULL, '14', 'Magdalena de xocolata gegant', 'Muffin para los amigos'), 
(NULL, '13', 'Patates fregides', 'Patates fregides sota el mar'), 
(NULL, '12', 'Bolsa sorpresa', 'Diferents ítems que es troben quan es neteja la fregidora (disponible 2 cops a l\'any)'), 
(NULL, '15', 'Frankfurt de la casa', 'Frankfurt com el que et fas a casa, però més car'), 
(NULL, '13', 'Gelat de pinya', '(No és la mateixa pinya que la del Bob)'), 
(NULL, '15', 'Nuggets de pollastre', 'de que sinó?');

-- Taula cata
INSERT INTO `cata` (`id`, `empresa`, `producte`, `estat`, `data`) 
VALUES 
(NULL, '15', '11', '0', '2019-05-18 18:00:00'), 
(NULL, '15', '13', '0', '2019-05-28 00:15:00'),
(NULL, '14', '8', '0', '2019-05-30 10:00:00'), 
(NULL, '12', '10', '0', '2019-05-31 16:24:00'), 
(NULL, '14', '6', '0', '2019-05-21 09:00:00');

-- Taula client

INSERT INTO `client` (`email`, `username`, `password`) 
VALUES 
('w2.kmedina@infomila.info', 'Kev', 'kevinkevin'), 
('w2.ppuyo@infomila.info', 'Pedronsio', 'pedropedro'), 
('w2.mgomez@infomila.info', 'Miwui11', 'miguelmiguel'), 
('emma_watson@gmail.com', 'EmmaWatson', 'emmaemma'), 
('dracarys@gmail.com', 'DaenerysTargaryen', 'daenerysdaenerys');

-- Taula participació

INSERT INTO `participacio` (`cata`, `client`, `valoracio`) 
VALUES 
('4', 'dracarys@gmail.com', '4'), 
('6', 'w2.mgomez@infomila.info', '5'), 
('6', 'w2.kmedina@infomila.info', '2'), 
('4', 'emma_watson@gmail.com', '5'), 
('7', 'w2.ppuyo@infomila.info', '2');
