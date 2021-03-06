<?php
declare(strict_types=1);

namespace MonsieurBiz\SyliusSearchPlugin\Command;

use MonsieurBiz\SyliusSearchPlugin\Exception\ReadOnlyIndexException;
use MonsieurBiz\SyliusSearchPlugin\Model\Document\Index\Indexer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'monsieurbiz:search:populate';

    /**
     * @var Indexer
     */
    protected $documentIndexer;

    /**
     * PopulateCommand constructor.
     * @param Indexer $documentIndexer
     */
    public function __construct(Indexer $documentIndexer)
    {
        $this->documentIndexer = $documentIndexer;
        parent::__construct(static::$defaultName);
    }

    /**
     * Populate ES.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Generating index'));
        try {
            $this->documentIndexer->indexAll();
        } catch (ReadOnlyIndexException $exception) {
            $output->writeln('Cannot purge old index. Please to do it manually if needed.');
        }
        $output->writeln(sprintf('Generated index'));
    }
}
