<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$lucie = new Warrior('Lucie');
$anto = new Mage('Anto');
$jon = new Archer('Jon');

while ($lucie->isAlive() && $jon->isAlive()) {
    // First Character attacking the 2nd
    echo $lucie->action($jon);
    // Check if target is alive
    if (!$jon->isAlive()) {
        echo '<br>';
        echo "$jon->pseudo est KO!";
        break;
    };
    echo '<br>';

    // Second Character attaking the first
    echo $jon->action($lucie);
    // Check if target is alive
    if (!$lucie->isAlive()) {
        echo '<br>';
        echo "$lucie->pseudo est KO!";
        break;
    };
    echo '<br>';
}
?>