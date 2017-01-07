REPLACE INTO `unr_players` (`id`, `name`, `password`, `ip`, `lastIp`, `lastTime`, `onlineTime`, `steam_id`, `amxx_flags`, `flags`, `webadmin`, `email`, `icq`, `active`, `auth`, `steam_id_64`) VALUES
(761, 'sanek_m7.62', 'a4125195abddce0c468503add740dc57', '213.141.136.65', '', 0, 0, 'STEAM_0:0:6592983', '', 3, 0, 'sanekd@mail.ru', 0, 1, 1, ''),
(938, 'awefa', 'c6fd76396956a93eb0ee09250a71cd6c', '', '', 0, 0, 'STEAM_0:0:32178638', '', 2, 0, 'haosmedi@mail.ru', 0, 1, 0, ''),
(884, 'maison', 'c4763c1ffa3ed21721ccc0533b37acad', '178.215.80.107', '', 0, 0, 'STEAM_0:0:28691888', 't', 3, 0, 'mactep__spacesa@spaces.ru', 0, 1, 1, ''),
(627, 'ghp', '63fabb5002cd6081c991d0f65bb08ca8', '5.248.209.9', '', 0, 0, 'STEAM_0:0:20512933', 't', 3, 0, 'devyatkin7@mail.ru', 306511395, 1, 1, ''),
(314, 'RrR', '7a55f4d968b169f121d4065d15180e22', '93.185.251.93', '93.185.251.93', 1337759518, 1572, 'STEAM_0:0:1258327', '', 3, 0, 'disa35@yandex.ru', 0, 1, 1, ''),
(231, 'Mr.CMETAHA!', '2fb3421fb57635c0a352ee36b1512b14', '', '', 0, 0, 'STEAM_0:0:1090022', '', 2, 0, 'Rakafella2@mail.ru', 0, 1, 1, ''),
(8, 'vlad', '25de510c6bf82a1d93bc0754caf4c9b1', '23.23.11.3', '', 0, 0, 'STEAM_0:0:53075366   4 10:16', 't', 3, 0, 'vlad-khristonko2009@yandex.ru', 572012656, 1, 0, '76561198066416561'),
(498, 'MopkoBka', 'b1e68eaed5179452b707ab91f1a2e6a9', '79.126.65.23', '', 0, 0, 'STEAM_0:1:42682564', 't', 3, 0, 'kimin2011@mail.ru', 0, 1, 0, ''),
(263, 'slowpoke', '4b99703212c9836ac43ff956d3c43470', '', '', 0, 0, 'STEAM_0:1:16981080', '', 2, 0, 'smttms2@gmail.com', 0, 1, 1, ''),
(429, 'ASDASD', 'a1c8dbe5ee8604cc0d5bf5abe62b8c45', '', '85.26.232.142', 1356273186, 98560, 'STEAM_0:0:57859486', '', 2, 0, 'temaaa73@mail.ru', 0, 1, 1, ''),
(960, '4ever', '327b0eade9782686259b13ddcf61ef41', '213.141.136.65', '', 0, 0, 'STEAM_0:0:144356303', '', 3, 0, 'agafontsev.serega@yandex.ru', 0, 1, 1, ''),
(454, 'made in kazan!', '66cff30cd52499bb99c67713d5f29325', '94.198.128.44:27017', '', 0, 0, 'STEAM_0:0:1367921804', 't', 3, 0, '1gk000@mail.ru', 0, 1, 1, ''),
(86, ' Russian Electro Mafia', '', '', '', 0, 0, 'STEAM_0:0:43753492', 't', 2, 0, '', 0, 1, 1, ' 76561198047772712'),
(1046, 'noMuDopka', '', '', '93.80.218.182', 1455744019, 354, 'STEAM_0:0:49015849', 't', 2, 0, '', 0, 1, 1, '76561198058297426'),
(8, 'vlad', '25de510c6bf82a1d93bc0754caf4c9b1', '23.23.11.3', '', 0, 0, 'STEAM_0:0:53075366', 't', 3, 0, 'vlad-khristonko2009@yandex.ru', 572012656, 1, 0, '76561198066416561'),
(946, 'dasdas94', 'd964173dc44da83eeafa3aebbee9a1a0', '213.219.72.153', '', 0, 0, 'STEAM_4:0:443146387', '', 3, 0, 'Didogenbagem944@mail.ru', 0, 1, 1, '');

-- SHOW LIST --
/*
SELECT `steam_id`, `steam_id_64`, getSteamId64(`steam_id`) AS `new_steam_id_64` 
FROM `unr_players` WHERE `steam_id` != '' ORDER BY `steam_id` DESC;
*/

-- UNDATE steam_id_64 --
UPDATE `unr_players` as `t1`
INNER JOIN (SELECT `steam_id`, getSteamId64(`steam_id`) AS `new_steam_id_64` FROM `unr_players` WHERE `steam_id_64` = '') as `t2`
SET `steam_id_64` = `new_steam_id_64`
WHERE `t1`.`steam_id` = `t2`.`steam_id`;
