<?php
function getPokemonDataById($id) {
    $url = "https://pokeapi.co/api/v2/pokemon/" . $id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo "Failed to fetch data for Pokemon ID: $id";
        return null;
    }

    $data = json_decode($response, true);

    // Debugging output
    if (is_null($data)) {
        echo "Failed to decode JSON for Pokemon ID: $id";
    }

    return $data;
}
?>
