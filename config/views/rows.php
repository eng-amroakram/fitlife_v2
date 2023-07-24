<?php


return [
    "equipment-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "muscles-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "exercises-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "video_table" => 'video',
        "title" => 'property',
        "muscle_names" => 'selects-table',
        "equipment_names" => 'selects-table',
        "level_name" => 'property',
        "place" => 'dropdown',
        "type_name" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "challenges-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        "description" => 'property',
        "exercise_names" => 'selects-table',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "recipes-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        // "description" => 'property',
        "food_exchange_names" => 'selects-table',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "food-types-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "meal-types-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "meals-service" => [
        "id" => 'property',
        "meal_type_name" => 'property',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "food-exchanges-service" => [
        "id" => 'property',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "measurement-units-service" => [
        "id" => 'property',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "tags-service" => [
        "id" => 'property',
        "title" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "tips-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        "description" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "posts-service" => [
        "id" => 'property',
        "tag_name" => 'property',
        "image_table" => 'image',
        "title" => 'property',
        "description" => 'property',
        "type_name" => 'property',
        "status" => 'status',
        "featured" => 'badge',
        "actions" => ["delete", "edit"],
    ],

    "meal-plans-service" => [
        "id" => 'property',
        "goal_name" => 'property',
        "user_name" => 'property',
        "title" => 'property',
        "meals_names" => 'selects-table',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "users-service" => [
        "id" => 'property',
        "image_table" => 'image',
        "name" => 'property',
        "email" => 'property',
        "phone" => 'property',
        "type" => 'badge',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "goals-service" => [
        "id" => 'property',
        "title" => 'property',
        "type_name" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ]


];
