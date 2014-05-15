<?php

// First Row
$line = $users[0]['User'];
$this->Csv->addRow(array_keys($line));

// All Users
foreach ($users as $user) {
	$line = $user['User'];
	$this->Csv->addRow($line);
}

$filename = 'registered_'.date('d-m-Y', time());
echo $this->Csv->render($filename);
