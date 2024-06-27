// pokemonData.js
let pokemonArray = [];

 export async function fetchPokemonData(searchTerm) {
    const response = await fetch(`search.php?search=${encodeURIComponent(searchTerm)}`);
    if (!response.ok) {
        throw new Error('Errore durante il recupero dei dati dei Pokémon');
    }
    const pokemonList = await response.json();
    pokemonArray = pokemonList; // Aggiorna l'array globale con i dati recuperati
}

// Funzione per ottenere l'array di Pokémon
function getPokemonArray() {
    return pokemonArray;
}