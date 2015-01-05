<?php

if (count($_SERVER['argv']) < 3) {
	echo 'Usage: create-user.php <email> <password>';
	exit;
}

list(, $email, $password) = $_SERVER['argv'];

require __DIR__ . '/bootstrap.php';

$manager = $container->getByType('App\Model\UserManager');
$manager->add($email, $password);

echo 'Uzivatel byl pridan';