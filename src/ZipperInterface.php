<?php

namespace vladayson\zipper;

/**
 * Interface for victor78/yii2-zipper compliant archiveMaker 
 */
interface ZipperInterface
{
    /**
     * @param string $path
     * @param array|null $files
     * @param bool $recursive
     * @param string|null $type
     * @param string|null $password
     * @return mixed
     */
    public function create(string $path, array $files = null, bool $recursive = true, string $type = null, string $password = null);

    /**
     * @param string $type
     * @return mixed
     */
    public function setType(string $type);

    /**
     * @param string $ext
     * @return mixed
     */
    public function setExt(string $ext);

    /**
     * @param string $password
     * @return mixed
     */
    public function setPassword(string $password);  
}