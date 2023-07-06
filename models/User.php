<?php
class User
{
               private $id;
               private $name;
               private $lastName;
               private $email;
               private $password;
               private $roleId;
               private $active;
               private $image;
               private $db;
               #-----------------
               public function __construct()
               {
                              $this->db = ConnectionDb::connect();
               }
               public function createUser()
               {
                              try {
                                             $sql = "INSERT INTO users(name, lastname, email, password) VALUES(:name, :lastname, :email, :password)";
                                             $stmt = $this->db->prepare($sql);

                                             $name = $this->getName();
                                             $lastname = $this->getLastName();
                                             $email = $this->getEmail();
                                             $password = $this->getPassword();

                                             $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                                             $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                                             $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                                             $stmt->bindParam(":password", $password, PDO::PARAM_STR);

                                             $sql_check = "SELECT COUNT(*) FROM users WHERE email = :email";
                                             $stmt_check = $this->db->prepare($sql_check);
                                             $stmt_check->bindParam(":email", $email, PDO::PARAM_STR);
                                             $stmt_check->execute();
                                             $count = $stmt_check->fetchColumn();

                                             if ($count > 0) {
                                                            throw new Exception("El correo electrónico ya está registrado");
                                             }
                                             $stmt->execute();
                                             return  true;
                              } catch (PDOException $e) {
                                             return   $e->getMessage();
                              }
               }

               public function loginUsers()
               {
                              try {
                                             $sql = "SELECT users.id,users.name, users.email, users.password, users.active, roles.name as role FROM users INNER JOIN roles ON users.roleId=roles.id WHERE users.email=:email ";

                                             $email = $this->getEmail();
                                             $password = $this->password;

                                             $result = $this->db->prepare($sql);
                                             $result->bindParam(":email", $email, PDO::PARAM_STR);
                                             $result->execute();
                                             $usuario = $result->fetch();

                                             $paswordHash = is_array($usuario) ? $usuario["password"] : "nada";
                                             $verify = password_verify($password,   $paswordHash);

                                             if (is_array($usuario) && $verify && $usuario["active"]) {
                                                            return  ["id" => $usuario["id"], "email" => $usuario["email"], "name" => $usuario["name"], "role" => $usuario["role"]];
                                             } elseif (is_array($usuario) && $verify && !$usuario["active"]) {
                                                            throw new PDOException("El usuario no esta activo");
                                             } else {
                                                            throw new PDOException("Error, datos no coinciden ");
                                             }
                              } catch (PDOException $e) {
                                             return  $e->getMessage();
                              }
               }

               public function readAllUsers()
               {
                              try {
                                             $sql = "SELECT users.id, users.name, users.lastname, users.active, users.image, roles.name as role FROM users INNER JOIN roles ON users.roleId=roles.id  ";

                                             $result = $this->db->prepare($sql);
                                             $result->execute();
                                             $usuarios = $result->fetchAll();

                                             return   is_array($usuarios) ? $usuarios :  throw new PDOException("No hay usuarios");
                              } catch (PDOException $e) {
                                             return  $e->getMessage();
                              }
               }
               public function readUserById()
               {
                              try {
                                             $sql = "SELECT users.id, users.name, users.lastname, users.email, users.active, users.image, roles.name as role FROM users INNER JOIN roles ON users.roleId=roles.id WHERE users.id=:id ";

                                             $id = $this->getId();

                                             $result = $this->db->prepare($sql);

                                             $result->bindParam(":id", $id, PDO::PARAM_STR);
                                             $result->execute();
                                             $usuario = $result->fetch();

                                             return   is_array($usuario) ? $usuario :  throw new PDOException("No hay usuario");
                              } catch (PDOException $e) {
                                             return  $e->getMessage();
                              }
               }
               public function updateUser()
               {
                              try {
                                             $sql = "UPDATE users SET name=:name, lastname=:lastname, email=:email, roleId=:roleId, active=:active, image=:image WHERE id=:id";

                                             $result = $this->db->prepare($sql);

                                             $id = $this->getId();
                                             $name = $this->getName();
                                             $lastname = $this->getLastName();
                                             $email = $this->getEmail();
                                             $roleId = $this->getRoleId();
                                             $active = $this->getActive();
                                             $image = $this->getImage();


                                             $result->bindParam(":id", $id, PDO::PARAM_INT);
                                             $result->bindParam(":name", $name, PDO::PARAM_STR);
                                             $result->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                                             $result->bindParam(":email", $email, PDO::PARAM_STR);
                                             $result->bindParam(":roleId", $roleId, PDO::PARAM_INT);
                                             $result->bindParam(":active", $active, PDO::PARAM_INT);
                                             $result->bindParam(":image", $image, PDO::PARAM_STR);

                                             $result->execute();
                                             return  $result ? true : throw new PDOException(false);
                              } catch (PDOException $e) {
                                             return  $e->getMessage();
                              }
               }
               public function deleteUser()
               {
                              try {
                                             $sql = "DELETE FROM users WHERE id=:id AND active=0 ";
                                             $id = $this->getId();
                                             $result = $this->db->prepare($sql);
                                             $result->bindParam(":id", $id, PDO::PARAM_INT);

                                             $result->execute();
                                             return $result->rowCount() == 1 ? true : throw new PDOException("No se puede eliminar este usuario porque esta activo");
                              } catch (PDOException $e) {
                                             return  $e->getMessage();
                              }
               }
               #-----------------
               public function getId()
               {
                              return $this->id;
               }

               public function setId($value)
               {
                              $this->id = $value;
               }

               public function getName()
               {
                              return $this->name;
               }

               public function setName(string $value)
               {
                              $this->name = $value;
               }

               public function getLastName()
               {
                              return $this->lastName;
               }

               public function setLastName(string $value)
               {
                              $this->lastName = $value;
               }

               public function getEmail()
               {
                              return $this->email;
               }

               public function setEmail(string $value)
               {
                              $this->email = $value;
               }

               public function getPassword()
               {
                              return  password_hash($this->password, PASSWORD_BCRYPT);
                              // return  password_hash( $this->db->quote($this->password), PASSWORD_BCRYPT);

               }

               public function setPassword(string $value)
               {
                              $this->password = $value;
               }

               public function getRoleId()
               {
                              return $this->roleId;
               }

               public function setRoleId($value)
               {
                              $this->roleId = $value;
               }

               public function getImage()
               {
                              return $this->image;
               }

               public function setImage($value)
               {
                              $this->image = $value;
               }


               public function getActive()
               {
                              return $this->active;
               }

               public function setActive($value)
               {
                              $this->active = $value;
               }
}
