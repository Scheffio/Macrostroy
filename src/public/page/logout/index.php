<?php

use inc\artemy\v1\auth\Auth;

Auth::getUser()->logOut();
header("Location: /auth");