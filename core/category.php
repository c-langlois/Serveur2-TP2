<?php
class Category
{
    // This represents my model which is the mapping of my database

    //db stuff 
    private $conn;
    private $table = 'categories';

    //post properties 
    public $id;
    public $name;
    public $create_at;

    //contructor with db connection 
    public function __construct($db)
    {
        $this->conn = $db;
    }


    //getting posts from our database 
    public function read()
    {
        //create query
        $query = 'SELECT
        *
        FROM 
        ' . $this->table . '
        ORDER BY creat_at ASC';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();
        return $stmt;
    }
}
