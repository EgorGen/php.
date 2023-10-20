<?php 
require_once 'User.php';

interface UserPersistInterface 
{
    public function save(User $user): void;

    public function get(string $login): ?User;
}