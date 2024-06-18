<?php

// Array multidimensionale di hotel con indici numerici che contiene array associativi
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Situato sulla splendida costa amalfitana, l\'Hotel Belvedere offre viste mozzafiato sul mare, camere eleganti e un servizio impeccabile.',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Nel cuore di Firenze, questo hotel di lusso combina l\'eleganza storica con comfort moderni.',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Immerso nelle Dolomiti, questo resort è perfetto per gli amanti della montagna.',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Situato nel vibrante quartiere di Brera, questo hotel boutique offre design contemporaneo, camere eleganti e un\'atmosfera intima.',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Un\'oasi di tranquillità nella campagna toscana, questo resort offre suite lussuose, una spa completa di trattamenti benessere, e un ristorante che serve piatti tipici della cucina regionale preparati con ingredienti locali.',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

// Filtro gli hotel in base al parcheggio e al rating
$filtered_hotels = [];

// Verifico se è stato inviato il form con i filtri
if (isset($_GET['parking']) || isset($_GET['rating'])) {

    // Recupero i valori dei filtri
    $parking_filter = isset($_GET['parking']) ? $_GET['parking'] : null;
    $rating_filter = isset($_GET['rating']) ? $_GET['rating'] : null;

    // Ciclo sull'array di hotel per applicare i filtri
    foreach ($hotels as $hotel) {
        $include_hotel = true;

        // Filtro per parcheggio
        if (!is_null($parking_filter)) {
            if ($parking_filter == 'yes' && $hotel['parking'] == false) {
                $include_hotel = false;
            }
            if ($parking_filter == 'no' && $hotel['parking'] == true) {
                $include_hotel = false;
            }
        }

        // Filtro per rating
        if (!is_null($rating_filter)) {
            if ($hotel['vote'] != $rating_filter) {
                $include_hotel = false;
            }
        }

        // Se l'hotel soddisfa tutti i filtri, lo aggiungo agli hotel filtrati
        if ($include_hotel) {
            $filtered_hotels[] = $hotel;
        }
    }
} else {
    // Se non ci sono filtri applicati, mostro tutti gli hotel
    $filtered_hotels = $hotels;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotels</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main>
        <section class="container mt-5">
            <h1 class="text-center mb-5 display-3 fw-bold text-primary">PHP Hotels</h1>
            <!-- Select per i filtri -->
            <form action="index.php" method="GET">
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Select per il filtro parcheggio -->
                        <select class="form-select" aria-label="Default select example" name="parking">
                            <option selected disabled>Parking</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Select per il filtro stelle -->
                        <select class="form-select" aria-label="Default select example" name="rating">
                            <option selected disabled>Rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                </div>
                <!-- Bottone per inviare il form -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mb-5">Submit</button>
                </div>
            </form>

            <h2 class="text-center mb-4 fw-bold text-primary">Available Hotels</h2>
            <!-- Tabella -->
            <table class="table table-striped table-bordered text-center mb-5">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <!-- Mi assicuro che l'array non sia vuoto prima di ciclare -->
                        <?php if (!empty($filtered_hotels)) : ?>
                            <!-- Ciclo sull'array multidimensionale in posizione 0 per prendere tutte le chiavi dell'array associativo -->
                            <?php foreach (array_keys($filtered_hotels[0]) as $key) : ?>
                                <th scope="col"><?php echo ucwords(str_replace('_', ' ', $key)); ?></th>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo sull'array filtrato o quello di partenza prendendo anche l'index per calcolare il numero della row dinamicamente -->
                    <?php foreach ($filtered_hotels as $index => $hotel) : ?>
                        <tr>
                            <!-- Rappresento dinamicamente il numero della row e lo incremento ad ogni ciclo -->
                            <th scope="row"><?php echo $index + 1; ?></th>

                            <!-- Ciclo su ogni array associativo e prendo chiavi e valori -->
                            <?php foreach ($hotel as $key => $value) : ?>

                                <!-- Stampo i value del ciclo e nel caso in cui il valore sia booleano rappresento yes or no invece di 1 o null -->
                                <td width="21%">
                                    <?php echo is_bool($value) ? ($value ? 'Yes' : 'No') : $value; ?>
                                </td>
                            <?php endforeach ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>