<?php
namespace Shop\service;

use Kernel\Service\BaseService;

class UserService extends BaseService
{
    public function createAddress(array $data)
    {
        return model('Address')->create([
            'phone' => $data['phone'],
            'region_id' => $data['region_id'],
            'city' => $data['city'],
            'address' => $data['address'],
            'address1' => $data['address1'],
            'zip' => $data['zip']
        ]);
    }
    public function register($data, $address)
    {
        return model("User")->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => lcfirst($data['first_name']) . '_' . lcfirst($data['last_name']),
            'email' => $data['email'],
            'password' => $data['password'],
            'address_id' => $address->id
        ]);
    }
}