<?php
require "models/User.php";

class UserController
{
               public function register()
               {
                              require_once "views/user/forms/register.php";
               }
               public function createuser()
               {
                              try {
                                             $name = isset($_POST["name"]) && !empty($_POST["name"]) ? $_POST["name"] : false;
                                             $lastname = isset($_POST["lastname"]) && !empty($_POST["lastname"]) ? $_POST["lastname"] : false;
                                             $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : false;
                                             $password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : false;

                                             if ($name && $lastname && $email && $password) {
                                                            $user = new User();
                                                            $user->setName($name);
                                                            $user->setLastName($lastname);
                                                            $user->setEmail($email);
                                                            $user->setPassword($password);
                                                            $user = $user->createUser();

                                                            if ($user == 1) {
                                                                           require "views/user/createUser.php";
                                                            } else {
                                                                           throw new Exception($user);
                                                            }
                                             } else {
                                                            throw new Exception("Todos los campos son requeridos");
                                             }
                              } catch (Exception $e) {
                                             $messagError = $e->getMessage();
                                             $error = new  ErrorController();
                                             $error->index($messagError);
                                             header("refresh:3, url=" . base_url . "User/register/");
                              }
               }

               public function login()
               {
                              require_once "views/user/forms/login.php";
               }
               public function loged()
               {
                              try {
                                             $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : false;
                                             $password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : false;

                                             if ($email && $password) {
                                                            $user = new User();
                                                            $user->setEmail($email);
                                                            $user->setPassword($password);

                                                            $user = $user->loginUsers();

                                                            if (is_array($user)) {
                                                                           $_SESSION["user"] = $user;
                                                                           require "views/user/loged.php";
                                                            } else {
                                                                           throw new Exception($user);
                                                            }
                                             } else {
                                                            throw new Exception("Todos los campos son requeridos");
                                             }
                              } catch (Exception $e) {
                                             $messagError = $e->getMessage();
                                             $error = new  ErrorController();
                                             $error->index($messagError);
                                             header("refresh:3, url=" . base_url . "User/login/");
                              }
               }
               public function logout()
               {
                              unset($_SESSION["user"]);
                              require "views/user/logout.php";
               }

               public function readAllUsers()
               {
                              $users = new User();
                              $getUsuarios = $users->readAllUsers();
                              require "views/user/readAllUsers.php";
               }
               public function readuser()
               {
                              try {
                                             $id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : false;

                                             if ($id) {
                                                            $user = new User();
                                                            $user->setId($id);
                                                            $data = $user->readUserById();
                                                            if (is_array($data)) {
                                                                           require "views/user/readUserById.php";
                                                            } else {
                                                                           throw new Exception("No se pudo encontroar al usuario ");
                                                            }
                                             } else {
                                                            throw new Exception("No se pudo encontroar al usuario ");
                                             }
                              } catch (Exception $e) {
                                             $messagError = $e->getMessage();
                                             $error = new  ErrorController();
                                             $error->index($messagError);
                                             header("refresh:3, url=" . base_url . "User/readAllUsers/");
                              }
               }
               public function updateuserview()
               {
                              try {
                                             $id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : false;
                                             if ($id) {
                                                            $user = new User();
                                                            $user->setId($id);
                                                            $data = $user->readUserById();
                                                            if (is_array($data)) {
                                                                           require "views/user/forms/formUpdateUser.php";
                                                            } else {
                                                                           throw new Exception("No se pudo encontroar al usuario ");
                                                            }
                                             } else {
                                                            throw new Exception("No se pudo encontroar al usuario ");
                                             }
                              } catch (Exception $e) {
                                             $messagError = $e->getMessage();
                                             $error = new  ErrorController();
                                             $error->index($messagError);
                                             header("refresh:3, url=" . base_url . "User/readAllUsers/");
                              }
               }
               public function updateuser()
               {
                              try {

                                             $name = isset($_POST["name"]) && !empty($_POST["name"]) ? $_POST["name"] : false;
                                             $lastname = isset($_POST["lastname"]) && !empty($_POST["lastname"]) ? $_POST["lastname"] : false;
                                             $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : false;
                                             $image = isset($_POST["image"]) && !empty($_POST["image"]) ? $_POST["image"] : false;
                                             $roleId = isset($_POST["roleId"]) && !empty($_POST["roleId"]) ? $_POST["roleId"] : false;
                                             $active = isset($_POST["active"]) && !empty($_POST["active"]) ? $_POST["active"] : false;
                                             $id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : false;

                                             if ($name && $lastname && $email && $image && $roleId) {

                                                            $user = new User();
                                                            $user->setId($id);
                                                            $user->setName($name);
                                                            $user->setLastName($lastname);
                                                            $user->setEmail($email);
                                                            $user->setImage($image);
                                                            $user->setRoleId($roleId);
                                                            $user->setActive($active);

                                                            $user = $user->updateUser();

                                                            if ($user) {
                                                                           require "views/user/updateUser.php";
                                                                           header("refresh:3, url=" . base_url . "User/readuser/" . $id);
                                                            } else {
                                                                           throw new Exception("No se pudo modificar el usuario ");
                                                            }
                                             } else {
                                                            throw new Exception("Todos los campos son requeridos");
                                             }
                              } catch (Exception $e) {
                                             $messagError = $e->getMessage();
                                             $error = new  ErrorController();
                                             $error->index($messagError);
                                             header("refresh:3, url=" . base_url . "User/readAllUsers/");
                              }
               }
               public function deleteuser()
               {
                              try {
                                             $id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : false;
                                             $user = new User();
                                             $user->setId($id);
                                             $userDel = $user->deleteUser();

                                           
                                             if ($id) {
                                                            if ($userDel==1) {
                                                                           require "views/user/deleteUser.php";
                                                                           header("refresh:3, url=" . base_url . "User/readallusers/");
                                                            } else {
                                                                           throw new Exception($userDel);
                                                            }
                                             } else {
                                                            throw new Exception("No se pudo encontroar al usuario ");
                                             }
                              } catch (Exception $e) {
                                             $messagError = $e->getMessage();
                                             $error = new  ErrorController();
                                             $error->index($messagError);
                                             header("refresh:3, url=" . base_url . "User/readAllUsers/");
                              
                              }
               }
};
