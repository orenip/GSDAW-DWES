INSERT INTO `equipos` ( `NOMBRE_EQUIPO`, `PRESUPUESTO`, `FECHA_FUNDACION`, `ZONA_id`,`TITULOS`) VALUES
('Real Madrid', 25000000, '2023-10-30', 3, 8),
('Denver Nuggetstos', 844500005, '1968-09-17', 4, 1),
('Portland Trailblazers', 79150000, '1971-08-12', 1, 1),
('Utah Jazz', 87450000, '1974-07-22', 1, 0),
('Oklahoma City Thunder', 62450000, '2008-09-02', 1, 0),
('Minesotta Timberwolves', 75430000, '1968-09-14', 1, 0),
('Los Angeles Lakers', 92450000, '1951-09-03', 2, 15),
('Phoenix Suns', 89176000, '1967-08-12', 2, 1),
('Golden State Warriors', 66450000, '1970-07-22', 2, 0),
('Los Angeles Clippers', 82320000, '1967-08-02', 2, 0),
('Sacramento Kings', 69930000, '1964-07-23', 2, 1),
('San Antonio Spurs', 87320000, '1971-09-13', 3, 4),
('Houston Rockets', 79546000, '1972-08-21', 3, 2),
('Dallas Mavericks', 88430000, '1973-07-22', 3, 0),
('New Orleans Hornets', 80100000, '1974-08-23', 3, 0),
('Memphis Grizzlies', 70230000, '1975-07-24', 3, 0),
('Boston Celtics', 96320000, '1949-07-13', 4, 18),
('Philadelphia Sixers', 84566000, '1962-08-02', 4, 1),
('New Jersey Nets', 78640000, '1968-08-03', 4, 0),
('Toronto Raptors', 69860000, '1999-08-04', 4, 0),
('New York Knicks', 98240000, '1961-08-05', 4, 2),
('Cleveland Cavaliers', 96090000, '1970-08-11', 6, 0),
('Chicago Bulls', 82466000, '1971-09-12', 6, 6),
('Detroit Pistons', 89840000, '1968-07-13', 6, 4),
('Indiana Pacers', 77250000, '1978-07-14', 6, 0),
('Milwaukee Bucks', 70200000, '1981-07-15', 6, 0),
('Orlando Magic', 89650000, '2001-06-07', 5, 0),
('Atlanta Hawks', 80476000, '1964-08-07', 5, 0),
('Miami Heat', 79870000, '1988-08-09', 5, 1),
('Charlotte Bobcats', 65490000, '2004-09-08', 5, 0),
('Washington Wizards', 85410000, '1997-08-10', 5, 0);

