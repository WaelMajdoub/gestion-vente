<?php

	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
	$DB_NAME = 'gestion-vente';
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}


        $cntAr_stmt = $DB_con->prepare('SELECT * FROM articles ');
        $cntAr_stmt->execute();
         $nbrAr = $cntAr_stmt->rowCount();

        $cntC_stmt = $DB_con->prepare('SELECT * FROM categories ');
        $cntC_stmt->execute();
        $nbrC = $cntC_stmt->rowCount();

        $cntCde_stmt = $DB_con->prepare('SELECT * FROM commandes ');
        $cntCde_stmt->execute();
        $nbrCde = $cntCde_stmt->rowCount();


	
