<?php
	include_once("Model/DatabaseConfig.php");
	include_once("Class/chat.php");

    class ChatModel extends DatabaseConfig
    {
        public function GetFirst()
        {
            try
            {
                $sql = "SELECT ID FROM rooms LIMIT 1";
                $stmt = $this->GetConnection()->prepare($sql);
                $stmt->execute();
                $output = $stmt->fetch();
				
                return $output;
            }
            catch(PDOEXCEPTION $e)
            {
                print_r("Something went wrong: " . $e->getMessage());
            }
		}
		
		public function Get($roomID)
		{
			try
			{
				$sql = "SELECT * FROM chat WHERE (RoomID = :RoomID);";

				$stmt = $this->GetConnection()->prepare($sql);
				$stmt->bindParam(':RoomID', $roomID);
				$stmt->execute();
				$result = $stmt->fetchAll();

				return $result;
			}
			catch(PDOException $e)
			{
				print_r("Something went wrong: " . $e->getMessage());
			}
		}

        public function Add(Chat $chat)
		{
			echo $chat->GetDate();
			try
			{
				$sql = "INSERT INTO chat (SenderID, Date, Message, RoomID) VALUES (:senderId, :date, :message, :roomID);";

                $stmt = $this->GetConnection()->prepare($sql);
				$stmt->bindParam(':senderId', $chat->GetSenderID());
				$stmt->bindParam(':date', $chat->GetDate());
				$stmt->bindParam(':message', $chat->GetMessage());
				$stmt->bindParam(':roomID', $chat->GetRoomID());

				$stmt->execute();
			}
			catch(PDOEXCEPTION $e)
			{
				print_r("Something went wrong: " . $e->getMessage());
			}
        }
        
        public function Edit(Chat $chat)
		{
			try
			{
				$sql = "UPDATE chat SET ";
				$sql .= "Date = :date, ";
				$sql .= "Message = :message ";
				$sql .= "WHERE ID = :id;";

				$stmt = $this->GetConnection()->prepare($sql);
		
				$stmt->bindParam(':date', $chat->GetDate());
				$stmt->bindParam(':message', $chat->GetMessage());
				$stmt->bindParam(':id', $chat->GetID());
				$stmt->execute();
			}
			catch(PDOEXCEPTION $e)
			{
				print_r("Something went wrong: " . $e->getMessage());
			}
        }
        
        public function Delete($id)
		{
			try
			{
				$sql = "DELETE FROM chat WHERE ID = :id";
				$stmt = $this->GetConnection()->prepare($sql);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
			}
			catch(PDOEXCEPTION $e)
			{
				print_r("Something went wrong: " . $e->getMessage());
			}
		}

		public function GetRooms ()
		{
			$sql = "SELECT * FROM rooms";
            $stmt = $this->GetConnection()->prepare($sql);
            $stmt->execute();
            $output = $stmt->fetchAll();
    
            return $output;
		}
    }
?>