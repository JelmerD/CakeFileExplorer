<?php
declare(strict_types=1);

namespace JelmerD\FileExplorer\Test\TestCase\Command;

use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * JelmerD.FileExplorer\Command\GeneratePasswordCommand Test Case
 *
 * @uses \JelmerD.FileExplorer\Command\GeneratePasswordCommand
 */
class GeneratePasswordCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->useCommandRunner();
    }
}
