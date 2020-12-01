<?php

declare(strict_types=1);

namespace Backend\Api\User\Presentation\Cli\Command;

use Backend\Api\User\Infrastructure\Repository\UserAddTaskRepository;
use Enqueue\Client\ProducerInterface;
use Exception;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestSendUser.
 */
class TestSendUser extends Command
{
    // the name of the command (the part after "bin/console")
    /**
     * Cli command name.
     *
     * @var string
     */
    protected static $defaultName = 'user:test';

    /**
     * Queue producer.
     *
     * @var ProducerInterface
     */
    private ProducerInterface $producer;

    /**
     * TestSendUser constructor.
     *
     * @param ProducerInterface $userDtoProducer
     * @param string|null $name
     */
    public function __construct(ProducerInterface $userDtoProducer, ?string $name = null)
    {
        parent::__construct($name);
        $this->producer = $userDtoProducer;
    }

    /**
     * Execute cli command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     *
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        unset($input, $output);
        $fixtureFiles = glob(ROOT_PATH . '/tests/fixture/*.json');

        if (false === $fixtureFiles) {
            throw new RuntimeException('Fixture files not found.');
        }

        foreach ($fixtureFiles as $file) {
            $raw = file_get_contents($file);

            if (!$raw) {
                continue;
            }
            $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);

            foreach ($data as $userResultDto) {
                if (null === $userResultDto) {
                    continue;
                }
                $this->producer->sendEvent(UserAddTaskRepository::QUEUE_MASTER_DATA, $userResultDto);
            }
        }

        return 0;
    }
}
