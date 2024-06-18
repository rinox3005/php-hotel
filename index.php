<?php

// Array multidimensionale di hotel con indici numerici che contiene array associativi
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

// Filtro gli hotel in base al parcheggio
$filtered_hotels = [];

// utilizzo isset per verificare se il valore sella select non é nullo, se é settato entro nell'if
if (isset($_GET['parking'])) {

    // assegno il valore che passo in get ad una variabile
    $parking_filter = $_GET['parking'];

    // ciclo sull'array multidimensionale e filtro gli hotel in base al valore di $parking_filter che passo in get dalla select
    foreach ($hotels as $hotel) {
        if ($parking_filter == 'yes' && $hotel['parking'] == true) {
            $filtered_hotels[] = $hotel;
        } elseif ($parking_filter == 'no' && $hotel['parking'] == false) {
            $filtered_hotels[] = $hotel;
        }
    }
    // se non seleziono nulla l'array da utilizzare é quello di partenza
} else {
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
</head>

<body>
    <main>
        <section class="container mt-5">
            <h1 class="text-center mb-5">PHP Hotels</h1>
            <!-- Select per i filtri -->
            <form action="index.php" method="GET">
                <div class="row justify-content-center mb-3">
                    <div class="col-6">
                        <!-- Select per il filtro parcheggio -->
                        <select class="form-select" aria-label="Default select example" name="parking">
                            <option selected disabled>Parking</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mb-5">Submit</button>
                </div>
            </form>

            <h2 class="text-center mb-4">Available Hotels</h2>
            <!-- Tabella -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <!-- Ciclo sull'array multidimensionale in posizione 0 per prendere tutte le chiavi dell'array associativo -->
                        <?php foreach ($filtered_hotels[0] as $key => $value) : ?>
                            <th scope="col"><?php echo $key; ?></th>
                        <?php endforeach ?>
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
                                <td>
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