<?php
class ErrorController
{
               public function index($mesageError = 404)
               {
                              $mesageError = $mesageError;
                              include "views/error/error.php";
               }
}
