<?php

namespace vladayson\zipper;

use ZipArchive;

/**
 * Class Zipper
 * @package vladayson\zipper
 */
class Zipper
{
    public static function create($files, $destination, $password = null)
    {
        $zip = new ZipArchive();
        $zip->open($destination, ZipArchive::CREATE);
        foreach ($files as $file) {
            $folder = dirname($file);
            $basename = basename($file);
            chdir($folder);
            $zip->addFromString($basename, file_get_contents($file));
            if ($password) {
                $zip->setEncryptionName($basename, ZipArchive::EM_AES_256, $password);
            }
        }
        $zip->close();
    }
}