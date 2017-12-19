<?php

namespace YeTii\SiteManager\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use YeTii\SiteManager\Hosts;
use YeTii\SiteManager\Traits\HasSiteName;
use YeTii\SiteManager\VirtualHost;

/**
 * Class Remove
 */
class Remove extends Command
{
    use HasSiteName;

    private $vhostsPath;
    private $hostsPath;

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('remove')
            ->setDescription('Remove a specified site.')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'The name of the site without a TLD.'
            )
            ->addOption(
                'vhosts',
                null,
                InputOption::VALUE_REQUIRED,
                'Specify a path to the vhosts config file.',
                '/etc/apache2/sites-available/sites.conf'
            )
            ->addOption(
                'hosts',
                null,
                InputOption::VALUE_REQUIRED,
                'Specify a path to the hosts file.',
                '/etc/hosts'
            );
    }

    /**
     * Execute the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     * @throws \ErrorException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setSiteName($input->getArgument('name'));
        $this->vhostsPath = $input->getOption('vhosts');
        $this->hostsPath = $input->getOption('hosts');

        $this->removeVhost();
        $this->removeHost();

        $output->writeln('Successfully removed `'.$this->getSiteName().'.local` virtual host.');
    }

    /**
     * @return bool
     * @throws \ErrorException
     */
    public function removeVhost()
    {
        $current = @file_get_contents($this->vhostsPath);
        $new = VirtualHost::get($this->getSiteName());
        $new = str_replace($new, '', $current);
        if ($current === $new) {
            return true;
        }

        if (file_put_contents($this->vhostsPath, $new) !== false) {
            return true;
        }

        throw new \ErrorException(VirtualHost::ERROR_UNABLE_TO_REMOVE);
    }

    /**
     * @return bool
     * @throws \ErrorException
     */
    public function removeHost()
    {
        $current = @file_get_contents($this->hostsPath);
        $new = Hosts::get($this->getSiteName());
        $new = str_replace($new, '', $current);

        if ($current === $new) {
            return true;
        }

        if (file_put_contents($this->hostsPath, $new) !== false) {
            return true;
        }

        throw new \ErrorException(Hosts::ERROR_UNABLE_TO_REMOVE);
    }
}
