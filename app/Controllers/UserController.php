<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\UserLevelModel;
use App\Models\PropertyModel;
use App\Models\CoverImageModel;
use App\Models\TypeModel;
use App\Models\CategoryModel;
use App\Models\ServiceModel;
use App\Models\UserAddressModel;
use App\Libraries\Auth;
use App\Models\EquipmentsModel;
use App\Models\FeaturesModel;
use App\Models\LocationsActionModel;
use App\Models\MoreImagesModel;
use App\Models\OrientationsModel;
use App\Models\ServiceTypeModel;
use App\Models\ServiceTypesModel;
use App\Models\TypesFloorsModel;
use CodeIgniter\Model;

class UserController extends BaseController{
    use ResponseTrait;
    protected $userModel;
    protected $userLevelModel;
    protected $propertyModel;
    protected $coverImageModel;
    protected $typeModel;
    protected $categoryModel;
    protected $serviceModel;
    protected $auth;
    public function __construct(){
        $this->userModel = new UserModel();
        $this->userLevelModel = new UserLevelModel();
        $this->propertyModel = new PropertyModel();
        $this->coverImageModel = new CoverImageModel();
        $this->typeModel = new TypeModel();
        $this->categoryModel = new CategoryModel();
        $this->serviceModel = new ServiceModel();
        $this->auth = new Auth();
    }
    public function index(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_level = $this->request->getGet("ul");
        if ($user_level){
            $user = $this->userModel->where("user_level_id", $user_level)->findAll();
        }else{
            $user = $this->userModel->where("id != ", 1)->findAll();
        }
        $user_update = [];
        foreach($user as $u){
            $createdAt = $u['created_at'];
            $time = Time::parse($createdAt);
            $u["created_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $u["user_level_name"] = $this->userLevelModel->find($u["user_level_id"])["name"];
            if($u["user_level_id"] == 4){
                $u["quantity_post"] = count($this->serviceModel->where("user_id", $u["id"])->findAll());
            }else if($u["user_level_id"] == 5){
                $u["quantity_post"] = count($this->propertyModel->where("user_id", $u["id"])->findAll());
            }else{
                
            }
            $user_update[] = $u;
        }
        $user = $user_update;
        return view('app/users', ["user" => $user, "user_level" => $user_level]);
    }
    public function userView($client_id){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $serviceTypeModel = new ServiceTypeModel();
        $serviceTypesModel = new ServiceTypesModel();

        $user_id = session()->get("user_id");
        $user = $this->userModel->where("id", $client_id)->find();
        $user_level_name = $this->userLevelModel->where("id", $user[0]["user_level_id"])->find()[0]["name"];
        if ($user[0]["user_level_id"] == 4){
            $property = $this->serviceModel->where("user_id", $client_id)->orderBy('id', 'DESC')->findAll();
        }else{
            $property = $this->propertyModel->where("user_id", $client_id)->orderBy('id', 'DESC')->findAll();
        }
        
        $user_update = [];
        foreach($user as $u){
            $createdAt = $u['created_at'];
            $time = Time::parse($createdAt);
            $u["created_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $u["user_level_name"] = $this->userLevelModel->find($u["user_level_id"])["name"];
            if($u["user_level_id"] == 4){
                $u["quantity_post"] = count($this->serviceModel->where("user_id", $u["id"])->findAll());
            }else if($u["user_level_id"] == 5){
                $u["quantity_post"] = count($this->propertyModel->where("user_id", $u["id"])->findAll());
            }else{
                
            }
            $user_update[] = $u;
        }
        $user = $user_update;

        $updatedProperties = [];

        foreach ($property as $pr) {
            $createdAt = $pr['updated_at'];
            $time = Time::parse($createdAt);
            $pr["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            if ($user[0]["user_level_id"] == 4){
                $pr["service_type"] = [];
                $pr["cover_image"] = ($cover_image = $this->coverImageModel->where("service_id", $pr["id"])->findAll()) ? $cover_image[0] : ["url" => ""];
                $service_type_ids = $serviceTypesModel->where("service_id", $pr["id"])->findColumn("service_type_id");
                if (!empty($service_type_ids)){
                    foreach($service_type_ids as $sti){
                        $service_type_temp = $serviceTypeModel->where("id", $sti)->find();
                        if (!empty($service_type_temp) && count($service_type_temp) == 1){
                            array_push($pr["service_type"], $service_type_temp[0]);
                        }
                    }
                }

            }else{
                $pr["type_name"] = ($type = $this->typeModel->find([$pr["type_id"]])) ? $type[0]["name"] : "";
                $pr["category_name"] = ($category = $this->categoryModel->find([$pr["category_id"]])) ? $category[0]["name"] : "";
                $pr["cover_image"] = ($cover_image = $this->coverImageModel->where("property_id", $pr["id"])->findAll()) ? $cover_image[0] : ["url" => ""];
            }
            
            $updatedProperties[] = $pr;
        }
        
        $property = $updatedProperties;
        return view('app/user_view', ["property" => $property, "user" => $user, "user_level_name" => $user_level_name]);
    }
    public function update(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");
        $userAddressModel = new UserAddressModel();
        $user = $this->userModel->find($user_id);
        $userAddress = $userAddressModel->where("user_id", $user_id)->findAll();


        return view("app/user_update", ["user" => $user, "userAddress" => $userAddress]);
    }
    public function updateSave(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");
        $userAddressModel = new UserAddressModel();

        $first_name = $this->request->getPost("first_name");
        $last_name = $this->request->getPost("last_name");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $landline_phone = $this->request->getPost("landline_phone");
        $document_type = $this->request->getPost("document_type");
        $document_number = $this->request->getPost("document_number");
        $user_name = $this->request->getPost("user_name");
        $password = $this->request->getPost("password");
        $photo = $this->request->getFile("photo");

        $address = $this->request->getPost("address");
        $city = $this->request->getPost("city");
        $postal_code = $this->request->getPost("postal_code");
        $province = $this->request->getPost("province");
        $country = $this->request->getPost("country");
        $latitude = $this->request->getPost("latitude");
        $longitude = $this->request->getPost("longitude");


        $photo_name = "";
        $data_for_db = [];

        !empty($user_name) ? $data_for_db['user_name'] = $user_name : null;
        !empty($first_name) ? $data_for_db['first_name'] = $first_name : null;
        $data_for_db['last_name'] = $last_name;
        !empty($email) ? $data_for_db['email'] = $email : null;
        !empty($phone) ? $data_for_db['phone'] = $phone : null;
        $data_for_db['landline_phone'] = $landline_phone;
        $data_for_db['document_number'] = $document_number;
        $data_for_db['document_type'] = $document_type;
        $data_for_db['address'] = $address;
        !empty($password) ? $data_for_db['password'] = $password : null;

        $test_user_address_temp = $userAddressModel->where("user_id", $user_id)->findAll();
        if (!empty($test_user_address_temp)){
            $userAddressModel->set([
                "address" => $address,
                "city" => $city,
                "province" => $province,
                "postal_code" => $postal_code,
                "country" => $country,
                "latitude" => $latitude,
                "longitude" => $longitude,])
                ->where("user_id", $user_id)->update();
        }else{
            $userAddressModel->insert([
                "user_id" => $user_id,
                "address" => $address,
                "city" => $city,
                "province" => $province,
                "postal_code" => $postal_code,
                "country" => $country,
                "latitude" => $latitude,
                "longitude" => $longitude,]);
        }

        $session = session();
        $imagePath = FCPATH . 'img/photo_profile/';
        if (!is_dir($imagePath)) {
            mkdir($imagePath, 0755, true);
        }
        if ($photo && $photo->getName() != '') {
            if ($photo->isValid() && !$photo->hasMoved()) {
                $randomName = pathinfo($photo->getRandomName(), PATHINFO_FILENAME) . '.webp';
                $tempPath = $photo->getTempName();
                $image = null;
                $is_webp = false;
                switch ($photo->getMimeType()) {
                    case 'image/webp':
                        $is_webp = true;                    
                        if (!$photo->move($imagePath, $randomName)) {
                            $session->setFlashdata('error', 'Error al mover la imagen WebP.');
                            return redirect()->to(base_url('post/index'));
                        }
                        break;
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($tempPath);
                        break;
                    case 'image/png':
                        $image = imagecreatefrompng($tempPath);
                        break;
                    default:
                        $session->setFlashdata('error', 'Formato de imagen no soportado.');
                        return redirect()->to(base_url('post/index'));
                }
                if (!$is_webp){
                    $webpPath = $imagePath . $randomName;
                    if (!imagewebp($image, $webpPath, 80)) {
                        $session->setFlashdata('error', 'Error al convertir la imagen a WebP.');
                        return redirect()->to(base_url('post/index'));   
                    }
                    imagedestroy($image);
                }
                $photo_name = $randomName;
            }
        }
        !empty($photo_name) ? $data_for_db['photo'] = $photo_name : null;

        $this->userModel->update($user_id, $data_for_db);

        $session->setFlashdata('success', "Actualizado correctamente");
        
        return redirect()->to(site_url("user/update"));
    }
    public function userDelete(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $userAddressModel = new UserAddressModel();
        $featuresModel = new FeaturesModel();
        $equipmentsModel = new EquipmentsModel();
        $typesFloorsModel = new TypesFloorsModel();
        $orientationsModel = new OrientationsModel();
        $coverImageModel = new CoverImageModel();
        $moreImagesModel = new MoreImagesModel();
        $propertyModel = new PropertyModel();
        $serviceModel = new ServiceModel();
        $serviceTypesModel = new ServiceTypesModel();
        $locationsActionModel = new LocationsActionModel();


        $user_level = session()->get("user_level_id");
        $user_id_delete = $this->request->getGet("id");
        $session = session();
        if ($user_level == 1){
            $this->userModel->delete($user_id_delete);

            $property_ids = $this->propertyModel->where("user_id", $user_id_delete)->findColumn("id");
            foreach($property_ids as $id){
                $propertyModel->where("id", $id)
                ->delete();
                $featuresModel
                    ->where("property_id", $id)
                    ->delete();
                $equipmentsModel
                    ->where("property_id", $id)
                    ->delete();
                $typesFloorsModel
                    ->where("property_id", $id)
                    ->delete();
                $orientationsModel
                    ->where("property_id", $id)
                    ->delete();
                $coverImageModel
                    ->where("property_id", $id)
                    ->delete();
                $moreImagesModel
                    ->where("property_id", $id)
                    ->delete();
            }
            $service_ids = $this->serviceModel->where("user_id", $user_id_delete)->findColumn("id");
            foreach($service_ids as $id){
                $serviceModel
                    ->where("id", $id)
                    ->delete();
                $serviceTypesModel
                    ->where("service_id", $id)
                    ->delete();
                $locationsActionModel
                    ->where("service_id", $id)
                    ->delete();
                $coverImageModel
                    ->where("service_id", $id)
                    ->delete();
                $moreImagesModel
                    ->where("service_id", $id)
                    ->delete();
            }

            $userAddressModel->where("user_id", $user_id_delete)->delete();

            $session->setFlashdata('success', "Eliminado correctamente");
            return $this->respond(["status" => 200,]);
        }else{
            $session->setFlashdata('warning', "Error de privilegio.");
            return $this->respond(["status" => 403,"user_level" => $user_level]);
        }

    }
}