INSERT INTO `jugadores` (`NOMBRE_JUGADOR`, `FECHA_NACIMIENTO`, `ESTATURA`, `POSICION`, `equipo_id`)
VALUES
('Denver', '2023-11-01', 15, 'Alero', 1),
('Brandon Roy', '1989-02-04', 198, 'Alero', 2),
('Andre Miller', '1984-12-24', 188, 'Base', 2),
('Greg Oden', '1986-12-19', 213, 'Pivot', 2),
('Andrei Kirilenko', '1985-03-01', 206, 'Alero', 3),
('Kosta Koufos', '1983-07-22', 215, 'Pivot', 3),
('James Harden', '1989-03-15', 196, 'Escolta', 4),
('Jeff Green', '1988-03-03', 205, 'Alero', 4),
('Ethan Thomas', '1984-11-17', 208, 'Ala-pivot', 4),
('Wayne Ellington', '1981-04-23', 193, 'Base', 5),
('Damien Wilkins', '1980-08-11', 198, 'Alero', 5),
('Mark Blount', '1983-10-13', 215, 'Pivot', 5),
('Manolo GIL', '2023-11-22', 170, 'Alero', 6),
('Dereck Fisher', '1979-03-17', 192, 'Base', 7),
('Kobe Bryant', '1981-11-13', 198, 'Escolta', 7),
('Pau Gassol', '1982-08-16', 216, 'Ala-pivot', 7),
('Steve Nash', '1977-09-01', 191, 'Base', 8),
('Jason Richardson', '1979-04-08', 198, 'Alero', 8),
('Channing Frye', '1988-01-31', 211, 'Ala-pivot', 8),
('Monta Ellis', '1979-07-07', 190, 'Base', 9),
('Anthony Randolph', '1982-12-13', 208, 'Alero', 9),
('Brandan Wright', '1980-09-13', 208, 'Pivot', 9),
('Bobby Brown', '1987-11-06', 178, 'Base', 10),
('Ricky Davis', '1987-11-15', 201, 'Alero', 10),
('Brandan Wright', '1980-09-13', 208, 'Pivot', 10),
('Sergio Rodriguez', '1988-06-11', 191, 'Base', 11),
('Tyreke Evans', '1989-08-13', 198, 'Alero', 11),
('Spencer Hawes', '1984-10-22', 216, 'Pivot', 11),
('Manu Ginobilli', '1982-04-17', 198, 'Escolta', 12),
('Michael Finley', '1973-02-04', 201, 'Alero', 12),
('Tim Duncan', '1975-01-25', 211, 'Ala-pivot', 12),
('Aaron Brooks', '1986-05-02', 183, 'Base', 13),
('Tracy McGrady', '1980-12-07', 203, 'Alero', 13),
('Yao Ming', '1984-09-12', 229, 'Pivot', 13),
('Jason Kidd', '1975-10-02', 193, 'Base', 14),
('Shawn Marion', '1977-09-05', 201, 'Alero', 14),
('Dirk Nowitzki', '1981-05-15', 213, 'Ala-pivot', 14),
('Chris Paul', '1988-12-11', 183, 'Base', 15),
('Peja Stojakovic', '1979-02-01', 208, 'Alero', 15),
('Aaron Grey', '1991-11-17', 212, 'Pivot', 15),
('Mike Conley', '1977-08-16', 185, 'Base', 16),
('Rudy Gay', '1988-12-04', 203, 'Alero', 16),
('Marc Gassol', '1986-01-13', 216, 'Pivot', 16),
('Ray Allen', '1981-02-11', 196, 'Escolta', 17),
('Paul Pierce', '1983-07-15', 201, 'Alero', 17),
('Kevin Garnett', '1978-12-19', 211, 'Ala-pivot', 17),
('Willie Green', '1989-10-13', 191, 'Base', 18),
('Elton Brand', '1983-09-13', 206, 'Alero', 18),
('Samuel Dalembert', '1988-01-14', 211, 'Pivot', 18),
('Devin Harris', '1987-12-19', 191, 'Base', 19),
('Trenton Hassell', '1975-02-01', 196, 'Alero', 19),
('Brook Lopez', '1990-03-17', 213, 'Pivot', 19),
('Jose Manuel Calderon', '1981-03-31', 192, 'Base', 20),
('Andrea Bargnani', '1987-08-17', 213, 'Alero', 20),
('Chris Bosh', '1984-12-03', 208, 'Alero', 20),
('Nate Robinson', '1981-03-31', 175, 'Base', 21),
('Marcus Landry', '1982-08-16', 201, 'Alero', 21),
('Eddy Curry', '1975-11-07', 213, 'Pivot', 21),
('Delonte West', '1988-03-16', 192, 'Base', 22),
('Lebron James', '1986-12-15', 203, 'Alero', 22),
('Saquille O?neal', '1974-03-19', 216, 'Pivot', 22),
('Jannero Pargo', '1984-11-15', 185, 'Base', 23),
('Luol Deng', '1986-10-17', 206, 'Alero', 23),
('Jerome James', '1984-10-29', 216, 'Pivot', 23),
('Rodney Stuckey', '1990-10-05', 196, 'Base', 24),
('Tayshaun Prince', '1984-03-19', 205, 'Alero', 24),
('Ben Wallace', '1977-04-24', 206, 'Pivot', 24),
('Travis Diener', '1987-03-25', 185, 'Base', 25),
('Solomon Jones', '1988-07-29', 208, 'Alero', 25),
('Roy Hibbert', '1989-07-14', 218, 'Pivot', 25),
('Luke Ridnour', '1989-10-15', 188, 'Base', 26),
('Ersan Ilyasova', '1988-04-17', 208, 'Alero', 26),
('Francisco Elson', '1979-09-23', 211, 'Ala-pivot', 26),
('Jason Williams', '1983-11-25', 185, 'Base', 27),
('Vince Carter', '1980-10-21', 198, 'Escolta', 27),
('Dwight Howard', '1987-01-06', 211, 'Pivot', 27),
('Mike Bibby', '1979-04-21', 188, 'Base', 28),
('Marvin Williams', '1986-11-21', 206, 'Alero', 28),
('Jason Collins', '1988-06-01', 213, 'Pivot', 28),
('Mario Chalmers', '1986-12-22', 185, 'Base', 29),
('Dwyane Wade', '1981-07-11', 193, 'Escolta', 29),
('Jamal Magloire', '1984-05-13', 211, 'Pivot', 29),
('Gerald Henderson', '1988-12-12', 196, 'Base', 30),
('Gerald Wallace', '1980-11-24', 201, 'Alero', 30),
('Desagana Diop', '1985-05-23', 213, 'Pivot', 30),
('Gilbert Arenas', '1983-01-01', 193, 'Base', 31),
('Mike Miller', '1982-10-13', 203, 'Escolta', 31),
('Brendan Haywood', '1989-07-24', 214, 'Pivot', 31);

INSERT INTO `partidos` (`FECHA`, `COD_EQUIPO1_id`, `COD_EQUIPO2_id`, `PUNTOS_EQUIPO1`, `PUNTOS_EQUIPO2`) VALUES
('2017-11-27', 24, 22, 15, 117),
('2017-11-01', 22, 18, 95, 93),
('2017-11-01', 5, 14, 99, 106),
('2017-11-01', 10, 22, 89, 106),
('2017-11-02', 7, 9, 106, 95),
('2017-11-02', 14, 9, 82, 91),
('2017-11-02', 3, 4, 92, 78),
('2017-11-02', 5, 8, 102, 85),
('2017-11-02', 10, 2, 64, 84),
('2017-11-02', 7, 3, 104, 86),
('2017-11-02', 23, 12, 114, 107),
('2017-11-02', 12, 5, 94, 79),
('2017-11-13', 10, 22, 101, 102),
('2017-11-13', 5, 14, 88, 100),
('2017-11-13', 10, 22, 113, 120),
('2017-11-13', 7, 3, 88, 73);

INSERT INTO `zonas` ( `NOMBRE_ZONA`) VALUES
('North Westo'),
('Pacific'),
('South West'),
('Altantic'),
('North West HAM'),
('South EastO');