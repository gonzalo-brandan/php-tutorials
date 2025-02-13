<?php

namespace Core;

use PDO;

abstract class Model {
    // Each model (e.g., Post, Comment, User) should define its own table name
    protected static $table;

    /**
    * Retrieve all records from the table.
    * @return array An array of model instances.
    */
    public static function all(): array{
        $db = App::get('database');
        // Fetch all records from the associated table
        return $db->fetchAll("SELECT * FROM " . static::$table, [], static::class);
    }

    /**
     * Find a single record by ID.
     * @param mixed $id The primary key value.
     * @return static|null A model instance or null if not found.
     */
    public static function find(mixed $id): static | null{
        $db = App::get('database');
        // Fetch a single record by ID
        return $db->fetch("SELECT * FROM " . static::$table . " WHERE id = ?", [$id], static::class);
    }

    /**
     * Create a new record in the database.
     * This method should be implemented in child classes.
     * @param array $data Data to insert into the table.
     * @return static A new model instance.
     */
    public static function create(array $data): static{
        $db = App::get('database');
        //1. Get the names of columns inside $data
        $columns = implode(', ', array_keys($data));
        //-> id, title, created_at, content
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        //-> ?, ?, ?, ?
        // 3. Prepare the SQL query
        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";
        // 4. Execute the query with the actual data
        $db->query($sql, array_values($data));

        // 5. Return the newly created object by finding it with the last insert ID
        return static::find($db->lastInsertId());
    }
    //the job of createFromArray() will be converting an array result
    //with the DB record into a model object like Post,Comment or User
    protected static function createFromArray(array $data): static {
        $model = new static(); // Create a new instance of the child model

        foreach($data as $key => $value){
            //example of a defined property:
            //class Post {
            //public $id;
            //}
            // Check if the property exists before assigning it
            if(property_exists($model, $key)){
                $model->$key = $value;
            }
        }

        return $model;
    }
}