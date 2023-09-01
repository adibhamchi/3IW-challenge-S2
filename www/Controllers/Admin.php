<?php


namespace App\Controllers;
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
use App\Core\View;
use App\Models\User;
use App\Models\Film;
use App\Forms\Film as FilmForm;

class Admin
{
    public function dashboard(): void
    {
        if (isset($_SESSION['user_id']) && (new User)->getOneWhere(['id' => $_SESSION['user_id']])) {
            $user = User::populate($_SESSION['user_id']);
            if ($user->getStatus() == 2) {
                $users = $user->getAll();
                $allfilms = (new Film)->getAll();
                $view = new View("Admin/dashboard", "back");
                $view->assign("name", $user->getFirstname());
                $view->assign("users", $users);
                $view->assign("films", $allfilms);

                $view->assign("pageTitle", "Dashboard - Movie Reviews");
                $view->assign("pageDescription", "Page d'administration du site.");

                $movieForm = new FilmForm();
                $view->assign("formErrors", $movieForm->errors);
                $view->assign("movieForm", $movieForm->getConfig());
                $options = [
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
                ];
                $view->assign("options", $options);

                if ($movieForm->isSubmited() && $movieForm->isValid()){
                    $formData = $movieForm->getFields();
                    $film = new Film();
                    $film->setTitle($formData['title']);
                    $film->setDescription($formData['description']);
                    $film->setYear($formData['year']);
                    $film->setLength($formData['length']);
                    $film->setCategory($formData['category']);
                    //$film->setImage($formData['image']);

                    if (isset($formData['image']) && $formData['image']['error'] == 0){
                        $originalFileName = $formData['image']['name'];
                        $tempLocation = $formData['image']['tmp_name'];

                        // Créez un nom de fichier unique
                        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                        $uniqueFileName = time() . '_' . rand(0, 99999) . '.' . $fileExtension;

                        // Déplacez le fichier vers le dossier souhaité
                        // Déplacez le fichier vers le dossier souhaité
                        $destination = $_SERVER['DOCUMENT_ROOT'] . '/public/assets/img/films/' . $uniqueFileName;
                        if(move_uploaded_file($tempLocation, $destination)){
                            echo "The file ". $uniqueFileName. " has been uploaded.";
                            // Enregistrez le nom du fichier unique dans la base de données
                            $film->setImage($uniqueFileName);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

//                    var_dump($film);
                    $film->save();
                    header('Location: /dashboard');
                    exit();
                }
            } else {
                header('Location: /404');
                exit();
            }
        } else {
            header('Location: /404');
            exit();
        }
    }


}
