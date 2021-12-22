<?php 

include('user.php');

$user1 = new User();
$user1-> register('Thomas', 'Marseille13', 'thomas@gmail.com', 'thomas', 'serdjebi');

$user2 = new User();
$user2-> register('Dydy', 'Marseille13', 'dydy@gmail.com', 'dydy', 'serdjebi');

$user3 = new User();
$user3-> register('Paul', 'Marseille13', 'paul@gmail.com', 'paul', 'serdjebi');

?>