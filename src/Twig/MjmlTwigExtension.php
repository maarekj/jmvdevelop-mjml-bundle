<?php

declare(strict_types=1);

namespace JmvDevelop\MjmlBundle\Twig;

use JmvDevelop\MjmlBundle\MjmlRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class MjmlTwigExtension extends AbstractExtension
{
    private MjmlRenderer $mjml;

    public function __construct(MjmlRenderer $mjml)
    {
        $this->mjml = $mjml;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('mjml', [$this, 'mjml'], ['is_safe' => ['html']]),
        ];
    }

    public function mjml(?string $content): string
    {
        return $this->mjml->render($content ?? '');
    }
}
