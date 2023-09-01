<?php

namespace App\Forms;

use App\Core\Validator;

class Film extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "id" => "film-form",
                "class" => "space-y-6",
                "submit" => "Ajouter",
                "enctype" => "multipart/form-data",
                "submit_class" => "w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800",
            ],
            "inputs" => [
                "title" => [
                    "id" => "film-form-title",
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white",
                    "placeholder" => "Title",
                    "type" => "text",
                    "error" => "Title is required",
                    "required" => true
                ],
                "description" => [
                    "id" => "film-form-description",
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white",
                    "placeholder" => "Description",
                    "type" => "text",
                    "error" => "Description is required",
                    "required" => true
                ],
                "year" => [
                    "id" => "film-form-year",
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white",
                    "placeholder" => "Year",
                    "type" => "number",
                    "error" => "Year is required",
                    "required" => true
                ],
                "length" => [
                    "id" => "film-form-length",
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white",
                    "placeholder" => "Length",
                    "type" => "number",
                    "error" => "Length is required",
                    "required" => true
                ],
                "image" => [
                    "id" => "film-form-image",
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white",
                    "type" => "file",
                    "error" => "Image is required",
                    "required" => false
                ],
                "category" => [
                    "id" => "film-form-category",
                    "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white",
                    "placeholder" => "Category",
                    "type" => "select",
                    "options" => [
                        "Comedy" => "Comedy",
                        "Drama" => "Drama",
                        "Action" => "Action",
                        "Horror" => "Horror",
                        "Thriller" => "Thriller",
                        "Western" => "Western",
                        "Animation" => "Animation",
                        "Documentary" => "Documentary",
                        "Science Fiction" => "Science Fiction",
                        "Fantasy" => "Fantasy",
                        "Crime" => "Crime",
                        "Adventure" => "Adventure",
                        "Mystery" => "Mystery",
                        "Romance" => "Romance",
                        "Family" => "Family",
                        "War" => "War",
                        "Music" => "Music",
                        "History" => "History",
                        "TV Movie" => "TV Movie"
                    ],
                    "error" => "Category is required",
                    "required" => true
                ]
            ]
        ];
        return $this->config;
    }

    public function getFields(): array
    {
        return [
            'title' => $_POST['title'] ?? null,
            'description' => $_POST['description'] ?? null,
            'year' => $_POST['year'] ?? null,
            'length' => $_POST['length'] ?? null,
            'category' => $_POST['category'] ?? null,
            'image' => $_FILES['image']['type'] === "" ? null : $_FILES['image']
        ];
    }

}
