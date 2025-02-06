-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 06, 2025 alle 17:53
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4dogs_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `Id_Adm` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`Id_Adm`, `Password`) VALUES
('fedeclacri@4dogs.it', '$2y$12$CGSC2Y041ybhWCY.4WfHl.2Ja8JiJkI7SV4utHlfUsfizwSYNsD5q');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `Codice` int(11) NOT NULL,
  `CodProdotto` int(11) NOT NULL,
  `Quantita` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`Codice`, `CodProdotto`, `Quantita`, `Email`) VALUES
(3, 1, 5, 'federico@capponi.fun');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria_prodotto`
--

CREATE TABLE `categoria_prodotto` (
  `CodCategoria` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categoria_prodotto`
--

INSERT INTO `categoria_prodotto` (`CodCategoria`, `Nome`) VALUES
(1, 'Umido'),
(2, 'Crocchette'),
(3, 'Snack'),
(4, 'Abbigliamento'),
(5, 'Cucce'),
(6, 'Cura e Igiene'),
(7, 'Giochi'),
(8, 'Guinzaglieria');

-- --------------------------------------------------------

--
-- Struttura della tabella `doggy`
--

CREATE TABLE `doggy` (
  `IdCane` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Taglia` varchar(50) NOT NULL,
  `Sesso` char(1) NOT NULL,
  `Eta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `doggy`
--

INSERT INTO `doggy` (`IdCane`, `Email`, `Nome`, `Taglia`, `Sesso`, `Eta`) VALUES
(9, 'zaccaronicri@gmail.com', 'Fidos', 'S', 'M', 'Puppy'),
(10, 'pallotta@gmail.com', 'Choko', 'M', 'M', 'Adult'),
(11, 'claudiafalconecv@gmail.com', 'Fido', 'M', 'M', 'Puppy'),
(12, 'benedetta.mercuriali@gmail.com', 'Poldo', 'M', 'M', 'Senior');

-- --------------------------------------------------------

--
-- Struttura della tabella `lista_desideri`
--

CREATE TABLE `lista_desideri` (
  `CodProdotto` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `lista_desideri`
--

INSERT INTO `lista_desideri` (`CodProdotto`, `Email`) VALUES
(9, 'zaccaronicri@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `Numero` int(11) NOT NULL,
  `Descrizione` varchar(64) NOT NULL,
  `Data` date NOT NULL DEFAULT current_timestamp(),
  `Letta` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`Numero`, `Descrizione`, `Data`, `Letta`) VALUES
(15, 'Accettato', '2025-01-28', '0'),
(24, 'Effettuato', '2025-02-02', '1'),
(14, 'Spedito', '2025-01-28', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica_venditore`
--

CREATE TABLE `notifica_venditore` (
  `Id` int(11) NOT NULL,
  `Email_Admin` varchar(50) NOT NULL,
  `Data` datetime NOT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Codice` int(11) DEFAULT NULL,
  `Letta` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `notifica_venditore`
--

INSERT INTO `notifica_venditore` (`Id`, `Email_Admin`, `Data`, `Numero`, `Codice`, `Letta`) VALUES
(2, 'fedeclacri@4dogs.it', '2025-01-29 23:37:33', 20, NULL, 1),
(3, 'fedeclacri@4dogs.it', '2025-01-29 23:38:16', 21, NULL, 1),
(4, 'fedeclacri@4dogs.it', '2025-01-30 00:11:54', 22, NULL, 1),
(5, 'fedeclacri@4dogs.it', '2025-01-30 00:12:42', 23, NULL, 1),
(9, 'fedeclacri@4dogs.it', '2025-01-30 00:27:21', NULL, 3, 1),
(11, 'fedeclacri@4dogs.it', '2025-01-31 23:26:54', 28, NULL, 1),
(13, 'fedeclacri@4dogs.it', '2025-02-01 21:47:28', 29, NULL, 1),
(14, 'fedeclacri@4dogs.it', '2025-02-01 21:48:38', 30, NULL, 1),
(16, 'fedeclacri@4dogs.it', '2025-02-01 21:56:18', 31, NULL, 1),
(17, 'fedeclacri@4dogs.it', '2025-02-02 12:27:59', 32, NULL, 1),
(18, 'fedeclacri@4dogs.it', '2025-02-06 11:14:22', 33, NULL, 1),
(19, 'fedeclacri@4dogs.it', '2025-02-06 11:14:22', NULL, 64, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `Numero` int(11) NOT NULL,
  `Data` datetime NOT NULL DEFAULT current_timestamp(),
  `Email` varchar(50) NOT NULL,
  `Stato` varchar(64) NOT NULL,
  `Totale` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`Numero`, `Data`, `Email`, `Stato`, `Totale`) VALUES
(14, '2025-01-28 11:20:19', 'zaccaronicri@gmail.com', 'In transito', 62.46),
(15, '2025-01-28 11:21:51', 'federico@capponi.fun', 'Accettato', 0),
(16, '2025-01-28 11:22:28', 'federico@capponi.fun', 'Effettuato', 0),
(17, '2025-01-28 11:23:00', 'federico@capponi.fun', 'Effettuato', 71.09),
(18, '2025-01-28 11:55:38', 'zaccaronicri@gmail.com', 'Effettuato', 54.47),
(20, '2025-01-29 23:37:33', 'zaccaronicri@gmail.com', 'Effettuato', 43.47),
(21, '2025-01-29 23:38:16', 'zaccaronicri@gmail.com', 'Effettuato', 43.47),
(22, '2025-01-30 00:11:54', 'zaccaronicri@gmail.com', 'Effettuato', 30.5),
(23, '2025-01-30 00:12:42', 'zaccaronicri@gmail.com', 'Effettuato', 30.5),
(24, '2025-01-30 00:15:56', 'zaccaronicri@gmail.com', 'Effettuato', 47.94),
(25, '2025-01-30 00:19:01', 'zaccaronicri@gmail.com', 'Effettuato', 56.44),
(26, '2025-01-30 00:27:21', 'zaccaronicri@gmail.com', 'Effettuato', 56.44),
(28, '2025-01-31 23:26:54', 'zaccaronicri@gmail.com', 'Effettuato', 45.75),
(29, '2025-02-01 21:47:28', 'zaccaronicri@gmail.com', 'Effettuato', 26),
(30, '2025-02-01 21:48:38', 'zaccaronicri@gmail.com', 'Effettuato', 42.7),
(31, '2025-02-01 21:56:18', 'zaccaronicri@gmail.com', 'Effettuato', 28.65),
(32, '2025-02-02 12:27:59', 'zaccaronicri@gmail.com', 'Accettato', 22.64),
(33, '2025-02-06 11:14:22', 'benedetta.mercuriali@gmail.com', 'Effettuato', 44.96);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine_prodotto`
--

CREATE TABLE `ordine_prodotto` (
  `Numero` int(11) NOT NULL,
  `CodProdotto` int(11) NOT NULL,
  `Prezzo` float NOT NULL,
  `Quantita` int(11) NOT NULL,
  `Codice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordine_prodotto`
--

INSERT INTO `ordine_prodotto` (`Numero`, `CodProdotto`, `Prezzo`, `Quantita`, `Codice`) VALUES
(14, 3, 7.99, 4, 5),
(14, 9, 15.25, 2, 1),
(15, 3, 7.99, 1, 5),
(15, 6, 14.65, 1, 10),
(16, 1, 28.22, 2, 3),
(16, 6, 14.65, 1, 10),
(17, 1, 28.22, 2, 3),
(17, 6, 14.65, 1, 10),
(18, 3, 7.99, 3, 5),
(18, 9, 15.25, 2, 1),
(20, 9, 15.25, 1, 1),
(21, 1, 28.22, 1, 3),
(21, 9, 15.25, 1, 1),
(22, 9, 15.25, 2, 1),
(23, 9, 15.25, 2, 1),
(24, 3, 7.99, 6, 5),
(25, 1, 28.22, 2, 3),
(26, 1, 28.22, 2, 3),
(28, 9, 15.25, 3, 1),
(29, 9, 13, 2, 6),
(30, 9, 21.35, 2, 2),
(31, 1, 28.65, 1, 4),
(32, 3, 7.99, 1, 5),
(32, 6, 14.65, 1, 10),
(33, 3, 8.99, 3, 64),
(33, 24, 17.99, 1, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `CodProdotto` int(11) NOT NULL,
  `Nome` varchar(64) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `Descrizione` varchar(500) NOT NULL,
  `Percorso_Immagine` varchar(550) NOT NULL,
  `CodCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`CodProdotto`, `Nome`, `Brand`, `Descrizione`, `Percorso_Immagine`, `CodCategoria`) VALUES
(1, 'Croccantini Fish Lover', 'Natural Trainer', 'Deliziosi croccantini di pesce.\r\nConfezione da 5 Kg.', '01_NT_Crocchette_Tonno.jpg', 2),
(3, 'Ossi pressati', 'Barkoo', 'Ossi pressati da masticare per cani al 100% in pelle di manzo, in diverse misure.\r\nConfezione da 6 pz.', '03_Ossi_pelle_manzo.jpg', 3),
(4, 'Pelle di nuca di manzo', 'Phil & Sons', 'Un divertimento tutto da masticare: pelle di nuca di manzo essiccata, in bastoncini da ca. 50 - 70 cm.', '04_Phil_Sons_manzo.jpg', 3),
(5, 'Wild Bites', 'Wolf of Wilderness', 'Snack senza cereali per cani Wolf of Wilderness, ispirati all\'alimentazione del lupo.', '05_Wolf_snack.jpg', 3),
(6, 'Collare Tales Blush', 'Nomad', 'Elegante collare in velluto per cani, regolabile e con grande anello a D, rivestito in nylon e resistente alle intemperie, con elementi in metallo, in poliestere e nylon, disponibili varie taglie.', '06_Nomad_Collare.jpg', 8),
(7, 'Pettorina', 'TIAKI', 'Pettorina a Y per cani, leggera, comoda e con imbottitura interna in neoprene, con dettagli catarifrangenti, a regolazione continua per un\'ottima stabilità, facile da indossare, in poliestere e nylon.', '07_TIAKI_Pettorina.jpg', 8),
(8, 'Squeaky Ball Palla', 'Trixie', 'Divertente palla gioco Squeaky Ball in TPR per cani di tg. piccola e media, galleggia e rimbalza, con squeak e superficie irregolare che massaggia le gengive, ideale per il lancio e il riporto.', '08_Ball.jpg', 7),
(9, 'KONG Classico', 'KONG', 'Salta e rimbalza di qua e di là, soddisfa il bisogno di masticare e di giocare del cane, ideale da inseguire, masticare e riportare, riempibile con snack, in caucciù.', '09_Kong_classic.jpg', 7),
(10, 'Letto Fluffy Bone', 'TIAKI', 'Accogliente letto per cani di taglia piccola o media, con cuscino reversibile, interno in morbido peluche, ingresso basso e ampio bordo per rilassarsi, cuscino extra a forma di osso, in poliestere.', '10_TIAKI_Cuccia.jpg', 5),
(11, 'Letto Helena', 'Modern Living', 'Cuccia super confortevole per cani di tutte le taglie, design elegante a coste larghe, ottima anche in caso di problemi alle articolazioni, imbottitura in Memory Foam, sfoderabile.\nDimensioni L 65 x P 60 x H 18 cm.', '11_ML_cuccia.jpg', 5),
(12, 'Delicious Paté', 'Briantos', 'Alimento umido senza cereali ideale per l\'alimentazione quotidiana, privo di coloranti o aromi artificiali e senza zuccheri aggiunti.\nConfezione da 6 x 400 g', '12_BRIANTOS_umido_pollo.jpg', 1),
(23, 'Materasso per cani', 'Tiaki', 'Comodo materasso per cani, imbottito con Memory Foam ortopedico, si adatta al corpo del tuo pet, ideale per animali anziani o con problemi articolari, con rivestimento lavabile in lavatrice.', '13_materasso_Tiaki.jpg', 5),
(24, 'Cappotto Olive', 'TIAKI ', 'Elegante cappotto per cani, materiale esterno impermeabile con cuciture impermeabili, offre  isolamento termico, con chiusura a scatto, può essere adattato al corpo del cane, colore: oliva', '492900_olive_60cm_dog_fg_10_5.jpg', 4),
(25, 'Maglione con Renna', 'TIAKI', 'Con il maglione per cani TIAKI Reindeer, il vostro amico a quattro zampe è perfettamente preparato per la stagione fredda. Il maglione presenta un simpatico disegno di renna e colori invernali verde scuro e bianco.', '470804_reindeer_45cm_dog_fg_4072_6.jpg', 4),
(26, 'Maglia Reflective Knit', 'TIAKI ', 'Calda maglia per cani, con dolcevita e polsini elasticizzati, con motivo a maglia con cuciture riflettenti e toppa a forma di zampa', '470415_reflective_knit_45cm_dog_fg_4056_8.jpg', 4),
(27, 'Hypoallergenic Crocchette', 'Royal Canin ', 'Crocchette dietetiche Royal Canin Veterinary Canine Hypoallergenic per cani adulti con intolleranze e allergie alimentari, con EPA/DHA, ideali in caso di dermatosi ed eccessiva perdita di pelo', 'rc_vet_dry_doghypo_mv_eretailkit_1_de_de_5.jpg', 6),
(28, 'Pannolini a fascia maschi', 'Trixie', 'Pannolini a fascia Trixie per cani maschi, ideali per cani anziani, incontinenza, in fase post-operatoria e in viaggio, buona vestibilità grazie a fascia elastica e chiusure adesive, extra assorbente.', '122202_pla_trixie_windel_ruden_sm_hs_03_0.jpg', 6),
(29, 'Pulisci zampe in silicone', 'Trixie ', 'Utilissimo barattolino pulisci zampe per cani, facile da usare, per una pulizia efficace dopo le passeggiate, con setole in silicone che massaggiano le zampe, lavabile.', '394198_trixie_pfotenreiniger_silikon_hs_02_4.jpg', 6),
(30, 'Crocchette Holistic', 'Almo Nature', 'Alimento secco olistico Almo Nature Holistic Medium Adult con Pollo Fresco per cani adulti di taglia media,sano, gustoso e altamente digeribile. Confezione 12Kg.', '26708_pla_almo_nature_holistic_adult_huhn_reis_medium_744_12kg_dog_7.jpg', 2),
(31, 'Mini Puppy umido in salsa', 'Royal Canin', 'Alimento umido Royal Canin Mini Puppy per cuccioli e cani giovani di tg piccola (<10 kg) fino ai 10 mesi, per crescita sana e sviluppo del sistema immunitario, con bocconcini in salsa.', 'rc_spt_wet_minipuppy_mv_3_de_de_8.jpg', 1),
(32, 'Sacchetti igienici compostabili per cani', 'TIAKI', 'Sacchetti igienici compostabili in amido di mais, in materiale robusto, con linea divisoria perforata per un facile strappo, adatto a molti dispenser, colore: verde scuro, contenuto: 90 o 450 pezzi.', '290896_sacchetti_igienici_compostabili.jpg', 6),
(34, 'Almo Nature HFC Alimento umido per cani', 'Almo nature', 'Alimento umido naturale per cani adulti, naturalmente ricco di preziose proteine e sostanze nutritive. Particolarmente gustoso e conservato nel proprio brodo di cottura. Confezione da 6 x 95 g .               ', '18841_pla_almo_nature_h_hnerfilet_hs_1_1_8.jpg', 1),
(35, 'Trixie Move2Win gioco strategico', 'Trixie', 'Gioco strategico Trixie Move2Win per cani, ricco di varianti e con difficoltà regolabile, allena la concentrazione e stimola mentalmente l\'animale, incl. libretto con esercizi, in plastica.', '73771_pla_trixie_move2win_strategiespiel_hs_01_5.jpg', 7),
(36, 'Gioco da masticare corda con ciuccio', 'TIAKI', 'Grazioso gioco per cani adulti o cuccioli, pallina in corda da masticare con ciuccio nei colori abbinati in TPR dalla superficie ricoperta di spuntoni ideali da rosicchiare, con squeak.', '505496_pla_tiaki_dummy_chew_rope_toy_fg_0754_2.jpg', 7),
(37, 'Cappotto per cane Warmup, rosa', 'Trixie', 'Cappotto rosa per cani, di lavorazione pregiata, idrorepellente e antivento, fodera in caldo pile e soffice imbottitura di ovatta, zone di collo e vita regolabili, con apertura per il guinzaglio.', '139904_pla_lfashion_rukka_warmup_hundemantel_hotpink_38cm_hs_01_3.jpg', 4),
(38, 'Collare per cani, zaffiro', 'Nomad', 'Collare moderno per cani extra confortevole, in mix di materiali tra cui ecopelle 100% vegana, a elegante motivo chevron in contrasto con la fibbia in metallo color oro, in poliestere.', 'pla_327096_326808_326809_326810_nomad_tales_bloom_halsbaender_fg_1458_2.jpg', 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `stato_ordine`
--

CREATE TABLE `stato_ordine` (
  `Descrizione` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `stato_ordine`
--

INSERT INTO `stato_ordine` (`Descrizione`) VALUES
('Accettato'),
('Consegnato'),
('Effettuato'),
('In transito'),
('Spedito');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente_registrato`
--

CREATE TABLE `utente_registrato` (
  `Email` varchar(50) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Telefono` varchar(11) NOT NULL,
  `Password` char(255) NOT NULL,
  `Attivo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente_registrato`
--

INSERT INTO `utente_registrato` (`Email`, `Cognome`, `Nome`, `Telefono`, `Password`, `Attivo`) VALUES
('benedetta.mercuriali@gmail.com', 'Mercuriali', 'Benedetta', '340 2539853', '$2y$10$IyZVopOddZKk8dMMUZemk.24Rpw1h9W/DAigSpi9d8XbOYSldgOI.', 1),
('claudiafalconecv@gmail.com', 'Falcone', 'Claudia', '342 5405792', '$2y$10$FtR0R6dJmwoQgD5SqCf81.zP2NSjIaW0LZzjb/Fystu17JpRnIUya', 1),
('federico@capponi.fun', 'Federico', 'Capponi', '338 3827737', '$2y$10$hT5FP4zOVkUsP3nGLq2tk.FRImSl5EfVB/Zu5CBOgtnyLNPGGvsIq', 1),
('pallotta@gmail.com', 'Pallotta', 'Pallotta', '335 2356332', '$2y$10$0pwYAt2MqDQRXhCwD7rKneU5H.2NRG6jADc6B.3C9fNinElk2rZW2', 1),
('zaccaronicri@gmail.com', 'Zaccaroni', 'Cristina', '339 5026467', '$2y$12$EsV33Du.HKB7KvueMm4SJ.8BvXLpW7h.XhMuZwNuDJqOOGvmB3hIq', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `versione_prodotto`
--

CREATE TABLE `versione_prodotto` (
  `CodProdotto` int(11) NOT NULL,
  `Codice` int(11) NOT NULL,
  `TagliaCane` varchar(20) NOT NULL DEFAULT 'Tutte',
  `SessoCane` varchar(5) DEFAULT 'Tutti',
  `EtaCane` varchar(15) NOT NULL DEFAULT 'Tutte',
  `Composizione_Materiale` varchar(50) DEFAULT NULL,
  `Prezzo` float NOT NULL,
  `Disponibilita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `versione_prodotto`
--

INSERT INTO `versione_prodotto` (`CodProdotto`, `Codice`, `TagliaCane`, `SessoCane`, `EtaCane`, `Composizione_Materiale`, `Prezzo`, `Disponibilita`) VALUES
(9, 1, 'M', 'Tutti', 'Tutte', 'Plastica', 15.25, 0),
(9, 2, 'L', 'Tutti', 'Tutte', 'Plastica', 21.35, 4),
(1, 3, 'Tutti', 'Tutti', 'Adult', 'Tonno', 28.22, 0),
(1, 4, 'Tutti', 'Tutti', 'Puppy', 'Tonno', 28.65, 2),
(3, 5, 'S', 'Tutti', 'Tutte', 'Manzo', 7.99, 8),
(9, 6, 'S', 'Tutti', 'Tutte', 'Plastica', 13, 5),
(3, 7, 'M', 'Tutti', 'Adult', 'Manzo', 8.99, 8),
(3, 8, 'L', 'Tutti', 'Adult', 'Manzo', 18.49, 6),
(1, 9, 'Tutti', 'Tutti', 'Puppy', 'Salmone', 33.21, 2),
(6, 10, 'S', 'Tutti', 'Tutte', 'Poliestere', 14.65, 1),
(1, 11, 'Tutti', 'Tutti', 'Adult', 'Salmone', 30.55, 3),
(24, 17, 'S', 'Tutti', 'Tutte', 'Poliestere', 14.99, 5),
(24, 18, 'M', 'Tutti', 'Tutte', 'Poliestere', 17.99, 5),
(24, 19, 'L', 'Tutti', 'Tutte', 'Poliestere', 19.99, 3),
(25, 20, 'S', 'Tutti', 'Tutte', 'Acrilico', 7.49, 3),
(25, 21, 'M', 'Tutti', 'Tutte', 'Acrilico', 10.45, 5),
(25, 22, 'L', 'Tutti', 'Tutte', 'Acrilico', 17.45, 4),
(26, 23, 'S', 'Tutti', 'Tutte', 'Acrilico', 8.29, 6),
(26, 24, 'M', 'Tutti', 'Tutte', 'Acrilico', 10.29, 9),
(26, 25, 'L', 'Tutti', 'Tutte', 'Acrilico', 12.29, 9),
(27, 26, 'Tutti', 'Tutti', 'Tutte', 'Pollo', 25.49, 4),
(27, 27, 'Tutti', 'Tutti', 'Puppy', 'Pollo', 26.45, 5),
(28, 28, 'S', 'Tutti', 'Senior', 'Poliestere', 5.29, 5),
(28, 29, 'M', 'Tutti', 'Senior', 'Poliestere', 7.68, 6),
(28, 30, 'L', 'Tutti', 'Senior', 'Poliestere', 9.69, 8),
(29, 31, 'S', 'Tutti', 'Tutte', 'Silicone', 5.29, 7),
(29, 32, 'M', 'Tutti', 'Tutte', 'Silicone', 6.69, 9),
(29, 33, 'L', 'Tutti', 'Tutte', 'Silicone', 10.59, 5),
(12, 34, 'Tutti', 'Tutti', 'Puppy', 'Pollo', 10.59, 5),
(12, 35, 'Tutti', 'Tutti', 'Adult', 'Pollo', 8.54, 5),
(4, 36, 'M', 'Tutti', 'Tutte', 'Manzo', 9.23, 6),
(4, 37, 'L', 'Tutti', 'Tutte', 'Manzo', 7.26, 8),
(5, 38, 'Tutte', 'Tutti', 'Tutte', 'Anatra', 10.28, 6),
(30, 39, 'M', 'Tutti', 'Adult', 'Pollo', 38, 7),
(30, 40, 'M', 'Tutti', 'Adult', 'Manzo', 40, 6),
(31, 41, 'S', 'Tutti', 'Puppy', 'Pollo', 9.91, 7),
(31, 42, 'S', 'Tutti', 'Puppy', 'Manzo', 10.7, 7),
(1, 43, 'Tutte', 'Tutti', 'Senior', 'Tonno', 30.23, 2),
(6, 44, 'M', 'Tutti', 'Tutte', 'Poliestere', 28.99, 3),
(5, 45, 'Tutte', 'Tutti', 'Tutte', 'Cavallo', 12.55, 4),
(5, 46, 'Tutte', 'Tutti', 'Tutte', 'Cervo', 11.45, 3),
(7, 47, 'S', 'Tutti', 'Tutte', 'Neoprene', 20.99, 3),
(7, 48, 'M', 'Tutti', 'Tutte', 'Neoprene', 25.99, 2),
(7, 49, 'L', 'Tutti', 'Tutte', 'Neoprene', 28.67, 1),
(8, 50, 'S', 'Tutti', 'Tutte', 'Plastica', 6.42, 3),
(8, 51, 'M', 'Tutti', 'Tutte', 'Plastica', 6.42, 3),
(10, 52, 'S', 'Tutti', 'Tutte', 'Cotone e Poliestere', 32.85, 2),
(10, 53, 'M', 'Tutti', 'Tutte', 'Cotone e Poliestere', 38.59, 2),
(11, 54, 'S', 'Tutti', 'Tutte', 'Cotone e Memory Foam', 31.55, 2),
(11, 55, 'M', 'Tutti', 'Tutte', 'Cotone e Memory Foam', 39.4, 1),
(11, 56, 'L', 'Tutti', 'Tutte', 'Cotone e Memory Foam', 52.12, 2),
(12, 57, 'Tutte', 'Tutti', 'Puppy', 'Manzo', 12.63, 10),
(12, 58, 'Tutte', 'Tutti', 'Senior', 'Manzo', 10.69, 3),
(12, 59, 'Tutte', 'Tutti', 'Adult', 'Manzo', 10.69, 5),
(23, 60, 'S', 'Tutti', 'Tutte', 'Memory foam', 21.33, 2),
(23, 61, 'M', 'Tutti', 'Tutte', 'Memory foam', 32.33, 3),
(23, 62, 'L', 'Tutti', 'Tutte', 'Memory foam', 40.33, 1),
(27, 63, 'Tutte', 'Tutti', 'Puppy', 'Trota', 26, 3),
(3, 64, 'M', 'Tutti', 'Senior', 'Manzo', 8.99, 0),
(32, 65, 'Tutte', 'Tutti', 'Tutte', 'Amido di Mais', 4.99, 10),
(34, 66, 'Tutte', 'Tutti', 'Adult', 'Filetto di Pollo', 8.29, 4),
(34, 67, 'Tutte', 'Tutti', 'Adult', 'Vitello con Prosciut', 9.19, 3),
(34, 68, 'Tutte', 'Tutti', 'Adult', 'Manzo con Prosciutto', 9.19, 1),
(34, 69, 'Tutte', 'Tutti', 'Senior', 'Manzo con Prosciutto', 9.19, 1),
(34, 70, 'Tutte', 'Tutti', 'Senior', 'Vitello con Prosciut', 9.19, 2),
(35, 71, 'S', 'Tutti', 'Tutte', 'Plastica', 11.39, 2),
(35, 72, 'M', 'Tutti', 'Tutte', 'Plastica', 11.39, 2),
(36, 73, 'S', 'Tutti', 'Puppy', 'TPR e corda', 2.29, 5),
(36, 74, 'M', 'Tutti', 'Puppy', 'TPR e corda', 2.29, 5),
(37, 75, 'M', 'F', 'Tutte', 'Poliestere e Pile', 59.49, 3),
(37, 76, 'L', 'F', 'Tutte', 'Poliestere e Pile', 72.49, 2),
(37, 77, 'S', 'F', 'Tutte', 'Poliestere e Pile', 49.49, 2),
(38, 78, 'S', 'M', 'Tutte', 'Ecopelle e Poliester', 6.29, 3),
(38, 79, 'S', 'M', 'Tutte', 'Ecopelle-Poliestere', 6.29, 3),
(38, 80, 'M', 'M', 'Tutte', 'Ecopelle-Poliestere', 7.49, 1),
(38, 81, 'L', 'M', 'Tutte', 'Ecopelle-Poliestere', 7.69, 4);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_Adm`),
  ADD UNIQUE KEY `ID_ADMIN_IND` (`Id_Adm`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`Codice`,`CodProdotto`,`Email`),
  ADD KEY `UserID` (`Email`),
  ADD KEY `CodProdotto` (`CodProdotto`),
  ADD KEY `Codice` (`Codice`);

--
-- Indici per le tabelle `categoria_prodotto`
--
ALTER TABLE `categoria_prodotto`
  ADD PRIMARY KEY (`CodCategoria`),
  ADD UNIQUE KEY `ID_CATEGORIA_PRODOTTO_IND` (`CodCategoria`);

--
-- Indici per le tabelle `doggy`
--
ALTER TABLE `doggy`
  ADD PRIMARY KEY (`IdCane`),
  ADD UNIQUE KEY `FKaccudisce_ID` (`Email`),
  ADD UNIQUE KEY `ID_DOGGY_IND` (`IdCane`),
  ADD UNIQUE KEY `FKaccudisce_IND` (`Email`);

--
-- Indici per le tabelle `lista_desideri`
--
ALTER TABLE `lista_desideri`
  ADD PRIMARY KEY (`CodProdotto`),
  ADD KEY `CodProdotto` (`CodProdotto`,`Email`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`Descrizione`,`Numero`),
  ADD UNIQUE KEY `ID_notifica_IND` (`Descrizione`,`Numero`),
  ADD KEY `FKnot_ORD_IND` (`Numero`);

--
-- Indici per le tabelle `notifica_venditore`
--
ALTER TABLE `notifica_venditore`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Adm` (`Email_Admin`),
  ADD KEY `Numero` (`Numero`),
  ADD KEY `Codice` (`Codice`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`Numero`),
  ADD UNIQUE KEY `ID_ORDINE_IND` (`Numero`),
  ADD KEY `FKacquista_IND` (`Email`),
  ADD KEY `FK_Stato` (`Stato`);

--
-- Indici per le tabelle `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  ADD PRIMARY KEY (`Numero`,`CodProdotto`,`Codice`),
  ADD KEY `fk_prodotto` (`CodProdotto`),
  ADD KEY `fk_versioneprodottocod` (`Codice`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`CodProdotto`),
  ADD UNIQUE KEY `ID_PRODOTTO_IND` (`CodProdotto`),
  ADD KEY `FKappartiene_IND` (`CodCategoria`);

--
-- Indici per le tabelle `stato_ordine`
--
ALTER TABLE `stato_ordine`
  ADD PRIMARY KEY (`Descrizione`),
  ADD UNIQUE KEY `ID_STATO_ORDINE_IND` (`Descrizione`);

--
-- Indici per le tabelle `utente_registrato`
--
ALTER TABLE `utente_registrato`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `ID_UTENTE_REGISTRATO_IND` (`Email`);

--
-- Indici per le tabelle `versione_prodotto`
--
ALTER TABLE `versione_prodotto`
  ADD PRIMARY KEY (`Codice`,`CodProdotto`),
  ADD UNIQUE KEY `ID_VERSIONE_PRODOTTO_IND` (`Codice`,`CodProdotto`),
  ADD KEY `FKcatalogo_IND` (`CodProdotto`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categoria_prodotto`
--
ALTER TABLE `categoria_prodotto`
  MODIFY `CodCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `doggy`
--
ALTER TABLE `doggy`
  MODIFY `IdCane` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `notifica_venditore`
--
ALTER TABLE `notifica_venditore`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `Numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `CodProdotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT per la tabella `versione_prodotto`
--
ALTER TABLE `versione_prodotto`
  MODIFY `Codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `FKcar_VER` FOREIGN KEY (`Codice`,`CodProdotto`) REFERENCES `versione_prodotto` (`Codice`, `CodProdotto`),
  ADD CONSTRAINT `UserID` FOREIGN KEY (`Email`) REFERENCES `utente_registrato` (`Email`);

--
-- Limiti per la tabella `doggy`
--
ALTER TABLE `doggy`
  ADD CONSTRAINT `FKaccudisce_FK` FOREIGN KEY (`Email`) REFERENCES `utente_registrato` (`Email`);

--
-- Limiti per la tabella `lista_desideri`
--
ALTER TABLE `lista_desideri`
  ADD CONSTRAINT `FKins_VER_FK` FOREIGN KEY (`CodProdotto`) REFERENCES `versione_prodotto` (`CodProdotto`);

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `FKnot_ORD_FK` FOREIGN KEY (`Numero`) REFERENCES `ordine` (`Numero`),
  ADD CONSTRAINT `FKnot_STA` FOREIGN KEY (`Descrizione`) REFERENCES `stato_ordine` (`Descrizione`);

--
-- Limiti per la tabella `notifica_venditore`
--
ALTER TABLE `notifica_venditore`
  ADD CONSTRAINT `Codice` FOREIGN KEY (`Codice`) REFERENCES `versione_prodotto` (`Codice`),
  ADD CONSTRAINT `Id_Adm` FOREIGN KEY (`Email_Admin`) REFERENCES `admin` (`Id_Adm`),
  ADD CONSTRAINT `Numero` FOREIGN KEY (`Numero`) REFERENCES `ordine` (`Numero`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `FK_Stato` FOREIGN KEY (`Stato`) REFERENCES `stato_ordine` (`Descrizione`),
  ADD CONSTRAINT `FKacquista_FK` FOREIGN KEY (`Email`) REFERENCES `utente_registrato` (`Email`);

--
-- Limiti per la tabella `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  ADD CONSTRAINT `fk_ordine` FOREIGN KEY (`Numero`) REFERENCES `ordine` (`Numero`),
  ADD CONSTRAINT `fk_prodotto` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotto` (`CodProdotto`),
  ADD CONSTRAINT `fk_versioneprodottocod` FOREIGN KEY (`Codice`) REFERENCES `versione_prodotto` (`Codice`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `FKappartiene_FK` FOREIGN KEY (`CodCategoria`) REFERENCES `categoria_prodotto` (`CodCategoria`);

--
-- Limiti per la tabella `versione_prodotto`
--
ALTER TABLE `versione_prodotto`
  ADD CONSTRAINT `FKcatalogo_FK` FOREIGN KEY (`CodProdotto`) REFERENCES `prodotto` (`CodProdotto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
