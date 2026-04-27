<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rossi DJ - Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-image: url('flx10live1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 900px;
            width: 100%;
            padding: 30px;
            background: rgba(0, 0, 0, 0.85);
            border-radius: 20px;
            border: 1px solid #444;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(5px);
        }

        h1 {
            color: #00d4ff;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 30px;
        }

        .album-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
        }

        .album-card {
            background-color: #1a1a1a;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #333;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            text-decoration: none;
            display: block;
            color: white;
        }

        .album-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.2);
            border-color: #00d4ff;
        }

        .album-cover {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-bottom: 2px solid #333;
            transition: border-color 0.3s;
        }

        .album-card:hover .album-cover {
            border-color: #00d4ff;
        }

        .album-info {
            padding: 15px;
            text-align: center;
        }

        .album-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: bold;
            color: #ffffff;
        }

        .album-card:hover .album-title {
            color: #00d4ff;
        }

        .icona-cartella {
            font-size: 2.5rem;
            color: #00d4ff;
            margin-bottom: 10px;
            display: block;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-back:hover {
            background-color: #00d4ff;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="index.html" class="btn-back"><i class="fas fa-arrow-left"></i> Torna alla Home</a>
        
        <h1>📸 Gallery Eventi</h1>

        <div class="album-grid">
            <?php
            // Imposta il percorso della cartella principale delle foto
            $cartella_principale = 'foto/';

            // Controlla se la cartella "foto" esiste
            if (is_dir($cartella_principale)) {
                
                // Legge tutto quello che c'è dentro la cartella
                $elementi = scandir($cartella_principale);
                
                foreach ($elementi as $cartella_album) {
                    // Salta i file di sistema nascosti (. e ..) e verifica che sia effettivamente una cartella
                    if ($cartella_album !== '.' && $cartella_album !== '..' && is_dir($cartella_principale . $cartella_album)) {
                        
                        // Trasforma il nome della cartella in un bel titolo (es: "festa_in_spiaggia" diventa "Festa In Spiaggia")
                        $titolo_pulito = str_replace('_', ' ', $cartella_album);
                        $titolo_pulito = ucwords($titolo_pulito);
                        
                        // Cerca una foto chiamata "cover.jpg" dentro la cartella dell'album
                        $percorso_cover = $cartella_principale . $cartella_album . '/cover.jpg';
                        
                        // Genera il blocco HTML per ogni cartella trovata
                        echo '
                        <a href="visualizza_foto.html?album=' . urlencode($cartella_album) . '" class="album-card">
                            <img src="' . htmlspecialchars($percorso_cover) . '" alt="' . htmlspecialchars($titolo_pulito) . '" class="album-cover" onerror="this.src=\'https://via.placeholder.com/300x160/222/00d4ff?text=Nessuna+Copertina\'">
                            <div class="album-info">
                                <i class="fas fa-folder icona-cartella"></i>
                                <h3 class="album-title">' . htmlspecialchars($titolo_pulito) . '</h3>
                            </div>
                        </a>';
                    }
                }
            } else {
                echo '<p style="text-align:center; width: 100%;">La cartella "foto" non è stata ancora creata.</p>';
            }
            ?>
        </div>
    </div>

</body>
</html>