<?php
/**
 * @var  Order $order
 */

use Shop\model\Order;
?>

<h2>New Order Received</h2>
<p>Order ID: <?= $order->id ?></p>
<p>User: <?= htmlspecialchars($order->first_name) ?>  <?= htmlspecialchars($order->last_name) ?></p>
<p>Total: $<?= $order->total ?></p>