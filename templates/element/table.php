<?php

use JelmerD\Bootstrap\View\AppView;

/**
 * @var AppView $this
 * @var array $data
 */
echo $this->Table->create('Data', ['class' => 'table']);

if ($data) {
    echo $this->Table->head([
        '',
        'Permissions',
        'Created',
        'Modified',
    ]);
    echo $this->Table->body();
    foreach ($data as $title => $options) {
        echo $this->Table->row();
        echo $this->Table->cell($options['filetype'] == 'dir' ? $this->Html->link($title, ['prefix' => null, '?' => ['p' => $options['path']]]) : $title);
        echo $this->Table->cell($options['permissions']);
        echo $this->Table->cell($options['created']);
        echo $this->Table->cell($options['modified']);
    }
} else {
    echo $this->Table->row(['No data found']);
}

echo $this->Table->end();
