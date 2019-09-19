<?php

	function upload_file(Array $file = array('error'=>3), $dir, $size = 167772166){
		/* Функция для безопасной загрузки файла, возвращяет путь к загруженному файлу или 0 при огибке
		Принимает в массив $file со всеми элментами $_FILES для одного файла
		$dir полный путь к дериктории в которую загружать
		$size максимальный размре файла */
		
        include_once 'core/create_token.php';

        if ($file['error'] !== UPLOAD_ERR_OK or !is_uploaded_file($file['tmp_name']) or filesize($file['tmp_name']) > $size)
            return '0';

        $blacklist = $blacklist = array(".php", ".phtml", ".php3", ".php4", ".php5", ".php6", ".php7", ".htaccess", ".html", ".shtml");
        foreach ($blacklist as $item) {
            if(preg_match("/$item\$/i", $file['name']))
                return '0';
        }

        $file_name = time().touch_letter_token(16).basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $dir.$file_name))
           return (string) $file_name;
        else 
           return '0';
	}