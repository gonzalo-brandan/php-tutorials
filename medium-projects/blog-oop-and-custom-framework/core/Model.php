<?php

namespace Core;

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
        $results = $db->query("SELECT * FROM " . static::$table)
        ->fetchAll(PDO::FETCH_ASSOC);
        // Convert each record array into a model instance
        return array_map([static::class, 'createFromArray'], $results);
    }

    /**
     * Find a single record by ID.
     * @param mixed $id The primary key value.
     * @return static|null A model instance or null if not found.
     */
    public static function find(mixed $id): static | null{
        $db = App::get('database');
        // Fetch a single record by ID
        $result = $db->query("SELECT * FROM " . static::$table . " WHERE id = ?", [$id])
        ->fetch(PDO::FETCH_ASSOC);
        // Convert the record into a model instance or return null if not found
        return $result ? static::createFromArray($result) : null;
    }

    /**
     * Create a new record in the database.
     * This method should be implemented in child classes.
     * @param array $data Data to insert into the table.
     * @return static A new model instance.
     */
    public static function create(array $data): static{
        
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