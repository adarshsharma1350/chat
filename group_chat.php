<!-- <?php

//group_chat.php

// include('database_connection.php');

// session_start();

// if($_POST["action"] == "insert_data")
// {
// 	$data = array(
// 		':from_user_id'		=>	$_SESSION["user_id"],
// 		':chat_message'		=>	$_POST['chat_message'],
// 		':status'			=>	'1'
// 	);

// 	$query = "
// 	INSERT INTO chat_message 
// 	(from_user_id, chat_message, status) 
// 	VALUES (:from_user_id, :chat_message, :status)
// 	";

// 	$statement = $connect->prepare($query);

// 	if($statement->execute($data))
// 	{
// 		echo fetch_group_chat_history($connect);
// 	}

// }

// if($_POST["action"] == "fetch_data")
// {
// 	echo fetch_group_chat_history($connect);
// }

?> -->
<?php

// group_chat.php

include('database_connection.php');

session_start();

if ($_POST["action"] == "insert_data") {
    $from_user_id = $_SESSION["user_id"];
    $chat_message = $_POST['chat_message'];
    $status = '1';

    $query = "
    INSERT INTO chat_message (from_user_id, chat_message, status) 
    VALUES (?, ?, ?)
    ";

    $statement = $connect->prepare($query);

    if ($statement === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $statement->bind_param('iss', $from_user_id, $chat_message, $status);

    if ($statement->execute()) {
        echo fetch_group_chat_history($connect);
    } else {
        die('Execute failed: ' . htmlspecialchars($statement->error));
    }

    $statement->close();
}

if ($_POST["action"] == "fetch_data") {
    echo fetch_group_chat_history($connect);
}

?>
