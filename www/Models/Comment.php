<?php

namespace App\Models;

use App\Core\SQL;

class Comment extends SQL
{
    private int $id = 0;
    protected int $film_id;
    protected int $user_id;
    protected string $content;
    protected string $date_inserted;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFilmId(): int
    {
        return $this->film_id;
    }

    public function setFilmId(int $film_id): void
    {
        $this->film_id = $film_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getDateInserted(): string
    {
        return $this->date_inserted;
    }

    public function setDateInserted(\DateTime $date_inserted): void
    {
        $this->date_inserted = $date_inserted->format('Y-m-d H:i:s');
    }

    public function getCommentsForFilm($id)
    {
        $queryPrepared = self::getInstance()->prepare("SELECT * FROM " . $this->table ." WHERE film_id = :filmId");
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, \App\Models\Comment::class);
        $queryPrepared->execute([':filmId' => $id]);
        return $queryPrepared->fetchAll();
    }

    public function getUserInfo()
    {
        $queryPrepared = self::getInstance()->prepare("SELECT firstname, lastname FROM esgi_user WHERE id = " . $this->user_id);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, \App\Models\User::class);
        $queryPrepared->execute();
        return $queryPrepared->fetch();
    }
}
