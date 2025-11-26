<?php
namespace Shop\model;

use Kernel\Model\Model;

class Language extends Model
{
    protected string $table = 'languages';
    protected array $fillable = ['name','code'];
}