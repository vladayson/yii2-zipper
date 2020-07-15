<?php


namespace vladayson\zipper;


use ZipArchive;

class Zipper
{
    public static function create($files, $destination, $password = null)
    {
        $zip = new ZipArchive();
        $zip->open($destination, ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file);
        }
        if ($password) {
            $zip->setPassword($password);
        }

        $zip->close();
    }
}