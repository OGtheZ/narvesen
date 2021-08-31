<?php

$inventory = [
    ["item" => "HotDog", "quantity" => 10, "price" => 250],
    ["item" => "CocaCola", "quantity" => 20, "price" => 100],
    ["item" => "Fanta", "quantity" => 20, "price" => 100],
    ["item" => "Sprite", "quantity" => 20, "price" => 100],
    ["item" => "Marliks", "quantity" => 20, "price" => 500],
    ["item" => "Vinstons", "quantity" => 20, "price" => 450],
    ["item" => "VikingLotto", "quantity" => 200, "price" => 50],
    ["item" => "RedBull", "quantity" => 25, "price" => 190],
    ["item" => "MonsterEnergy", "quantity" => 15, "price" => 250]
];

$customer = new stdClass();
$customer -> money = 1500;
$customer -> name = "George";

$basket = [];

echo "$customer->name, welcome to the Queens Bodega!" . PHP_EOL;
$keepShopping = true;
while($keepShopping) {
    echo "The assortment of items is: " . PHP_EOL;
    foreach ($inventory as $items) {
        echo "Item Nr: " . array_search($items, $inventory);
        echo ". $items[item], amount available $items[quantity], price of " . $items["price"] / 100 . " $" . PHP_EOL;
    }

    $itemsChosen = (int)readline("What can I get you? Provide item number please : ");
    if ($itemsChosen > count($inventory) || $itemsChosen < 0) {
        echo "Enter a valid item number!" . PHP_EOL;
        continue;
    }
    $itemQuantity = (int)readline("How many of these would you like? ");
    if ($itemQuantity > $inventory[$itemsChosen]["quantity"]) {
        echo "We ain't got that many of those! We only got " . $inventory[$itemsChosen]["quantity"] . " of those!" . PHP_EOL;
        continue;
    }

    $basket[] = [$inventory[$itemsChosen]['item'], $itemQuantity, $inventory[$itemsChosen]['price'] * $itemQuantity];
    $inventory[$itemsChosen]["quantity"] = $inventory[$itemsChosen]["quantity"] - $itemQuantity;
    $total = 0;
    foreach ($basket as $product) {
        $total = $total + $product[2];
    }
    echo "The total at the moment is :" . ($total / 100) . "$" . PHP_EOL;

    $somethingElse = readline("Can I get you something else? y/n  ");
    if ($somethingElse === 'n') {
        echo "The total is: " . $total / 100 . "$. Time to pay!";
        if ($total > $customer->money) {
            echo "You don't have enough doe for this one buster!";
            exit;
        } else {
            $customer -> money = $customer->money - $total;
            echo "You have $customer->money $ left.";
        }
        $keepShopping = false;
        echo "Thank you for visiting your local bodega!" . PHP_EOL;
        echo "You purchased: ";
        foreach ($basket as $product) {
            echo $product[1] . " " . $product[0] . ", ";
        }
        exit;
    }
}
