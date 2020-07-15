<?php

namespace vladayson\zipper\zippy\FileStrategy;

use Alchemy\Zippy\FileStrategy\AbstractFileStrategy;
use vladayson\zipper\zippy\Adapter\Zip7zipAdapter;

/**
 * Class Zip7zipFileStrategy
 * @package vladayson\zipper\zippy\FileStrategy
 */
class Zip7zipFileStrategy extends AbstractFileStrategy
{
 
    /**
     * {@inheritdoc}
     */
    protected function getServiceNames()
    {
        return [
            Zip7zipAdapter::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFileExtension()
    {
        return '7zip';
    }
}
