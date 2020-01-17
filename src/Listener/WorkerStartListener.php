<?php declare(strict_types=1);


namespace Swoft\Elasticsearch\Listener;

use Swoft\Bean\BeanFactory;
use Swoft\Connection\Pool\Exception\ConnectionPoolException;
use Swoft\Elasticsearch\Pool;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Server\ServerEvent;

/**
 * Class WorkerStartListener
 *
 * @since 2.0
 *
 * @Listener(event=ServerEvent::WORK_PROCESS_START)
 */
class WorkerStartListener implements EventHandlerInterface
{
    /**
     * @param EventInterface $event
     *
     * @throws ConnectionPoolException
     */
    public function handle(EventInterface $event): void
    {
        $pools = BeanFactory::getBeans(Pool::class);

        /* @var Pool $pool */
        foreach ($pools as $pool) {
            $pool->initPool();
        }
    }
}
