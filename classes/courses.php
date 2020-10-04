<?php

//This course class is handling all actions with the database such as
// select one or many, insert , update or delete a course
//The actual connection is passed into the c-tor
class Courses
{
    private $db;

    //C-tor where we use an already existing connection to the database
    public function __construct($db)
    { 
        $this->db = $db->getConnection();
    }

    //Get one tuple from database table courses based on id
    //We return an assocciative array
    public function getOne(int $id) : array
    {
        $result = $this->db->query("select * from courses where id = '$id'");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Get all tuple from database table courses 
    //We return an assocciative array
    public function getAll() : array
    {
        $result = $this->db->query("select * from courses");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Delete one from database based on id
    //Return true if successful added else false
    public function deleteCourse(int $id): bool
    {
        return $this->db->query("delete from courses where ID= $id");
    }

    //Add a new course
    //Return true if successful added else false
    public function addCourse(string $code,string $name,string $progression,string $plan) : bool
    {
        return $this->db->query("INSERT INTO courses(code, name, progression, plan) VALUES ('$code','$name', '$progression', '$plan')");
    }

    //Update a course based on id
    //Return true if successful added else false
    public function updateCourse(int $id, string $code, string $name,string $progression,string $plan) : bool
    {
        //$sql =  "update course set code='" . $code . "', name='" . $name . "',progression='" . $progression . "',plan='" . $plan . "' where ID = $id";
        //echo $sql;

        return $this->db->query("update courses set code='" . $code . "', name='" . $name . "',progression='" . $progression . "',plan='" . $plan . "' where ID = $id");
    }
}
