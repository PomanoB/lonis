# lonis
Web registartion and statistic for Counter Strike 1.6 version 2.0.7

-------------------
-- Version 2.0.7 -- 
-------------------
Changelog: 03.02.2017 23:30
- *** Add New Languages System ***
- Add Iconic font
- Repace all icon to AwesoneFont
- Add Search on Approved Pages
- Add Search in url: ?search=%words%
- Add SteamAvatar Cached
- Add Avatar and Gravatar:identicon on Achievs page
- Add plugins: wavatar, wp_identicon, wp_monsterid
- Fix timezone in Servers module

-------------------
-- Version 2.0.6 -- 
-------------------
Changelog: 01.02.2017 00:00
- Change style on all pages
- Add table kz_diff and change data in kz_map
- Add other php script: generate_page and pinger

Changelog: 27.02.2017 00:30
- Add KZ Longjumps page (uq_jumpstats_2.42)
- Fix some bugs

Changelog: 27.02.2017 15:20
- Add LJ Record page
- Fix func timed();
- Add compare on kz_records page 
- Fix style for all pager (border spacing)
- Update sql files: tbl_menu, tbl_langs, tbl_kz_ljs
- Update table `kz_records` (4347 maps).

Changelog: 27.02.2017 11:30
- Change names: achiev->achievs, kz_map_rec->kz_records
- Change names SQL file
- Add kz_downloads page
- Add kz_records page
- Add kz_longjumps page (Coming Soon)
- Fix records on kz_map page
- Change Accaunt and Admin menu Style (from DB)
- Fix href "/kreedz/{$mapname}/" all pages

-------------------
-- Version 2.0.5 -- 
-------------------
Changelog: 27.02.2017 00:20
- Fix vars &id=
- Add Cvar avatarSteam = 0 (1/0)

Changelog: 26.02.2017 20:40
- Add function getAvatar(); (avatar from Gravatar.com or Steam)
- Add choose player from &Id
- Fix maps image
- Fix Font in kz_duels
- Add Avatar on kz_player page
- Edit config vars (update/add_config.sql)
- Fix Submenu SQL (update/add_langs.sql)

Changelog: 26.02.2017 16:20
- Add SubMenu function
- Disable Main menu on Flag &cs=1
- Fix Flag &cs=1

Changelog: 25.02.2017
- Fix Search
- Update table `kz_map`

Changelog: 17.02.2017
- Update table `kz_map`

Changelog: 08.02.2017
- Fix Steam path in players page
- Fix Admin menu
- Add SQL field `locked` in table `kz_map` for RTV plugin
- Add priority authorization style (commented out selec

-------------------
-- Version 2.0.4 -- 
-------------------
Changelog: 01.02.2017 20:00
- Fix admin_achiev modules
- Add in func url_replace() bad characters
- Fix kz_map.tpl - empty map
- Add add_kz_map.sql - 450 hard map, 145 axn map and Counts SC
- Add add_map_rec.sql - KZ-Rush stats
- Add get_demos.php - get files from sites
- Update demos files XJ and Cosy (01.02.17

-------------------
-- Version 2.0.3 -- 
-------------------
Changelog: 19.01.2017
- Update SQL table/data in achiev_lang  …
- Fix module achiev

Changelog: 17.01.2017 09:30  …
- Delete getPayer => SQL in each Page
- New Get $admin
- Megre auth, ucp and steam => ucp
- Fix setup
- Logout moved from the Menu on the page Accaunt
- Fix SQL files lang
- Returned until the ban on changing steamId

Changelog: 15.01.2017 16:16  …
- Fix index.php
- Update func generate_page()
- Megre player and players script => players
- Fix setup pages
- Fix some bugs

-------------------
-- Version 2.0.2 -- 
-------------------

Changelog: 15.01.2017 06:42  …
- Add $GLOBALS in assign Smarty (fix all page)
- Fix search addslashas();
- Delete GeoIp (OLD)
- Add full GeoLite2 (NEW)
- Fix some bugs

Changelog: 14.01.2017 21:12  …
- Fix all search
- Fix SQL in KZ modules

Changelog: 14.01.2017 13:00  …
- Fix show update time in servers
- Add: add_servers.sql, add_kz_map.sql

Chachelog: 14.01.2017 10:40  …
- Edit System Authorization
- Edit Steam Authentication
- Edit UCP page
- Edit setup page and config.ini
- Fix get_steam_info()
- Add include: function_sql.php
- Add line search in kz_players
- Fix all template form - action
- Fix update-sql
- Fix SQL (PomanoB)

-------------------
-- Version 2.0.1 --
------------------- 

Chagelog: 12.01.2017 00:00  …
- Fix SQL
- FIx 15 rows in page2 and more.
- Add fucn mysqli_fetch_assoc_limit();

Changelog: 11.01.2017 17:17  …
- Fix 15 row in all pages
- Add mapComleted in players page
- Fix triggers
- Add new langs

Changelog: 11.01.2017 13:37  …
- Edit setup page
- Fix parce rules (closing slash)
- Edit SQL kz module (to View)
- Add sort Country in Players page
- Add SQL update time in Servers module
- Fix smarty function.generate_pages.php
- Add template capture {$generate_page}
- Fix save config

Changelog: 10.01.17 20.30  …
- Megre login and reg => auth
- New SQL "norec" kz_player
- Add: $geoip = geoip($db, $lastIp, $lang)
- Add Module hlds: hlserv.php == hlds.php

Changelog: 10.01.2017 01:30  …
- Fix kz_map - name_url
- Show mapname in Last Kreedz Records

Changlog: 10.01.2017 00:00  …
- Add new cake image
- Fix no noimage.jpg
- Add top Gold, Silver, Broze image on Kreedz
- Add weapons image
- Megre achiev pages
- Add specific function
- Fix ERRORS palyers
- Add Home page: vip servers and last top record
- Add myqli_new_rows() method total record (fastest sql query x2)
- Fix steam login (location)
- Add new method find players
- Fix defaul $lang
- Add update system on servers list
- Convert onlineTime for format [0y 65d 8h 40m 32s]
- Fix steamid link
- Fix/Add Update SQL query
- Add GeoLite2 Locations (Maxmind project - https://www.maxmind.com/)
- Add Achiev sort on Players page
- Add new method NoRec maps for player
- Add new method Record List on KzMap page
- Other fixes admin modules