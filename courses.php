<?php

/*
This file represnts a REST- API and we can handle the following 4 methods
GET, POST,PUT and DELETE.
I have use Advanced Rest client to test the REST-API
Description GET method
   When we use GET we make a select from the database
   All: http://localhost:8080/DT173_Webbutveckling_3/moment5/courses
   One: http://localhost:8080/DT173_Webbutveckling_3/moment5/courses?id=x
   where x is the id I want to get

Description POST method
   When we use POST we make an insert into the database
   http://localhost:8080/DT173_Webbutveckling_3/moment5/courses
   
Description PUT method
   When we use PUT we update the database
   http://localhost:8080/DT173_Webbutveckling_3/moment5/courses?id=x
   where x is the id I want to update

Description DELETET method
   When we use DETETE we delete from the database
   http://localhost:8080/DT173_Webbutveckling_3/moment5/courses?id=x
   where x is the id I want to delete
*/

//Required files to be used
require 'classes/courses.php';
require 'classes/database.php';

//Define that content is json
header('Content-Type: application/json');
//Define that all domain are valid
header('Access-Control-Allow-Origin: *');
//Define valid methods
header('Access-Control-Allow-Methods:GET, PUT, POST, DELETE');
//Define valid headers
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

//Check if id exist in url
if (isset($_GET['id']))
{
   $id = $_GET['id'];
}

//Connect to database in C-tor
$db = new Database(); 
$courses = new Courses($db);

 switch($_SERVER['REQUEST_METHOD']) //Get current method
 {
    case 'GET' :
      //Get one or all courses depending on id
      $result = isset($id) ? $courses->getOne($id) : $courses->getAll();

      //Check if the result contains any rows
      if (count($result) > 0) {
       http_response_code(200); //ok
      }
      else {      
        http_response_code(404); //Empty collection
        $result = array("message" => "No courses found");
      }
    break; //end case GET

     case 'POST':
      //Get data from body and convert json to php variable
      $data =  json_decode(file_get_contents("php://input"));

      //Add a new Course and pass all argument
      if ($courses->addCourse($data->code,$data->name,$data->progression,$data->plan)){
         http_response_code(201);
         $result = array("message" => "Courses added");
      }
      else {
         http_response_code(501);
         $result = array("message" => "Courses added failed");     
      }
     break; //end case POST

     case 'PUT' :
      if (!isset($id))  //id must be present
      {
         http_response_code(510);
         $result = array("message" => "No id present");     
      }
      else {
          //Get data from body and convert json to php variable
         $data =  json_decode(file_get_contents("php://input"));

         //Update a specific course and pass in all arguments
         if ($courses->updateCourse($id, $data->code, $data->name, $data->progression, $data->plan)){
            http_response_code(200);
            $result = array("message" => "Coursed updated");  
         }
         else {
            http_response_code(503);
            $result = array("message" => "Course Update failed"); 
         } 
      }
     break; //end case PUT

     case 'DELETE' :
      if (!isset($id)) // id must be present 
      {
         http_response_code(510); //return error
         $result = array("message" => "No id is present");     
      }
      else 
      {
         if ($courses->deleteCourse($id)){
            http_response_code(200); //return success
            $result = array("message" => "Coursed deleted"); 
         }
         else {
            http_response_code(503); //return error
            $result = array("message" => "Course delete failed"); 
         }
      }
   break; //end case DELETE
}

echo json_encode($result); //Return as json
$db->close(); //close connection to db






