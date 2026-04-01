<?php

namespace Kernel\Order\Service;

use Exception;

class Shipping
{
    /**
     * @throws Exception
     */
    public function getShippingMethod($regionId)
    {
        $geo = model('GeoZone')->where(['region_id' => $regionId])->first();
        return $geo->shippingMethod ?? null;
    }
    public function getShippingMethodItem(array $items, $total)
    {
        $total = (int) $total;
        $best = null;
        $fallback = null;

        foreach ($items as $item) {
            $min = (int)$item->min_price;
            if ($total >= $min && (!$best || $min > $best->min_price)) {
                $best = $item;
            }
            if (!$fallback || $min < $fallback->min_price) {
                $fallback = $item;
            }
        }
        return $best ?? $fallback;
    }
}