<?php
/**
 * Sample plugin for the plugin system.
 *
 * @author:  Martin Lantzsch <martin@linux-doku.de>
 * @website: http://linux-doku.de
 * @licence: GPL
 * @version: 0.1
 */

class LocalPlugin
{
    public function execute($file)
    {
        include 'config.php';
        $path = 'pictures/'.getTitleFromName($_REQUEST['filename']).'/'; // get the folder path

        if (!file_put_contents($path.$_REQUEST['filename'], $file)) { // if the directory does not exsit create it and try again
            mkdir($path);
            file_put_contents($path.$_REQUEST['filename'], $file);
        }
        return "yee";
    }
}
