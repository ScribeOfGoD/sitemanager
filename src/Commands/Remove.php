<?php

namespace YeTii\SiteManager\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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

        $vhost = @file_get_contents(VirtualHost::DEFAULT_MAC_PATH);

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
        $current = @file_get_contents(VirtualHost::DEFAULT_MAC_PATH);
        $new = VirtualHost::get($this->getSiteName());
        $new = str_replace($new, '', $current);
        if ($current === $new) {
            return true;
        }

        if (file_put_contents(
            VirtualHost::DEFAULT_MAC_PATH,
            $new
        ) !== false) {
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
        $current = @file_get_contents(Hosts::DEFAULT_MAC_PATH);
        $new = Hosts::get($this->getSiteName());
        $new = str_replace($new, '', $current);

        if ($current === $new) {
            return true;
        }

        if (file_put_contents(
            Hosts::DEFAULT_MAC_PATH,
            $new
        ) !== false) {
            return true;
        }

        throw new \ErrorException(Hosts::ERROR_UNABLE_TO_REMOVE);
    }
}
