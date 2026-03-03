<?php
namespace Shop\model;

use Kernel\Model\Model;

class Region extends Model
{
    protected string $table = 'regions';
    protected array $fillable = ['name'];
}