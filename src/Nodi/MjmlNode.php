<?php

declare(strict_types=1);

namespace JmvDevelop\MjmlBundle\Nodi;

use JmvDevelop\Nodi\Node\Node;

final class MjmlNode extends Node
{
    /**
     * @param array<string, Node|string|array<array-key, Node|string>> $contents
     */
    public function __construct(
        public string $mjml,
        public array $contents = []
    ) {
    }

    public function getServiceKey(): string
    {
        return MjmlRenderer::class;
    }
}
