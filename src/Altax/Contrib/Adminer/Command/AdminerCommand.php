<?php
namespace Altax\Contrib\Adminer\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Finder\Finder;

class AdminerCommand extends \Altax\Command\Command
{
    protected function configure()
    {
        $config = $this->getTaskConfig();

        $host = isset($config["host"]) ? $config["host"] : '0.0.0.0';
        $port = isset($config["port"]) ? $config["port"] : 3000;
        $css  = isset($config["css"]) ?  $config["css"] : null;

        $cssList = array();
        $finder = new Finder();
        $finder->files()->depth('== 0')->in(__DIR__."/../Resources/adminer/css");
        foreach ($finder as $file) {
            $cssList[] =  basename($file->getBasename(), ".css");
        }

        $this
            ->setDescription("Adminer runs on the php built-in web server via altax.")
            ->addOption(
                'host',
                'H',
                InputOption::VALUE_REQUIRED, 
                'The host address of the server.', 
                $host
                )
            ->addOption(
                'port',
                'p',
                InputOption::VALUE_REQUIRED, 
                'The port of the server.', 
                $port
                )
            ->addOption(
                'css',
                null,
                InputOption::VALUE_REQUIRED, 
                'Design css. ('.implode("|", $cssList).")", 
                $css
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
        $css = $input->getOption('css');
        $script = __DIR__."/../Resources/public/index.php";
        $docRoot = __DIR__."/../Resources/public";

        $output->writeln("<info>Adminer runs on </info><comment>http://{$host}:{$port}</comment>");

        $cssSetting = null;
        if ($css) {
            $cssSetting = "ADMINER_CSS=$css ";
        } else { 
            $cssSetting = "";
        }

        passthru($cssSetting.PHP_BINARY." -d variables_order=EGPCS -S {$host}:{$port} -t{$docRoot} {$script}");
    }
}
