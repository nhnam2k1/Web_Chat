<?php 
    class Chat
    {
        private int $id;
        private string $date;
        private string $message;
        private int $senderID;
        private int $roomID;

        public function __construct($id, $date, $message, $senderID, $roomID)
        {
            $this->id = $id;
            $this->date = $date;
            $this->message = $message;
            $this->senderID = $senderID;
            $this->roomID = $roomID;
        }

        public function GetID()
        {
            return $this->id;
        }

        public function GetDate()
        {
            return $this->date;
        }

        public function GetMessage()
        {
            return $this->message;
        }

        public function GetSenderID()
        {
            return $this->senderID;
        }

        public function GetRoomID()
        {
            return $this->roomID;
        }
    }
?>