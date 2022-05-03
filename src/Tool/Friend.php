<?php

namespace App\Tool;

use App\Repository\MessageRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Friend
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function liste(MessageRepository $messageRepository)
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        $message2 = $messageRepository->allConv($currentId);
        $element1 = [];
        foreach ($message2 as $cle =>$value) {
            $prenom = (string)$value->getSend()->getPrenom();
            $nom = (string)$value->getSend()->getNom();
            $string = $prenom . ' ' . $nom;
            $element1[] = $string;
        }
        $nombre1 = array_count_values($element1);
        $final1 = [];
        foreach ($nombre1 as $cle => $value) {
            $final1[] = $cle;
        }
        return $final1;
    }
}
