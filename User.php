<?php
class User
{
    private $userName;
    private $password;
    private $created_at;

    public function __construct($userName, $password, $created_at)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->created_at = $created_at;
    }
    public function getUserName()
    {
        return $this->userName;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
