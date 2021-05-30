<?php
	$controllerPath = "Controller";
	include("$controllerPath/ChatController.php");
	
	$ChatController = new ChatController();
	$posts = $ChatController->Get($_POST['ID']);

	$output = '';
	foreach($posts as $row)
	{
		$id = $row["ID"];
		$senderID = $row["SenderID"];
		$date = $row["Date"];
		$message = $row["Message"];

		if ($senderID == 2)
		{
			$output .= "<div id='your-chat'>";
		}
		else
		{
			$output .= "<div id='other-chat'>";
		}
		$output .= "
			<div id='chat-header'><div id='chat-date'>$date</div></div>
			<div id='chat-content'><div id='chat-message'>$message</div></div>";
			if ($senderID == 2)
			{
				$output .= "
				<div id='chat-footer'>
					<button id='$id' class='delete' name='delete' type='submit' name='delete'>Delete</button>
					<button id='$id' class='edit' name='edit' type='button'>Edit</button>
				</div>";
			}
		$output .= "</div>";
	}

	echo $output;
?>