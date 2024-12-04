<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\LockInterface;
use Symfony\Contracts\Service\Attribute\Required;

#[AsCommand(
    name: 'app:lock:issue',
)]
class LockIssueCommand extends Command
{
    protected LockInterface $lock;

    public function __construct(LockFactory $lockFactory, ?string $name = null)
    {
        parent::__construct($name);
        $this->lock = $lockFactory->createLock($this->getName());
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->lock->acquire();

        sleep(1);

        $this->lock->release();
        return Command::SUCCESS;
    }
}
