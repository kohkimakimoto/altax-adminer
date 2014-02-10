<?php
namespace Altax\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdminerCommand extends \Altax\Command\Command
{
    protected function configure()
    {
        $config = $this->getTaskConfig();

        $host = isset($config["host"]) ? $config["host"] : '0.0.0.0';
        $port = isset($config["port"]) ? $config["port"] : 3001;

        $this
            ->setDescription("Adminer runs on the php built-in web server via altax.")
            ->addOption(
                'host',
                'H',
                InputOption::VALUE_OPTIONAL, 
                'The host address of the server.', 
                $host
                )
            ->addOption(
                'port',
                'p',
                InputOption::VALUE_OPTIONAL, 
                'The port of the server.', 
                $port
                )
            ;
    }

    protected function fire($task)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '<'))
        {
            throw new \Exception('This PHP binary is not version 5.4 or greater.');
        }

        $input = $task->getInput();
        $output = $task->getOutput();

        $host = $input->getOption('host');
        $port = $input->getOption('port');

        $script = __DIR__."/../Resource/public/index.php";
        $docRoot = __DIR__."/../Resource/public";

        $output->writeln("<info>Adminer runs on </info><comment>http://{$host}:{$port}</comment>");
        passthru('"'.PHP_BINARY.'"'." -S {$host}:{$port} -t{$docRoot} {$script}");
    }
}
