<?php
/**
 * @var AppView $this
 * @var array $files
 * @var array $explodedPath
 */

use JelmerD\Bootstrap\View\AppView;

?>
<div class="container-fluid">
    <div class="row pt-1 pb-1 ps-1">
        <div class="col">

            <?php
            if (empty($explodedPath)) {
                echo 'HOME';
            } else {
                printf('%s / ', $this->Html->link('HOME', ['prefix' => null, 'action' => 'index']));
            }
            $q = null;
            foreach ($explodedPath as $k => $path) {
                if ($k != array_key_last($explodedPath)) {
                    $q .= $path . '/';
                    printf('%s / ', $this->Html->link($path, ['prefix' => null, '?' => ['p' => $q]]));
                } else {
                    echo $path;
                }
            }
            ?>

        </div>
        <div class="col-1 text-end">
            <?php echo $this->Html->button('Logout', ['controller' => 'Connect', 'action' => 'logout', 'prefix' => null]) ?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row ps-1 pe-1">
        <div class="col">
            <?php echo $this->element('JelmerD/FileExplorer.table', ['data' => $files]); ?>
        </div>
    </div>
</div>
