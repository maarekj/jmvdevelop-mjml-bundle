<?php

declare(strict_types=1);

namespace JmvDevelop\MjmlBundle\Nodi;

use JmvDevelop\MjmlBundle\MjmlRenderer as AppMjmlRenderer;
use function JmvDevelop\Nodi\Node\frag;
use JmvDevelop\Nodi\Node\Node;
use JmvDevelop\Nodi\NodeEngine;
use JmvDevelop\Nodi\RendererInterface;

/**
 * @template-implements RendererInterface<MjmlNode>
 */
final class MjmlRenderer implements RendererInterface
{
    public function __construct(private AppMjmlRenderer $mjmlRenderer)
    {
    }

    /**
     * @param MjmlNode $node
     * @param resource $out
     */
    public function stream(NodeEngine $engine, Node $node, $out): void
    {
        $html = $this->mjmlRenderer->render($node->mjml);

        $contents = [];
        foreach ($node->contents as $key => $node) {
            $contents[$key] = $engine->render(frag($node));
        }

        $html = \strtr($html, $contents);
        \fwrite($out, $html);
    }
}
