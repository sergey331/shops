<?php
namespace Kernel\Cart;

use Shop\model\Book;

class CartItem
{
    private int $bookId;
    private int $qty;
    private ?Book $book = null;

    public function __construct(int $bookId, int $qty)
    {
        $this->bookId = $bookId;
        $this->qty = $qty;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function increase(int $qty): void
    {
        $this->qty += $qty;
    }

    public function setBook(?Book $book): void
    {
        $this->book = $book;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function getSubtotal()
    {
        if (!$this->book) {
            return 0.0;
        }

        return formatNumber($this->getPrice() * $this->qty);
    }

    private function getPrice()
    {
        $finalPrice = 0;
        if ($this->book->discount) {
            if ($this->book->discount->type === "percentage") {
                $finalPrice = $this->book->price - ($this->book->price * $this->book->discount->price / 100);
            } else if ($this->book->discount->type === "fixed") {
                $finalPrice = $this->book->price - $this->book->discount->price;
            }

            $finalPrice = $finalPrice < 0 ? 0 : $finalPrice;
        } else {
            $finalPrice = $this->book->price;
        }
        return $finalPrice;
    }
}