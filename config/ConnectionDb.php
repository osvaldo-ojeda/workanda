<?php
const SERVERNAME = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "workandaDb";

class ConnectionDb
{
               private function __construct()
               {
               }
               public static function connect()
               {

                              try {
                                             $conn = new PDO(
                                                            "mysql:host=" . SERVERNAME . ";dbname=" . DBNAME,
                                                            USERNAME,
                                                            PASSWORD
                                             );
                                             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                             // echo "db connection ok";
                                             return $conn;
                              } catch (PDOException $e) {
                                             echo "Connection failed: " . $e->getMessage();
                              }
               }
}
