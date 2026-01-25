<?php
namespace Kernel\Cart;

use JsonSerializable;
use Kernel\Cart\Interface\CartItemInterface;


class CartItem implements JsonSerializable
{
    private int $bookId;
    private int $quantity;
    private float $price;
    private ?object $book = null;

    public function __construct(int $bookId, int $quantity, float $price)
    {
        $this->bookId = $bookId;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getSubtotal(): float
    {
        return $this->price * $this->quantity;
    }

    public function increaseQuantity(int $by = 1): void
    {
        $this->quantity += $by;
    }
    public function setQuantity(int $qty): void
    {
        $this->quantity = $qty;
    }

    public function setBook(?object $book): void
    {
        $this->book = $book;
    }
    public function getBook(): ?object
    {
        return $this->book;
    }
    public function jsonSerialize(): array
    {
        return [
            'book_id' => $this->bookId,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'subtotal' => $this->price * $this->quantity,
            'book' => $this->book
        ];
    }
}
