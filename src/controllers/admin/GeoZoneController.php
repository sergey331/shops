<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Shop\model\GeoZone;
use Shop\service\GeoZoneService;

class GeoZoneController extends BaseController
{
    private GeoZoneService $geoZoneService;

    public function __construct()
    {
        $this->geoZoneService = new GeoZoneService();
    }

    public function index()
    {
        $data = $this->geoZoneService->getGeoZones();
        $this->view()->load('Admin.GeoZone.Index', [
            'geoZone' => $data['geoZone'],
            'tableData' => $data['tableData']
        ], 'admin');
    }

    public function create()
    {
        $this->view()->load('Admin.GeoZone.Create', [
            'form' => $this->geoZoneService->getForms('/admin/geo-zones/store')
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->geoZoneService->storeOrUpdate()) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/geo-zones');
    }

    public function edit(GeoZone $geoZone)
    {
        $this->view()->load('Admin.GeoZone.Edit', [
            'form' => $this->geoZoneService->getForms("/admin/geo-zones/{$geoZone->id}",$geoZone)
        ], 'admin');
    }

    public function update(GeoZone $geoZone)
    {
        if (!$this->geoZoneService->storeOrUpdate($geoZone)) {
            $this->redirect()->back();
            return;
        }
        $this->redirect()->to('/admin/geo-zones');
    }

    public function delete(GeoZone $geoZone)
    {
        $this->geoZoneService->delete($geoZone);

        $this->redirect()->to('/admin/geo-zones');
    }
}