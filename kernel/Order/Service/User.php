<?php

namespace Kernel\Order\Service;

use Exception;

class User
{
    /**
     * @throws Exception
     */
    public function saveAddress($user, array $data)
    {
        $addressData  = $this->addressData($data);

        if ($user && $user->address_id) {
            model('Address')->where(['id' => $user->address_id])->update($addressData);
            return $this->getAddress($user->address_id);
        }
        return model('Address')->create($addressData);
    }

    /**
     * @throws Exception
     */
    public function saveUser(array $data, $address, $user = null)
    {
        $payload = [
            'first_name' => $data['first_name'] ?? '',
            'last_name'  => $data['last_name'] ?? '',
            'address_id' => $address->id ?? null,
        ];

        // 🔐 Only set password if exists
        if (!empty($data['password'])) {
            $payload['password'] = $data['password']; // assume hashed
        }

        // 🔹 UPDATE (logged user or existing)
        if ($user) {
            $user->update($payload);
            return $user;
        }

        $payload['email'] = $data['email'];
        $payload['username'] = $this->generateUsername($data);

        return model('User')->create($payload);
    }

    private function addressData(array $data): array
    {
        return [
            'phone'      => $data['phone'] ?? null,
            'region_id'  => $data['region_id'] ?? null,
            'city'       => $data['city'] ?? null,
            'address'    => $data['address'] ?? null,
            'address1'   => $data['address1'] ?? null,
            'zip'        => $data['zip'] ?? null,
        ];
    }
    private function generateUsername(array $data): string
    {
        $first = strtolower($data['first_name'] ?? 'user');
        $last  = strtolower($data['last_name'] ?? 'name');

        return "{$first}_{$last}";
    }

    public function getAddress($id)
    {
        return model('Address')->find($id);
    }
}