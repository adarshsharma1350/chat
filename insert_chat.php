<?php

// //insert_chat.php

// include('database_connection.php');

// session_start();

// $data = array(
// 	':to_user_id'		=>	$_POST['to_user_id'],
// 	':from_user_id'		=>	$_SESSION['user_id'],
// 	':chat_message'		=>	$_POST['chat_message'],
// 	':status'			=>	'1'
// );

// $query = "
// INSERT INTO chat_message 
// (to_user_id, from_user_id, chat_message, status) 
// VALUES (:to_user_id, :from_user_id, :chat_message, :status)
// ";

// $statement = $connect->prepare($query);

// if($statement->execute($data))
// {
// 	echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
// }

//insert_chat.php

include('database_connection.php');

session_start();

$to_user_id = $_POST['to_user_id'];
$from_user_id = $_SESSION['user_id'];
$chat_message = $_POST['chat_message'];
$status = '1';

$query = "
INSERT INTO chat_message (to_user_id, from_user_id, chat_message, status) 
VALUES (?, ?, ?, ?)
";

$statement = $connect->prepare($query);
$statement->bind_param('iiss', $to_user_id, $from_user_id, $chat_message, $status);

if($statement->execute())
{
    echo fetch_user_chat_history($from_user_id, $to_user_id, $connect);
}


?>