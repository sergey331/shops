<?php
namespace Shop\service;

use Kernel\Service\BaseService;

class ShippingService extends BaseService
{
    public function getShippingMethod($regionId)
    {
        $geo = model('GeoZone')->where(['region_id' => $regionId])->first();
        return $geo->shippingMethod ?? null;
    }
    public function getShippingMethodItem($items, $total)
    {
        $total = (int)$total;
        $best = null;
        foreach ($items as $item) {
            $min = (int) $item->min_price;
            if ($total >= $min && (!$best || $min > $best->min_price)) {
                $best = $item;
            }
        }
        return $best;
    }
}