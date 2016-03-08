<?php

   namespace BusinessLogic;

   use Database\Model\Users;
   use Database\Model\UsersQuery;

   class MainPage
   {
      public function getContent()
      {
         /** @var Users $user */
         $user = UsersQuery::create()
            ->findOne();

         return $user->getName();
      }
   }
