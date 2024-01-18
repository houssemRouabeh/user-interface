<?php
class Blog
{
    private $titre;
    private $contenu;
    private $datePublication;

    public function __construct($titre, $contenu, $datePublication)
    {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->datePublication = $datePublication;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function getContenue()
    {
        return $this->contenu;
    }
    public function getDatePublication()
    {
        return $this->datePublication;
    }
}
