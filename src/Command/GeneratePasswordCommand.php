<?php
declare(strict_types=1);

namespace JelmerD\FileExplorer\Command;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * GeneratePassword command.
 */
class GeneratePasswordCommand extends Command
{
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param ConsoleOptionParser $parser The parser to be defined
     * @return ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);
        $parser->setDescription('Use this tool to generate a password. This hashed password is then to be added in the config/app_local.php as Security.fileExplorerPassword');
        $parser->addArgument('password', [
            'required' => true,
            'help' => 'The password to hash'
        ]);
        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param Arguments $args The command arguments.
     * @param ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $password = $args->getArgument('password');
        $hashed = (new DefaultPasswordHasher())->hash($password);
        $io->success('Add the hashed password in config/app_local.php to Security.fileExplorerPassword (below your salt)');
        $io->out($hashed);
    }
}
