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

    public function getSubtotal(): float
    {
        if (!$this->book) {
            return 0.0;
        }

        return $this->book->price * $this->qty;
    }
}