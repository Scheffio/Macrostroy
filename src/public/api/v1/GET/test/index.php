<?php
setcookie('lera', 'yes');
\inc\artemy\v1\json_output\JsonOutput::success($_SERVER['HTTP_REFERER']);