<?php

/** @var \Model\Entity\User $user */
/** @var float $lastPurchaseCost */
$body = function () use ($user, $lastPurchaseCost, $path) {
    ?>
    <div align="center">Личный кабинет</div>
    <div align="left">
    <ul>
        <li>
            День рождения: <?php echo $user->getBirthData();?>
        </li>
        <li>
            Сумма последнего заказа: <?php echo $lastPurchaseCost;?>
        </li>
    </ul>
    </div>
<?php
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Пользователи',
        'body' => $body,
    ]
);
