<?php
/**
 * @var AppView $this
 * @var array $data
 */

use JelmerD\Bootstrap\View\AppView;

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-2">
            <?php
            echo $this->Form->create();
            echo $this->Form->control('path', ['type' => 'text']);
            echo $this->Form->control('password', ['type' => 'password']);
            echo $this->Form->submit('Login');
            echo $this->Form->end();
            ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">

        </div>
    </div>
</div>
