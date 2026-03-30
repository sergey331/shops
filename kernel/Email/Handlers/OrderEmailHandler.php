<?php

namespace Kernel\Email\Handlers;

use Exception;
use Kernel\Email\Drivers\EmailDriverFactory;
use Kernel\Email\Email;
use Kernel\Email\Interface\EmailHandlerInterface;
use Kernel\Email\Template;

class OrderEmailHandler implements EmailHandlerInterface
{
    /**
     * @throws Exception
     */
    public function handle($itemId): void
    {
        $driver = config('email.default');
        $mailer = EmailDriverFactory::make($driver);
        $order = model('Order')->find($itemId);
        $email = new Email($mailer);

        $clientHtml = Template::render('Order_client', ['order_id' => $itemId]);

        $email->to($order->email)
            ->subject("Your order #$itemId confirmed")
            ->body($clientHtml)
            ->send();

        $adminHtml = Template::render('Order_admin', ['order' => $order]);

        $email->to(setting()->email)
            ->subject("New order #$itemId")
            ->body($adminHtml)
            ->send();
    }
}