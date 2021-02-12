<?php
$input = htmlspecialchars($_GET["poke-name"]);
$api = file_get_contents('https://pokeapi.co/api/v2/pokemon/'.$input);
//var_dump($api);
//echo ($api);
$data = json_decode($api, true);
//var_dump($data);
$poke_ID = $data['id'];
$species_url = $data['species']['url'];
$evolution_api = file_get_contents($species_url);
//echo $evolution_api;
$evolution_data = json_decode($evolution_api,true);
$poke_evolution = $evolution_data['evolves_from_species'];
//var_dump($poke_evolution);
$poke_evolution_name = $poke_evolution['name'];
//echo $poke_evolution_name;
$moves = $data['moves'];
//echo $moves;
//echo var_dump($moves['0']);

function get_img ($name){
    $img_url = json_decode(file_get_contents('https://pokeapi.co/api/v2/pokemon/'.$name),true);
    return $img_url['sprites']['front_shiny'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeDex</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="grid-container">
    <div class="grid-item">
        <p>Look for your Pokemon by name or ID: </p>
        <form action="index.php">
            <input type="text" id="poke-name" name="poke-name">
            <input type = "submit" value="Submit">
        </form>



    </div>


    <div class="grid-item">
        <div class="sprite">
            <img src="<?= $data['sprites']['front_shiny']?>" alt="pokemon image" id="poke-photo"/>
        </div>
        <img id= "pokedex" src="pokedex.png"/>
        <div class="moves" id="poke-moves">Moves
            <template id="template">
                <li class="move"></li>
            </template>
            <ul id="target">

                    <?php
                    for ($i = 0; $i <4; $i++){
                        echo "<li>".$moves[$i]['move']['name']."</li>";

                    } ?>

            </ul>
        </div>
        <div class="evoluti"> <span id="poke-evolution"> <?=$poke_evolution_name?> </span> <img src="<?= get_img($poke_evolution_name)?>" id="poke_evolve_from"/></div>
        <div class="poke_id" id="poke-ID">
            <?= "ID : ".$poke_ID. "<br>"."Name : ".$data['name']?>
        </div>
    </div>

</div>
<script src="main.js/"></script>
</body>
</html>


