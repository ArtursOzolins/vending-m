<?php

function createProduct ($name, $price) {
    $product = new stdClass();
    $product->name = $name;
    $product->price = $price;

    return $product;
}

$products = [
    createProduct('Twixbar', 60),
    createProduct('Sprite', 80),
    createProduct('Chips', 70),
];

$wallet = [
    1 => 3,
    2 => 5,
    5 => 4,
    10 => 5,
    20 => 3,
    50 => 2,
    100 => 4,
    200 => 1
];

$vendingMaschineAccepted = [
    10,
    20,
    50,
    100,
    200
];

$vendingMaschinePayback = [
    1,
    2,
    5,
    10,
    20,
    50,
    100,
    200
];


    echo '============================' . PHP_EOL;
    echo '======Vending maschine======' . PHP_EOL;
    foreach ($products as $key => $product) {
        echo "| {$key} | {$product->name} | Price: {$product->price} |" . PHP_EOL;
    }
    echo '============================' . PHP_EOL;
    $productChoice = readline('Choose your product: ');
    echo '============================' . PHP_EOL;
    echo 'You look in your wallet and see: ' . PHP_EOL;
    foreach ($wallet as $key => $value) {
        echo "|{$key}| Coins: {$value}|" . PHP_EOL;
    }

    $coinChoice = readline("Choose coins to pay {$products[$productChoice]->price}: ");
    $coinPass = false;
    if (array_search($coinChoice, $vendingMaschineAccepted) === false) {
        echo 'Not accepting this coin' . PHP_EOL;
        $coinPass = false;
    } else {
        $coinPass = true;
    }

    $coinSum = 0;
    while ($coinSum < $products[$productChoice]->price && $coinPass === true) {

        if (!is_integer($wallet[$coinChoice])) {
            echo 'No such coin in your wallet' . PHP_EOL;
            break;
        }

        $coinSum += $coinChoice;
        if ($coinSum = $products[$productChoice]->price) {
            echo ' !! brrr brrr -product sliding out- brrr brrr !! ' . PHP_EOL;
            break;
        } else if ($coinSum > $products[$productChoice]->price) {
            $paybackAmount = $coinSum - $products[$productChoice]->price;

        } else {
            $stillNeeded = $products[$productChoice]->price - $coinSum;
            $coinChoice = readline("{$stillNeeded} more required: ");
            if (array_search($coinChoice, $vendingMaschineAccepted) === false) {
                echo 'Not accepting this coin' . PHP_EOL;
                $coinPass = false;
            } else {
                $coinPass = true;
            }
        }
    }

    $giveBackSum = $coinSum - $products[$productChoice]->price;



    $choiceToBuy = 'n';
    echo '============================' . PHP_EOL;


//  && $wallet[$coinChoice]->quantity !== 0
