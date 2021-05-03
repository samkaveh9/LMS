<?php

return [

    "MediaTypes" => [

        "image" => [

            "extensions" => [
                "png","jpeg","jpg","svg","webp"
            ],

            "handler" => \Samkaveh\Media\Services\ImageUploadService::class
        ],

        "video" => [

            "extensions" => [
                "mp4","avi","mkv"
            ],

            "handler" => \Samkaveh\Media\Services\VideoUploadService::class
        ],

        "compressed" => [

            "extensions" => [
                "zip","rar","tar"
            ],

            "handler" => \Samkaveh\Media\Services\VideoUploadService::class
        ]
    ]

];
