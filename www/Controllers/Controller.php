<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class Controller
{
    protected function assignUserAndAdminStatus(View $view): void
    {
        if (isset($_SESSION["user_id"])) {
            $user = new User();
//            var_dump($user->getOneWhere(["id" => $_SESSION["user_id"]]));
            if ($user = $user->getOneWhere(["id" => $_SESSION["user_id"]])) {
//                var_dump($user);
                if ($user->getStatus() === 2) {
                    $view->assign("admin", true);
                    $view->assign("user", true);
                } else if ($user->getStatus() === 1) {
                    $view->assign("admin", false);
                    $view->assign("user", true);
                }
            } else {
                $view->assign("admin", false);
                $view->assign("user", false);
            }
        }
    }
}
