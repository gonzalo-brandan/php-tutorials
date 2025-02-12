<?php

namespace Core;

abstract class Model {
    protected static $table;

    public static function all(): array{
        $db = App::get('database');
        $results = $db->query("SELECT * FROM " . static::$table)
        ->fetchAll(PDO::FETCH_ASSOC);
        return array_map([static::class, 'createFromArray'], $results);
    }
    public static function find(mixed $id): static | null{
        $db = App::get('database');
        $results = $db->query("SELECT * FROM " . static::$table . " WHERE id = ?", [$id])
        ->fetch(PDO::FETCH_ASSOC);
        return $result ? static::createFromArray($result) : null;
    }
    public static function create(array $data): static{
        
    }
    //the job of createFromArray() will be converting an array result
    //with the DB record into a model object like Post,Comment or User
    protected static function createFromArray(array $data): static {
        $model = new static();

        foreach($data as $key => $value){
            //example of a defined property:
            //class Post {
            //public $id;
            //}
            if(property_exists($model, $key)){
                $model->$key = $value;
            }
        }

        return $model;
    }
}