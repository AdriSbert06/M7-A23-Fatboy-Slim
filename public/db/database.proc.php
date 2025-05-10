<?php
$db = new SQLite3('../public/db/musics.db');

$db->exec("CREATE TABLE IF NOT EXISTS musics (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    birth_date TEXT,
    death_date TEXT,
    genre TEXT,
    image_url TEXT,
    hit_song TEXT
)");

$db->exec("INSERT INTO musics (name, birth_date, death_date, genre, image_url, hit_song) VALUES
('Bruno Mars', '1985-10-08', NULL, 'Pop / Funk / R&B', 'https://i.scdn.co/image/ab6761610000e5ebc36dd9eb55fb0db4911f25dd', 'Uptown Funk'),
('Freddie Mercury', '1946-09-05', '1991-11-24', 'Rock', 'https://hips.hearstapps.com/hmg-prod/images/freddie-mercury-wembley-live-aid-13-julio-1985-1502982486.jpg?crop=1xw:1xh;center,top&resize=980:*', 'Bohemian Rhapsody'),
('Adele', '1988-05-05', NULL, 'Soul / Pop', 'https://ca-times.brightspotcdn.com/dims4/default/4aecb2d/2147483647/strip/true/crop/2786x2080+0+0/resize/1200x896!/quality/75/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2F43%2F5d%2F472688631f96fded895dcc2b27c1%2Fde32dcf8da0845bc916ca51223557a2f', 'Someone Like You'),
('Eminem', '1972-10-17', NULL, 'Rap / Hip-Hop', 'https://www.infobae.com/resizer/v2/https%3A%2F%2Fs3.amazonaws.com%2Farc-wordpress-client-uploads%2Finfobae-wp%2Fwp-content%2Fuploads%2F2017%2F05%2F03072224%2FEminem-1920.jpg?auth=56680577a984dfcf9a35e803376865accf5db91148c78b1e447de686c718c764&smart=true&width=1200&height=675&quality=85', 'Lose Yourself'),
('El Fary', '1937-08-20', '2007-06-19', 'Copla / Flamenco', 'https://static.lasprovincias.es/www/multimedia/202108/03/media/ElFary_ArchivoRTVE%20(1).jpg', 'Apatrullando la ciudad')
");

$db->close();
?>
