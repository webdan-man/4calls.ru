<?php
$frm = $_POST['frmid'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$package = $_POST['package'];
$text = $_POST['text'];
$utm_source = $_POST['utm_source'];
$utm_medium = $_POST['utm_medium'];
$utm_campaign = $_POST['utm_campaign'];
$utm_term = $_POST['utm_term'];
$source_type = $_POST['source_type'];
$source = $_POST['source'];
$position_type = $_POST['position_type'];
$position = $_POST['position'];
$added = $_POST['added'];
$creative = $_POST['creative'];
$matchtype = $_POST['matchtype'];
$location = $_POST['location'];
$url = $_POST['url'];
$title = $_POST['title'];

$subject = 'Заявка 4calls.ru';	

//$to = "info@stoleshnica812.net";

$message = "Форма: $frm\n\n";
$message .= "Имя: $name\n";
$message .= "Телефон: $phone\n";
$message .= "Email: $email\n\n";
$message .= "Тип версии: $package\n\n";
$message .= "Сообщение: $text\n\n";
$message .= "Источник: $utm_source\n";
$message .= "Тип источника: $utm_medium\n";
$message .= "Кампания: $utm_campaign\n";
$message .= "Ключевое слово: $utm_term\n";
$message .= "Тип площадки(поиск или контекст): $source_type\n";
$message .= "Площадка: $source\n";
$message .= "Спецразмещение или гарантия: $position_type\n";
$message .= "Позиция объявления в блоке: $position\n";
$message .= "Показ по дополнительным ролевантным фразам: $added\n";
$message .= "Идентификатор объявления: $creative\n";
$message .= "Тип соответствия ключа(e-точное/p-фразовое/b-широкое): $matchtype\n\n";
$message .= "Гео-положение отправителя: $location\n\n";
$message .= "Ссылка на сайт: $url\n";
$message .= "Заголовок: $title\n";


$boundary = "--".md5(uniqid(time())); 

$headers = "X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0;\r\n"; 
$headers .="Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";


$multipart = "--$boundary\r\n"; 
$multipart .= "Content-Type: text/plain; charset=utf-8\r\n";
$multipart .= "Content-Transfer-Encoding: base64\r\n";    
$multipart .= "\r\n";
$multipart .= chunk_split(base64_encode($message));


$path = getcwd().DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR;

    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {

    $tmp_name = $_FILES['file']['tmp_name'];

    $file_name = $_FILES['file']['name'];

    $upload_file = $path.basename($file_name);

    move_uploaded_file($tmp_name, $upload_file);



	$fp = fopen($upload_file,"r"); 
	$file = fread($fp, filesize($upload_file)); 
	fclose($fp); 


	$message_part = "\r\n--$boundary\r\n"; 
	$message_part .= "Content-Type: application/octet-stream; name=\"$file_name\"\r\n";  
	$message_part .= "Content-Transfer-Encoding: base64\r\n"; 
	$message_part .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n"; 
	$message_part .= "\r\n";
	$message_part .= chunk_split(base64_encode($file));
	$message_part .= "\r\n--$boundary\r\n"; 

	$multipart .= $message_part;

    }

$message = $multipart;



//mail ($to,$subject,$message,$headers);

$to = "mail@4calls.ru";
mail ($to,$subject,$message,$headers);

$files = glob('upload/*'); 
foreach($files as $file_name){ 
  if(is_file($file_name))
    unlink($file_name); 
}

?>