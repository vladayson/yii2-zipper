<?php

namespace vladayson\zipper;

use yii\base\Component;

use vladayson\zipper\zippy\Zippy;

/**
 * Class Zipper
 * @package vladayson\zipper
 */
class Zipper extends Component implements ZipperInterface
{
    /** @var Zippy */
    protected $zippy;

    /** @var string */
    public $type = 'zip';

    /** @var string */
    public $ext;

    /** @var string */
    public $password;

    /**
     * @return void
     */
    public function init()
    {
        $this->zippy = Zippy::load();
        if (!$this->ext) {
            $this->ext = $this->type;
            if ($this->ext == '7zip') {
                $this->ext = 'zip';
            }
        }
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @param string $ext
     */
    public function setExt(string $ext)
    {
        $this->ext = $ext;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @param string $path
     * @param array|null $files
     * @param bool $recursive
     * @param string|null $type
     * @param string|null $password
     * @return zippy\ArchiveInterface
     */
    public function create(string $path, array $files = null, bool $recursive = true, string $type = null, string $password = null)
    {
        return $this->zippy->create($path, $files, $recursive,
            $type ? $type : $this->type,
            $password ? $password : $this->password);
    }

    /**
     * @param $path
     * @param null $type
     * @param null $password
     * @return zippy\ArchiveInterface
     */
    public function open($path, $type = null, $password = null)
    {
        return $this->zippy->open($path,
            $type ? $type : $this->type,
            $password ? $password : $this->password);
    }

    /**
     * @param null $type
     * @return mixed
     */
    public function getInflatorVersion($type = null)
    {
        if (!$type) {
            $type = $this->type;
        }
        $adapter = $this->zippy->getAdapterFor($type);

        return $adapter->getInflatorVersion();;
    }

    /**
     * @param null $type
     * @return mixed
     */
    public function getDeflatorVersion($type = null)
    {
        if (!$type) {
            $type = $this->type;
        }
        $adapter = $this->zippy->getAdapterFor($type);

        return $adapter->getDeflatorVersion();
    }
}