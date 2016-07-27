<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Inventory\Checker;

use Sylius\Component\Inventory\Model\StockableInterface;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class AvailabilityChecker implements AvailabilityCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function isStockAvailable(StockableInterface $stockable)
    {
        if ($stockable->isAvailableOnDemand()) {
            return true;
        }

        return 0 < ($stockable->getOnHand() - $stockable->getOnHold());
    }

    /**
     * {@inheritdoc}
     */
    public function isStockSufficient(StockableInterface $stockable, $quantity)
    {
        if ($stockable->isAvailableOnDemand()) {
            return true;
        }

        return $quantity <= ($stockable->getOnHand() - $stockable->getOnHold());
    }
}
