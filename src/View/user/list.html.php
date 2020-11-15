<?php

/** @var \Model\Entity\User[] $userList */
$body = function () use ($userList, $path) {
    ?>
    <div align="center">Пользователи</div>
    <div align="left">
    <ol>
<?php
    foreach ($userList as $key => $user) {
        ?>
            <li>
                <?php echo $user->getName(); ?>
            </li>
 <?php
    } ?>
    </ol>
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
