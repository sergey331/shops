<?php

namespace Kernel\Order\Service;

use Exception;

class Discount
{
    public function getTotals(): array
    {
        $total = (float)str_replace(',', '', cart()->total());
        $discounted = 0;

        foreach ($this->getDiscounts() as $discount) {

            if ($discount->min_order_amount && $total < $discount->min_order_amount) {
                continue;
            }

            if ($discount->type === 'percentage') {
                $value = $total * $discount->value / 100;
            } else {
                $value = $discount->value;
            }

            $discounted += $value;
        }

        return [
            'subtotal' => $total,
            'discounted' => $discounted,
            'total' => $total - $discounted
        ];
    }

    /**
     * @throws Exception
     */
    private function getDiscounts()
    {
        return model('discount')
            ->where(['is_active' => true])
            ->whereOp('started_at', '<=', date('Y-m-d'))
            ->get();
    }
}