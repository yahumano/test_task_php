<?php
    require 'libs/rb-mysql.php';

    R::setup("mysql:host=127.0.0.1;dbname=auto", 'phpmyadmin', '123');

    if (!R::testConnection()){
		R::close();
        exit('<h1 style="text-align: center;">Ошибка!</h1>');
    }