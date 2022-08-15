<?php


//SETTINGS
\inc\artemy\v1\auth\Auth::getUser()->register($_POST["user_email"], $_POST["user_password"]);