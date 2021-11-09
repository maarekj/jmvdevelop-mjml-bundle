<?php

declare(strict_types=1);

namespace JmvDevelop\MjmlBundle;

use Symfony\Component\Process\Process;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class MjmlRenderer
{
    public function __construct(
        private string $nodejsBin,
        private string $mjmlBin,
        private CacheInterface $cache
    ) {
    }

    public function render(string $mjmlContent): string
    {
        try {
            /** @psalm-suppress ArgumentTypeCoercion */
            $content = $this->cache->get(\md5($mjmlContent), function (ItemInterface $item) use ($mjmlContent): string {
                $args = [
                    $this->nodejsBin,
                    $this->mjmlBin,
                    '-i',
                    '-s',
                ];

                $process = new Process($args);
                $process->setInput($mjmlContent);
                $process->mustRun();

                return $process->getOutput();
            });
            \assert(\is_string($content));

            return $content;
        } catch (\InvalidArgumentException $e) {
            throw $e;
        }
    }
}
