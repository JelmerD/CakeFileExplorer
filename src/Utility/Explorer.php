<?php
declare(strict_types=1);

namespace JelmerD\FileExplorer\Utility;

use Cake\I18n\FrozenTime;

class Explorer
{
    protected $_basePath = null;

    protected $_blacklist = [
        '.', '..'
    ];

    public function __construct(string $basePath)
    {
        $this->_basePath = $basePath;
    }

    public function getFiles(string $path = null): array
    {
        $dh = opendir($this->_basePath . $path);

        $files = [];

        while (($file = readdir($dh)) !== false) {
            $fullPath = $this->_basePath . $path . $file;
            if (in_array($file, $this->_blacklist)) continue;

            $filetype = filetype($fullPath);

            $files[$file] = [
                'path' => $path . $file . ($filetype == 'dir' ? DS : null),
                'filetype' => $filetype,
                'permissions' => fileperms($fullPath),
                'created' => (new FrozenTime(filectime($fullPath)))->format('d-m-Y H:i:s'),
                'modified' => (new FrozenTime(filemtime($fullPath)))->format('d-m-Y H:i:s'),
            ];
        }

        closedir($dh);
        return $files;
    }

}
