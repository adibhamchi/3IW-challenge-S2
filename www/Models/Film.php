<?php

namespace App\Models;

use App\Core\SQL;

class Film extends SQL
{
    protected Int $id;
    protected String $title;
    protected String $description;
    protected Int $year;
    protected Int $length;
    protected String $category;
    protected ?String $date_inserted;
    protected ?String $date_updated;
    protected ?String $image;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return String|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param String|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }


    /**
     * Get the ID of the film.
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    /**
     * Set the ID of the film.
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the title of the film.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the title of the film.
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get the description of the film.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the description of the film.
     *
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get the year of the film.
     *
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * Set the year of the film.
     *
     * @param int|null $year
     */
    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    /**
     * Get the length of the film.
     *
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * Set the length of the film.
     *
     * @param int|null $length
     */
    public function setLength(?int $length): void
    {
        $this->length = $length;
    }

    /**
     * Get the category of the film.
     *
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * Set the category of the film.
     *
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }
}
