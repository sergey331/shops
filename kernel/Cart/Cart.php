<?php

namespace Kernel\Cart;

use Kernel\Cart\interface\CartStorageInterface;

class Cart
{
    /** @var CartItem[] */
    private array $cart = [];

    public function __construct(
        private readonly CartStorageInterface $storage
    ) {
        $this->cart = $this->storage->load();
    }

    public function add(int $bookId, int $qty = 1): void
    {
        if (!isset($this->cart[$bookId])) {
            $this->cart[$bookId] = new CartItem($bookId, 0);
        }

        $this->cart[$bookId]->increase($qty);
        $this->save();
    }

    public function update(int $bookId, int $qty): void
    {
        if (!isset($this->cart[$bookId])) {
            $this->cart[$bookId] = new CartItem($bookId, 0);
        }
        if ($qty <= 0) {
            unset($this->cart[$bookId]);
        } else {
            $this->cart[$bookId]->setQty($qty);
        }

        $this->save();
    }

    public function remove($bookId): void 
    {   
        $this->storage->remove($bookId);
    }

    public function get(): array
    {
        foreach ($this->cart as $item) {
            $book = model('Book')->find($item->getBookId());
            $item->setBook($book ?: null);
        }

        return $this->cart;
    }

    private function save(): void
    {
        $this->storage->save($this->cart);
    }

    public function total()
    {
        $total = 0.0;

        foreach ($this->get() as $item) {
            $total += $item->getSubtotal();
        }

        return formatNumber($total);
    }
}
