<?php

declare(strict_types=1);

namespace Cycle\ORM\Entity\Behavior\Uuid\Listener;

use Cycle\ORM\Entity\Behavior\Attribute\Listen;
use Cycle\ORM\Entity\Behavior\Event\Mapper\Command\OnCreate;
use Ramsey\Uuid\Uuid;

final class Uuid4
{
    public function __construct(
        private string $field = 'uuid',
        private bool $generate = true
    ) {
    }

    #[Listen(OnCreate::class)]
    public function __invoke(OnCreate $event): void
    {
        if ($this->generate && !isset($event->state->getData()[$this->field])) {
            $event->state->register($this->field, Uuid::uuid4());
        }
    }
}
