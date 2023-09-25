<?php  
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelSettingApi;

class ApiSetting extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\ModelSettingApi';
    protected $format    = 'json';

    public function index()
    {
        $settingModel = new ModelSettingApi();
        $settings = $settingModel->findAll();
        return $this->respond($settings);
    }

    public function show($id = null)
    {
        $settingModel = new ModelSettingApi();
        $setting = $settingModel->find($id);

        if (!$setting) {
            return $this->failNotFound('Setting tidak ditemukan.');
        }

        return $this->respond($setting);
    }
}
