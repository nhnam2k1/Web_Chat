<?php
    include_once("Class/Chat.php");
    include_once("Model/ChatModel.php");

    class ChatController
    {
        private ChatModel $chatModel;

        public function __construct()
        {  
            $this->chatModel = new ChatModel();
        }
            
        public function GetFirst()
        {
            return $this->chatModel->GetFirst();
        }

        public function Get($roomID)
        {
            return $this->chatModel->Get($roomID);
        }

        public function Add(Chat $chat)
		{
            $this->chatModel->Add($chat);
        }
        
        public function Edit(Chat $chat)
        {
            $this->chatModel->Edit($chat);
        }

        public function Delete(int $id)
		{
			$this->chatModel->Delete($id);
        }

        public function GetRooms()
        {
            return $this->chatModel->GetRooms();
        }
    }
?>