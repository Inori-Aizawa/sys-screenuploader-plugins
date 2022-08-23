<?php

function getTitleFromName($filename)
{
    $id = (explode('.', explode('-', $filename)[1])[0]);
    $json = json_decode(file_get_contents('./game_id.json'), true);
    if (array_key_exists($id, $json)) {
        return $json[$id];
    } else {
        LogToFile('Game does not exsit in database, you can add it yourself with this id: '.$id);

        return $id;
    }
}