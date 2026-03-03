<?php

namespace Shop\service;

use Kernel\Form\Form;
use Kernel\Service\BaseService;
use Kernel\Table\Table;
use Kernel\Validator\Validator;
use Shop\model\GeoZone;
use Shop\model\ShippingMethod;
use Shop\rules\GeoZoneRules;
use Shop\rules\ShippingMethodRules;

class
GeoZoneService extends BaseService
{
    public function getGeoZones(): array
    {
        $data = model('GeoZone')->paginate();
        return ['tableData' => $this->getTableData($data), 'geoZone' => $data];
    }

    public function getForms($url, ?GeoZone $geoZone = null)
    {

        $errors = session()->getCLean('errors') ?? [];
        $form = new Form($url, 'POST', [], $errors);

        $form->setSelect('region_id', 'Region',
            model('Region')->get(),
            [
            'class' => 'form-control',
            'option_default_label' => 'Select Region',
            'value' => $geoZone->region_id ?? ''
        ]);

        $form->setSelect('shipping_method_id', 'Shipping method',
            model('ShippingMethod')->get(),
            [
                'class' => 'form-control',
                'option_default_label' => 'Select Shipping Method',
                'value' => $geoZone->shipping_method_id ?? ''
            ]);
        return $form;
    }

    public function storeOrUpdate(?GeoZone $geoZone = null)
    {
        $data = request()->all();

        $validator = Validator::make($data, GeoZoneRules::rules());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $geoZone = !$geoZone ? model('GeoZone')->where(['region_id' => $data['region_id']])->first() : $geoZone;
        $geoZone
            ? $geoZone->update($data)
            : model('GeoZone')->create($data);
        session()->set('success', 'created');
        return true;
    }

    public function delete(GeoZone $geoZone)
    {

        $geoZone->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function getTableData($geZones): Table
    {

        $table = new Table($geZones->data, [
            "#" => ['field' => 'id'],
            "Region" => ['field' => 'region.name'],
            "Shipping Method" => ['field' => 'shippingMethod.name'],
            "Actions" => [
                'callback' => function ($row) {
                    $id = $row->id;
                    return '
                        <a href="/admin/geo-zones/' . $id . '" class="btn btn-sm btn-primary text-white">Edit</a>
                        <a href="/admin/geo-zones/delete/' . $id . '" class="btn btn-sm btn-danger text-white">Delete</a>
                    ';
                }
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}