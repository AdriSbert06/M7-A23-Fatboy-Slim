<?php
$db = new SQLite3('musics.db');

// Crear la tabla (si no existe)
$db->exec("CREATE TABLE IF NOT EXISTS musics (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    birth_date TEXT,
    death_date TEXT,
    genre TEXT,
    image_url TEXT,
    hit_song TEXT
)");

// Insertar datos (esto solo debería hacerse una vez)
$db->exec("INSERT INTO musics (name, birth_date, death_date, genre, image_url, hit_song) VALUES
('Bruno Mars', '1985-10-08', NULL, 'Pop / Funk / R&B', 'https://i.scdn.co/image/ab6761610000e5ebc36dd9eb55fb0db4911f25dd', 'Uptown Funk'),
('Freddie Mercury', '1946-09-05', '1991-11-24', 'Rock', 'https://upload.wikimedia.org/wikipedia/commons/0/0e/Freddie_Mercury_1984_1.jpg', 'Bohemian Rhapsody'),
('Adele', '1988-05-05', NULL, 'Soul / Pop', 'https://upload.wikimedia.org/wikipedia/commons/3/3c/Adele_2016.jpg', 'Someone Like You'),
('Eminem', '1972-10-17', NULL, 'Rap / Hip-Hop', 'https://upload.wikimedia.org/wikipedia/commons/7/75/Eminem_2014.jpg', 'Lose Yourself'),
('El Fary', '1937-08-20', '2007-06-19', 'Copla / Flamenco', 'https://upload.wikimedia.org/wikipedia/commons/d/d9/El_Fary.jpg', 'Apatrullando la ciudad')
");

// Actualizar URLs de las imágenes a rutas locales
$db->exec("UPDATE musics SET image_url = 'public/fotos/brunoMars.jpeg' WHERE name = 'Bruno Mars'");
$db->exec("UPDATE musics SET image_url = 'public/fotos/freddyM.png' WHERE name = 'Freddie Mercury'");
$db->exec("UPDATE musics SET image_url = 'public/fotos/adele.jpeg' WHERE name = 'Adele'");
$db->exec("UPDATE musics SET image_url = 'public/fotos/Eminem.png' WHERE name = 'Eminem'");
$db->exec("UPDATE musics SET image_url = 'public/fotos/elfary.png' WHERE name = 'El Fary'");

$db->close();
?>
