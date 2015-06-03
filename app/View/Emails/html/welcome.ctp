<?php

$Email = new CakeEmail();
$Email->template('welcome', 'fancy')
    ->emailFormat('both')
    ->to('ankit@kingcoda.com')
    ->from('you@localhost.com')
    ->send();

?>