<?php

class AutoAddPlugin
{
    public function PreSaving($file)
    {
        $id = (explode('.', explode('-', $_REQUEST['filename'])[1])[0]);
        $json = json_decode(file_get_contents('./game_id.json'), true);
        if (!array_key_exists($id, $json))
            $json[''.$id] = 'unknown-'.$id;
            file_put_contents('game_id.json', json_encode($json));
    }
}

