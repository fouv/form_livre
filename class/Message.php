<?php
class Message {
      private $user;
      private $message;
      private $date;

      const LIMIT_USER = 3;
      const LIMIT_MESSAGE =10;

      public function __construct(string $user, string $message, ?DateTime $date=null)
      {
            $this->user = $user;
            $this->message = $message;
            $this->date = $date ?:new DateTime;

      }
      public function isValid() : bool
      {
            return empty($this->getErrors());
      }

      public function getErrors()
      {
            $errors =[];
            if(strlen($this->user)< self::LIMIT_USER)
            {
                  $errors['user'] = 'Votre pseudo est incomplet';
            }
            if(strlen($this->message)<= self::LIMIT_MESSAGE)
            {
                  $errors['message'] = 'Votre message doit comporter 10 caractˆores au moins';

            return $errors;
            }
      }
      public function toJSON() : string {
            return json_encode([
                  'user' => $this->user,
                  'message'=>$this->message,
                  'date' =>$this->date->getTimestamp()

            ]);
      }
}
