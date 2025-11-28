<?php declare(strict_types=1);

namespace MageOS\AlpineLoader\Util;

use Magento\Framework\View\DesignInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CurrentTheme implements ArgumentInterface
{
    public function __construct(
        private readonly DesignInterface $design,
    ) {
    }

    public function isHyva(): bool
    {
        return $this->isTheme('Hyva/default') || $this->isTheme('Hyva/default-csp');
    }

    public function isLuma(): bool
    {
        return $this->isTheme('Magento/blank');
    }

    public function isBreeze(): bool
    {
        return $this->isTheme('Swissup/breeze-blank');
    }

    private function isTheme(string $themeName): bool
    {
        $inheritedThemes = $this->design->getDesignTheme()->getInheritedThemes();

        foreach ($inheritedThemes as $inheritedTheme) {
            if ($inheritedTheme->getCode() === $themeName) {
                return true;
            }
        }

        return false;
    }
}
