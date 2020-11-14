<?php

/** @var \Closure $path */
$body = function () use ($path) {
    ?>
    <form method="post">
        <table cellpadding="10">
            <tr>
                <td colspan="3" align="center">Покупка успешно совершена</td>
            </tr>
        </table>
    </form>
    <?php
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Покупка',
        'body' => $body,
    ]
);
