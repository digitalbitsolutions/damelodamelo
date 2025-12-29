<?php

namespace App\Controllers;
helper('recaptcha');
use CodeIgniter\I18n\Time;
use App\Models\CategoryModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\CoverImageModel;
use App\Models\FeatureModel;
use App\Models\FeaturesModel;
use App\Models\MoreImagesModel;
use App\Models\PropertyModel;
use App\Models\ProvinceModel;
use App\Models\StateModel;
use App\Models\TypeModel;
use App\Models\UserLevelModel;
use App\Models\UserModel;
use App\Models\TypologyModel;
use App\Models\OrientationModel;
use App\Models\OrientationsModel;
use App\Models\TypeHeatingModel;
use App\Models\EmissionsRatingModel;
use App\Models\EnergyClassModel;
use App\Models\StateConservationModel;
use App\Models\VisibilityInPortalsModel;
use App\Models\RentalTypeModel;
use App\Models\ContactOptionModel;
use App\Models\PowerConsumptionRatingModel;
use App\Models\ReasonForSaleModel;
use App\Models\FacadeModel;
use App\Models\EquipmentModel;
use App\Models\EquipmentsModel;
use App\Models\VideoModel;
use App\Models\PlantModel;
use App\Models\TypeFloorModel;
use App\Models\TypesFloorsModel;
use App\Models\PlazaCapacityModel;
use App\Models\NearestMunicipalityDistanceModel;
use App\Models\WheeledAccessModel;
use App\Models\TypeOfTerrainModel;
use App\Models\ServiceTypeModel;
use App\Models\DoorModel;
use App\Models\PropertyAddressModel;
use App\Models\ServiceModel;
use App\Models\ServiceTypesModel;
use App\Models\UserAddressModel;
use App\Models\PostVisitsModel;
use App\Models\PropertyStatsModel;

use App\Models\PsViewsDetailModel;
use App\Models\PsViewsSearchModel;

class Page extends BaseController{
    protected $userModel;
    protected $serviceTypeModel;
    protected $cityModel;

    public function __construct(){
        $this->serviceTypeModel = new ServiceTypeModel();
        $this->userModel = new UserModel();
        $this->cityModel = new CityModel();
    }
    public function index(){
        
        $categoryModel = new CategoryModel();
        $cityModel = new CityModel();
        $countryModel = new CountryModel();
        $coverImageModel = new CoverImageModel();
        $featureModel = new FeatureModel();
        $propertyModel = new PropertyModel();
        $provinceModel = new ProvinceModel();
        $typeModel = new TypeModel();
        $stateConservationModel = new StateConservationModel();
        $facadeModel = new FacadeModel();
        $nearestMunicipalityDistanceModel = new NearestMunicipalityDistanceModel();
        $wheeledAccessModel = new WheeledAccessModel();
        $typeOfTerrainModel = new TypeOfTerrainModel();
        $postVisitsModel = new PostVisitsModel();


        $city = $this->cityModel->findAll();
        $serviceType = $this->serviceTypeModel->findAll();
        $property = $propertyModel->where("state_id", 4)->orderBy('id', 'DESC')->findAll(6);
        $updatedProperties = [];
        foreach ($property as $pr) {
            $createdAt = $pr['updated_at'];
            $time = Time::parse($createdAt);
            $pr["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $pr["type_name"] = ($type = $typeModel->find([$pr["type_id"]])) ? $type[0]["name"] : "";
            $pr["category_name"] = ($category = $categoryModel->find([$pr["category_id"]])) ? $category[0]["name"] : "";
            $pr["cover_image"] = ($cover_image = $coverImageModel->where("property_id", $pr["id"])->findAll()) ? $cover_image[0] : ["url" => ""];
            $pr["user_name"] = $this->userModel->find($pr["user_id"])["user_name"];
            $pr["post_visits"] = count($postVisitsModel->where("post_id", $pr["id"])->findAll());

            $pr["state_conservation"] = $stateConservationModel->where("id", $pr["state_conservation_id"])->findAll();
            $pr["facade"] = $facadeModel->where("id", $pr["facade_id"])->findAll();
            $pr["nearest_municipality_distance"] = $nearestMunicipalityDistanceModel->where("id", $pr["nearest_municipality_distance_id"])->findAll();
            $pr["type_of_terrain"] = $typeOfTerrainModel->where("id", $pr["type_of_terrain_id"])->findAll();
            $pr["wheeled_access"] = $wheeledAccessModel->where("id", $pr["wheeled_access_id"])->findAll();
            
            $updatedProperties[] = $pr;
        }

        $property = $updatedProperties;
        return view('page/index', ["property" => $property, "serviceType" => $serviceType, "city" => $city]);
    }
    public function result($id){
        $userModel = new UserModel();
        $stateModel = new StateModel();
        $userLevelModel = new UserLevelModel();    
            
        $categoryModel = new CategoryModel();
        $cityModel = new CityModel();
        $countryModel = new CountryModel();
        $coverImageModel = new CoverImageModel();
        $featureModel = new FeatureModel();
        $featuresModel = new FeaturesModel();
        $moreImagesModel = new MoreImagesModel();
        $propertyModel = new PropertyModel();
        $provinceModel = new ProvinceModel();
        $typeModel = new TypeModel();
        $typologyModel = new TypologyModel();
        $orientationModel = new OrientationModel();
        $orientationsModel = new OrientationsModel();
        $typeHeatingModel = new TypeHeatingModel();
        $emissionsRatingModel = new EmissionsRatingModel();
        $energyClassModel = new EnergyClassModel();
        $stateConservationModel = new StateConservationModel();
        $visibilityInPortalsModel = new VisibilityInPortalsModel();
        $rentalTypeModel = new RentalTypeModel();
        $contactOptionModel = new ContactOptionModel();
        $powerConsumptionRatingModel = new PowerConsumptionRatingModel();
        $reasonForSaleModel = new ReasonForSaleModel();
        $facadeModel = new FacadeModel();
        $equipmentsModel = new EquipmentsModel();
        $equipmentModel = new EquipmentModel();
        $videoModel = new VideoModel();
        $plantModel = new PlantModel();
        $typeFloorModel = new TypeFloorModel();
        $typesFloorsModel = new TypesFloorsModel();
        $plazaCapacityModel = new PlazaCapacityModel();
        $nearestMunicipalityDistanceModel = new NearestMunicipalityDistanceModel();
        $wheeledAccessModel = new WheeledAccessModel();
        $typeOfTerrainModel = new TypeOfTerrainModel();
        $propertyAddressModel = new PropertyAddressModel();
        $propertyStatsModel = new PropertyStatsModel();


        $property = $propertyModel->where("reference", $id)->where("state_id", 4)->findAll();
        if (empty($property)){
            return redirect()->to('/');
        }

        $updatedProperties = [];
        foreach ($property as $pr) {
            $createdAt = $pr['updated_at'];
            $time = Time::parse($createdAt);
            $pr["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $pr["type_name"] = ($type = $typeModel->find([$pr["type_id"]])) ? $type[0]["name"] : "";
            $pr["category_name"] = ($category = $categoryModel->find([$pr["category_id"]])) ? $category[0]["name"] : "";
            $pr["cover_image"] = ($cover_image = $coverImageModel->where("property_id", $pr["id"])->findAll()) ? $cover_image[0] : [];
            $pr["more_images"] = ($more_images = $moreImagesModel->where("property_id", $pr["id"])->findAll()) ? $more_images : [];

            $pr["city"] = ($city = $cityModel->where("id", $pr["city_id"])->findAll()) ? $city : [];
            $pr["province"] = ($province = $provinceModel->where("id", $pr["province_id"])->findAll()) ? $province : [];
            $pr["country"] = ($country = $countryModel->where("id", $pr["country_id"])->findAll()) ? $country : [];
            $pr["typology"] = ($typology = $typologyModel->where("id", $pr["typology_id"])->findAll()) ? $typology : [];
            
            $pr["type_heating"] = ($type_heating = $typeHeatingModel->where("id", $pr["type_heating_id"])->findAll()) ? $type_heating : [];
            $pr["emissions_rating"] = ($emissions_rating = $emissionsRatingModel->where("id", $pr["emissions_rating_id"])->findAll()) ? $emissions_rating : [];
            $pr["energy_class"] = ($energy_class = $energyClassModel->where("id", $pr["energy_class_id"])->findAll()) ? $energy_class : [];
            $pr["state_conservation"] = ($state_conservation = $stateConservationModel->where("id", $pr["state_conservation_id"])->findAll()) ? $state_conservation : [];
            $pr["visibility_in_portals"] = ($visibility_in_portals = $visibilityInPortalsModel->where("id", $pr["visibility_in_portals_id"])->findAll()) ? $visibility_in_portals : [];
            $pr["rental_type"] = ($rental_type = $rentalTypeModel->where("id", $pr["rental_type_id"])->findAll()) ? $rental_type : null;
            $pr["contact_option"] = ($contact_option = $contactOptionModel->where("id", $pr["contact_option_id"])->findAll()) ? $contact_option : [];
            $pr["power_consumption_rating"] = ($power_consumption_rating = $powerConsumptionRatingModel->where("id", $pr["power_consumption_rating_id"])->findAll()) ? $power_consumption_rating : [];
            $pr["reason_for_sale"] = ($reason_for_sale = $reasonForSaleModel->where("id", $pr["reason_for_sale_id"])->findAll()) ? $reason_for_sale : [];
            $pr["facade"] = ($facade = $facadeModel->where("id", $pr["facade_id"])->findAll()) ? $facade : null;
            $pr["videos"] = $videoModel->where("property_id", $pr["id"])->findAll();
            $pr["plant"] = $plantModel->where("id", $pr["plant_id"])->findAll();
            $pr["plaza_capacity"] = $plazaCapacityModel->where("id", $pr["plaza_capacity_id"])->findAll();

            $pr["nearest_municipality_distance"] = $nearestMunicipalityDistanceModel->where("id", $pr["nearest_municipality_distance_id"])->findAll();
            $pr["wheeled_access"] = $wheeledAccessModel->where("id", $pr["wheeled_access_id"])->findAll();
            $pr["type_of_terrain"] = $typeOfTerrainModel->where("id", $pr["type_of_terrain_id"])->findAll();
            $pr["property_address"] = $propertyAddressModel->where("property_id", $pr["id"])->findAll();
            $pr["user"] = $this->userModel->find($pr["user_id"]);
            
            $pr["features"] = [];
            $features = $featuresModel->where("property_id", $pr["id"])->findAll();
            foreach($features as $f){
                $feature = $featureModel->find($f["feature_id"]);
                if ($feature){
                    $pr["features"][] = $feature;
                }
            }

            $pr["equipments"] = [];
            $equipments = $equipmentsModel->where("property_id", $pr["id"])->findAll();
            foreach($equipments as $e){
                $equipment = $equipmentModel->find($e["equipment_id"]);
                if ($equipment){
                    $pr["equipments"][] = $equipment;
                }
            }
            $pr["orientations"] = [];
            $orientations = $orientationsModel->where("property_id", $pr["id"])->findAll();
            foreach($orientations as $o){
                $orientation = $orientationModel->find($o["orientation_id"]);
                if ($orientation){
                    $pr["orientations"][] = $orientation;
                }
            }
            $pr["types_floors"] = [];
            $types_floors = $typesFloorsModel->where("property_id", $pr["id"])->findAll();
            foreach($types_floors as $tf){
                $type_floor = $typeFloorModel->find($tf["type_floor_id"]);
                if ($type_floor){
                    $pr["types_floors"][] = $type_floor;
                }
            }
            
            $updatedProperties[] = $pr;
        }

        $property = $updatedProperties[0];
        
        $psViewsDetailModel = new PsViewsDetailModel();
        $comp_exists = $psViewsDetailModel->where(['property_id' => $property["id"],'ip_address' => $this->request->getIPAddress(),])->first();
        if (empty($comp_exists)){
            $psViewsDetailModel->insert([
                'property_id' => $property["id"],
                'ip_address' => $this->request->getIPAddress(),
                'counter' => 1,
            ]);
        }

        return view('page/details', ["property" => $property]);
    }
    public function resultService($id){
        $userModel = new UserModel();
        $stateModel = new StateModel();
        $userLevelModel = new UserLevelModel();    
        $userAddresModel = new UserAddressModel();
        
        $coverImageModel = new CoverImageModel();
        $moreImagesModel = new MoreImagesModel();
        $videoModel = new VideoModel();
        

        $serviceModel = new ServiceModel();
        $serviceTypeModel = new ServiceTypeModel();
        $serviceTypesModel = new ServiceTypesModel();

        $property = $serviceModel->where("id", $id)->findAll();
        if (empty($property)){
            return redirect()->to('/');
        }

        $updatedProperties = [];
        foreach ($property as $pr) {
            $createdAt = $pr['updated_at'];
            $time = Time::parse($createdAt);
            $pr["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');

    
            $pr["cover_image"] = ($cover_image = $coverImageModel->where("service_id", $pr["id"])->findAll()) ? $cover_image[0] : [];
            $pr["more_images"] = ($more_images = $moreImagesModel->where("service_id", $pr["id"])->findAll()) ? $more_images : [];

            
            $pr["videos"] = $videoModel->where("property_id", $pr["id"])->findAll();
            
            $pr["address"] = $userAddresModel->where("user_id", $pr["user_id"])->findAll();
            $pr["user"] = $this->userModel->find($pr["user_id"]);
            
            $pr["service_types"] = [];
            $service_types = $serviceTypesModel->where("service_id", $pr["id"])->findAll();
            foreach($service_types as $st){
                $service_type = $serviceTypeModel->find($st["service_type_id"]);
                if ($service_type){
                    $pr["service_types"][] = $service_type;
                }
            }
            
            $updatedProperties[] = $pr;
        }

        $property = $updatedProperties[0];
        return view('page/details_service', ["property" => $property]);
    }
    public function login(){
        $userModel = new UserModel();
        if (empty(session()->get('user_id'))){   
            $cookieToken = $_COOKIE['remember_token'] ?? null;
            if ($cookieToken){
                $hashedToken = hash('sha256', $cookieToken);
                $user = $userModel->where("remember_token", $hashedToken)->findAll();
                if (!empty($user)){
                    $user = $user[0];

                    setcookie("remember_token", $hashedToken, time() + (86400 * 30), "/", "", true, true); // cookie por 30 días

                    session()->set('user_id', $user["id"]);
                    session()->set('user_first_name', $user["first_name"]);
                    session()->set('user_last_name', $user["last_name"]);
                    session()->set('user_email', $user["email"]);
                    session()->set('user_level_id', $user["user_level_id"]);
    
                    return redirect()->to('/home');    
                }
            }
            return view('page/login');

        }else{
            return redirect()->to('/home');
        }
    }
    public function loginValidate (){
        $token = $this->request->getPost('recaptcha-response');
        $response_captcha = validateRecaptchaV3($token);
        if (!$response_captcha) {
            return redirect()->back()->with('error', 'CAPTCHA inválido')->withInput();
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember_session = $this->request->getPost("remember_session");

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
        if (!$user || $user['password'] !== $password) {
            return redirect()->back()->with('error', 'Credenciales inválidas.')->withInput();
        }
        if (!empty($remember_session)){
            $token = bin2hex(random_bytes(32)); // genera un token aleatorio
            $tokenHash = hash('sha256', $token);
            setcookie("remember_token", $token, time() + (86400 * 30), "/", "", true, true); // cookie por 30 días
            // Guardas el token en la base de datos
            if (!empty($tokenHash) && !empty($user["id"])) {
                $userModel->set(["remember_token" => $tokenHash])->where("id", $user["id"])->update();
            }else{
                log_message('error', 'No se pudo actualizar remember_token: token o ID vacío');
            }
        }
        session()->set('user_id', $user["id"]);
        session()->set('user_first_name', $user["first_name"]);
        session()->set('user_last_name', $user["last_name"]);
        session()->set('user_email', $user["email"]);
        session()->set('user_level_id', $user["user_level_id"]);

        return redirect()->to('/home');
    }
    public function logout(){
        $userModel = new UserModel();
        $user_id = session()->get("user_id");
        setcookie("remember_token", "", time() - 3600, "/");
        if (!empty($user["id"])) {
            $userModel->set(["remember_token" => null], false)->where("id", $user_id)->update();
        }
        session()->destroy();
        
        return redirect()->to('/login')->with('success', 'Sesión cerrada correctamente.');
    }
    public function resultAll(){
        // SOlo para propiedades
        $categoryModel = new CategoryModel();
        $cityModel = new CityModel();
        $countryModel = new CountryModel();
        $coverImageModel = new CoverImageModel();
        $featureModel = new FeatureModel();
        $propertyModel = new PropertyModel();
        $provinceModel = new ProvinceModel();
        $typeModel = new TypeModel();
        $stateConservationModel = new StateConservationModel();
        $facadeModel = new FacadeModel();
        $nearestMunicipalityDistanceModel = new NearestMunicipalityDistanceModel();
        $wheeledAccessModel = new WheeledAccessModel();
        $typeOfTerrainModel = new TypeOfTerrainModel();
        $propertyAddressModel = new PropertyAddressModel();
        $propertyStatsModel = new PropertyStatsModel();
        
        $mode = $this->request->getGet("mode");
        $address = $this->request->getGet("address");
        $category_id = $this->request->getGet("ca");
        $type_id = $this->request->getGet("ty");
        $p_min = $this->request->getGet("p_min");
        $p_max = $this->request->getGet("p_max");
        $built_min = $this->request->getGet("built_min");
        $built_max = $this->request->getGet("built_max");
        $num_min_bathrooms = $this->request->getGet("n_bar");
        $num_min_bedrooms = $this->request->getGet("n_ber");

        $city = $this->request->getGet("city");
        $province = $this->request->getGet("province");
        $latitude = $this->request->getGet("latitude");
        $longitude = $this->request->getGet("longitude");
        $zoom = $this->request->getGet("zoom");
        
        $properties = $propertyModel->where("state_id", 4);
        if (!empty($city) || !empty($province)){
            $propertyAddressAll = $propertyAddressModel;
            if (!empty($province) && empty($city)){
                $propertyAddressAll = $propertyAddressAll->where("province", trim($province));    
            }else if (!empty($city)){
                $propertyAddressAll = $propertyAddressAll->where("city", trim($city));    
            }
            $propertyAddressAll = $propertyAddressAll->findColumn("property_id");
            $ids = array_map("intval", $propertyAddressAll);
            if (!empty($ids)){
                $properties = $properties->whereIn("id", $ids);
            }else{
                $properties = $properties->where("id", 0);
            }
        }else if (!empty($address)){
            $address_max = explode(",", $address);
            $propertyAddressAll = $propertyAddressModel->like("address", trim($address))->orLike("address", trim($address_max[0]))->orLike("province", trim($address_max[0]))->orLike("city", trim($address_max[0]))->findColumn("property_id");
            $ids = array_map("intval", $propertyAddressAll);
            if (!empty($ids)){
                $properties = $properties->whereIn("id", $ids);
            }else{
                $properties = $properties->where("id", 0);
            }
        }else{
            $propertyAddressAll = $propertyAddressModel->like("address", "barcelona")->orLike("address", "barcelona")->orLike("province", "barcelona")->orLike("city", "barcelona")->findColumn("property_id");
            $ids = array_map("intval", $propertyAddressAll);
            if (!empty($ids)){
                $properties = $properties->whereIn("id", $ids);
            }else{
                $properties = $properties->where("id", 0);
            }
        }
        // $properties = $propertyModel;
        if (!empty($category_id)){
            $properties = $properties->where("category_id", $category_id);
            $priceField = ($category_id == 1) ? "rental_price" : "sale_price";
            if (!empty($p_min)) {
                $properties = $properties->where("$priceField >=", $p_min);
            }
            if (!empty($p_max)) {
                $properties = $properties->where("$priceField <=", $p_max);
            }
        }else{
            if (!empty($p_min)){
                $properties = $properties->groupStart()->where("sale_price >=", $p_min)->orWhere("rental_price >=", $p_min)->groupEnd();
            }
            if (!empty($p_max)){
                $properties = $properties->groupStart()->where("sale_price <=", $p_max)->orWhere("rental_price <=", $p_max)->groupEnd();
            }
        }
        if (!empty($num_min_bathrooms)){
            $properties = $properties->where("bathrooms >=", $num_min_bathrooms);
        }
        if (!empty($num_min_bedrooms)){
            $properties = $properties->where("bedrooms >=", $num_min_bedrooms);
        }
        if (!empty($built_min)){
            $properties = $properties->where("meters_built >=", $built_min);
        }
        if (!empty($built_max)){
            $properties = $properties->where("meters_built <=", $built_max);
        }
        if (!empty($type_id)){
            $properties = $properties->where("type_id", $type_id);
        }
        $quantity_data_view = 15;
        $number_position = !empty($this->request->getGet("page")) ? $this->request->getGet("page") : 1;
        $properties = $properties->orderBy('id', 'DESC')->findAll();
        $quantity_block_nav = round(count($properties)/$quantity_data_view); # 4 es el numero de datos que se van a mostrar
        
        $properties = array_slice($properties, ($quantity_data_view * $number_position) - $quantity_data_view, $quantity_data_view);
        $quantity = count($properties);

         // Conteo por provincia
        $provinces = $propertyAddressModel
            ->select("property_address.province, COUNT(*) as total")
                
            ->join('property', 'property.id = property_address.property_id')
            ->where('property.state_id', 4)

            ->groupBy("property_address.province")
            ->orderBy("total", "DESC")
            ->findAll();

        // Conteo por ciudad
        $cities = $propertyAddressModel
            ->select("property_address.city, COUNT(*) as total")
            ->join('property', 'property.id = property_address.property_id')
            ->where('property.state_id', 4)
            ->groupBy("property_address.city")
            ->orderBy("total", "DESC")
            ->findAll();

        // Conteo de ciudades dentro de cada provincia
        $provinceCitiesList = $propertyAddressModel
            ->select("property_address.province, property_address.city, COUNT(*) as total")
                
            ->join('property', 'property.id = property_address.property_id')
            ->where('property.state_id', 4)

            ->groupBy("property_address.province, property_address.city")
            ->orderBy("property_address.province", "ASC")
            ->orderBy("total", "DESC")
            ->findAll();
        $provinceCities = [];
        foreach ($provinceCitiesList as $row) {
            $province_temp = $row['province'];
            $cityData = [
                "city" => $row['city'],
                "total" => $row['total']
            ];
            $provinceCities[$province_temp][] = $cityData;
        }

        $updatedProperties = [];
        foreach ($properties as $pr) {
            $createdAt = $pr['updated_at'];
            $time = Time::parse($createdAt);
            $pr["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $pr["type_name"] = ($type = $typeModel->find([$pr["type_id"]])) ? $type[0]["name"] : "";
            $pr["category_name"] = ($category = $categoryModel->find([$pr["category_id"]])) ? $category[0]["name"] : "";
            $pr["cover_image"] = ($cover_image = $coverImageModel->where("property_id", $pr["id"])->findAll()) ? $cover_image[0] : ["url" => ""];
            $pr["user_name"] = $this->userModel->find($pr["user_id"])["user_name"];
            $pr["state_conservation"] = $stateConservationModel->where("id", $pr["state_conservation_id"])->findAll();
            $pr["facade"] = $facadeModel->where("id", $pr["facade_id"])->findAll();
            $pr["nearest_municipality_distance"] = $nearestMunicipalityDistanceModel->where("id", $pr["nearest_municipality_distance_id"])->findAll();
            $pr["type_of_terrain"] = $typeOfTerrainModel->where("id", $pr["type_of_terrain_id"])->findAll();
            $pr["wheeled_access"] = $wheeledAccessModel->where("id", $pr["wheeled_access_id"])->findAll();
            
            $updatedProperties[] = $pr;

            $psViewsSearchModel = new PsViewsSearchModel();
            $comp_exists = $psViewsSearchModel->where(['property_id' => $pr["id"],'ip_address' => $this->request->getIPAddress(),])->first();
            if (empty($comp_exists)){
                $psViewsSearchModel->insert([
                    'property_id' => $pr["id"],
                    'ip_address' => $this->request->getIPAddress(),
                    'counter' => 1,
                ]);
            }
        }
        $type = $typeModel->findAll();
        $properties = $updatedProperties;
        return view('page/result_all', [
            "number_position" => $number_position,
            "quantity_block_nav" => $quantity_block_nav,
            "properties" => $properties, 
            "quantity" => $quantity, 
            "address" => $address, 
            "type_id" => $type_id, 
            "category_id" => $category_id,
            "p_max" => $p_max,
            "p_min" => $p_min,
            "built_min" => $built_min,
            "built_max" => $built_max,
            "n_ber" => $num_min_bedrooms,
            "n_bar" => $num_min_bathrooms,
            "mode" => $mode,
            "provinces" => $provinces,
            "cities" => $cities,
            "provinceCities" => $provinceCities,
            "city" => $city,
            "province" => $province,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "zoom" => $zoom,
        ]);
    }
    public function resultAllServices(){
        // SOlo para servicios
        
        $userModel = new UserModel();
        $coverImageModel = new CoverImageModel();
        $propertyModel = new PropertyModel();
        $typeModel = new TypeModel();
        $serviceModel = new ServiceModel();
        $userAddressModel = new UserAddressModel();
        $serviceTypeModel = new ServiceTypeModel();
        $serviceTypesModel = new ServiceTypesModel();
        
        $sti = $this->request->getGet("sti");
        $mode = $this->request->getGet("mode");
        $address = $this->request->getGet("address");

        $city = $this->request->getGet("city");
        $province = $this->request->getGet("province");
        $latitude = $this->request->getGet("latitude");
        $longitude = $this->request->getGet("longitude");
        $zoom = $this->request->getGet("zoom");

        $service_types = [];
        
        if (!empty($sti)){
            if (is_array($sti)){
                $sti = array_map("intval", $sti);
            }else{
                $sti = [intval($sti)];
            }
            $service_types = $serviceTypesModel->whereIn("service_type_id", $sti)->findColumn("service_id");
        }
        // foreach($serviceTypes as $service_id){
        //     $cover_image = $coverImageModel->where("service_id", $service_id)->findAll();
        //     $service = $serviceModel->find($service_id);
        //     $user_id_temp = $service["user_id"];
        //     $user = $userModel->find($user_id_temp);

        // }
        

        $properties = $serviceModel;
        if (!empty($service_types)){
            $properties = $properties->whereIn("id", array_map("intval", $service_types));
        }
        if (!empty($city) || !empty($province)){
            $userAddressAll = $userAddressModel;
            if (!empty($province) && empty($city)){
                $userAddressAll = $userAddressAll->where("province", trim($province));    
            }else if (!empty($city)){
                $userAddressAll = $userAddressAll->where("city", trim($city));    
            }
            $userAddressAll = $userAddressAll->findColumn("user_id");
            $ids = array_map("intval", $userAddressAll);
            if (!empty($ids)){
                $properties = $properties->whereIn("user_id", $ids);
            }else{
                $properties = $properties->where("user_id", 0);
            }
        }else if (!empty($address)){
            $address_max = explode(",", $address);
            $userAddressAll = $userAddressModel->like("address", trim($address))->orLike("address", trim($address_max[0]))->orLike("province", trim($address_max[0]))->orLike("city", trim($address_max[0]))->findColumn("user_id");
            $ids = array_map("intval", $userAddressAll);
            if (!empty($ids)){
                $properties = $properties->whereIn("user_id", $ids);
            }else{
                $properties = $properties->where("user_id", 0);
            }
        }else{
            $userAddressAll = $userAddressModel->like("address", "barcelona")->orLike("address", "barcelona")->orLike("province", "barcelona")->orLike("city", "barcelona")->findColumn("user_id");
            $ids = array_map("intval", $userAddressAll);
            if (!empty($ids)){
                $properties = $properties->whereIn("user_id", $ids);
            }else{
                $properties = $properties->where("user_id", 0);
            }
        }

        $quantity_data_view = 15;
        $number_position = !empty($this->request->getGet("page")) ? $this->request->getGet("page") : 1;
        $properties = $properties->orderBy('id', 'DESC')->findAll();
        $quantity_block_nav = round(count($properties)/$quantity_data_view); # 4 es el numero de datos que se van a mostrar
        $properties = array_slice($properties, ($quantity_data_view * $number_position) - $quantity_data_view, $quantity_data_view);
        
        $quantity = count($properties);

         // Conteo por provincia
         $provinces = $userAddressModel
            ->select("province, COUNT(*) as total")
            ->groupBy("province")
            ->orderBy("total", "DESC")
            ->findAll();

        // Conteo por ciudad
        $cities = $userAddressModel
            ->select("city, COUNT(*) as total")
            ->groupBy("city")
            ->orderBy("total", "DESC")
            ->findAll();

        // Conteo de ciudades dentro de cada provincia
        $provinceCitiesList = $userAddressModel
            ->select("province, city, COUNT(*) as total")
            ->groupBy("province, city")
            ->orderBy("province", "ASC")
            ->orderBy("total", "DESC")
            ->findAll();
        $provinceCities = [];
        foreach ($provinceCitiesList as $row) {
            $province_temp = $row['province'];
            $cityData = [
                "city" => $row['city'],
                "total" => $row['total']
            ];
            $provinceCities[$province_temp][] = $cityData;
        }

        $updatedProperties = [];
        foreach ($properties as $pr) {
            $createdAt = $pr['updated_at'];
            $time = Time::parse($createdAt);
            $pr["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $pr["cover_image"] = ($cover_image = $coverImageModel->where("service_id", $pr["id"])->findAll()) ? $cover_image[0] : ["url" => ""];
            $pr["user"] = $this->userModel->where("id",$pr["user_id"])->findAll();
            $pr["user_address"] = $userAddressModel->where("user_id", $pr["user_id"])->findAll();
            $serviceTypes = $serviceTypesModel->where("service_id", $pr["id"])->findColumn("service_type_id");
            $ids = array_map("intval", $serviceTypes);
            if (!empty($ids)){
                $pr["service_types"] = $serviceTypeModel->whereIn("id", $ids)->findAll();
            }else{
                $pr["service_types"] = array();
            }
   
            $updatedProperties[] = $pr;
        }
        $service_type = $serviceTypeModel->findAll();
        $properties = $updatedProperties;
        return view('page/result_all_service', [
            "service_type" => $service_type,
            "number_position" => $number_position,
            "quantity_block_nav" => $quantity_block_nav,
            "properties" => $properties, 
            "quantity" => $quantity, 
            "address" => $address, 
            "mode" => $mode,
            "provinces" => $provinces,
            "cities" => $cities,
            "provinceCities" => $provinceCities,
            "city" => $city,
            "province" => $province,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "zoom" => $zoom,
            "sti" => $sti,
        ]);
    }
    public function signup (){
        $userAddresModel = new UserAddressModel();
        $token = $this->request->getPost('recaptcha-response');
        $response_captcha = validateRecaptchaV3($token);
        if (!$response_captcha) {
            return redirect()->back()->with('error', 'CAPTCHA inválido')->withInput();
        }
        helper("email");
        $document_type = $this->request->getPost("document_type");
        $document_number = $this->request->getPost("document_number");
        $address = $this->request->getPost("address");
        $first_name = $this->request->getPost("first_name");
        $last_name = $this->request->getPost("last_name");
        $phone = $this->request->getPost("phone");
        $landline_phone = $this->request->getPost("landline_phone");
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $user_level = $this->request->getPost("user_level");

        // user_address
        $address = $this->request->getPost("address");
        $city = $this->request->getPost("city");
        $postal_code = $this->request->getPost("postal_code");
        $province = $this->request->getPost("province");
        $country = $this->request->getPost("country");
        $latitude = $this->request->getPost("latitude");
        $longitude = $this->request->getPost("longitude");
        
        $codigo = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT); 
        $user_temp = $this->userModel->where("email", $email)->findAll();
        if (!empty($user_temp)){
            return redirect()->to('/login')->with('error', 'El correo '. $email .' ya está en uso.');
        }
        
        // $message_html_model = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cuenta Creada</title><style>
        //                         body {font-family: Arial, sans-serif;background-color:#f4f4f4;margin: 0;padding: 20px;}a{color:#ffffff;}.container {max-width: 600px;background:#ffffff;padding: 20px;border-radius: 8px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);text-align: center;margin: auto;}h2 {color: #333;}p {color: #666;font-size: 16px;}.info {background: #eee;padding: 10px;border-radius: 5px;display: inline-block;margin: 10px 0;justify-content:start;}.btn {display: inline-block;background:#007bff;color: #fff;text-decoration: none;padding: 10px 20px;border-radius: 5px;font-size: 16px;margin-top: 20px;}.btn:hover {background:#0056b3;}.footer {margin-top: 20px;font-size: 12px;color: #999;}</style></head><body><div class="container"><h2>🎉 ¡Tu cuenta ha sido creada con éxito! 🎉</h2>
        //                         <p>Hola <strong>'.$first_name. " ".$last_name.'</strong></p><p>Te damos la bienvenida a <strong>Dámelo Dámelo</strong>. Tu cuenta ha sido creada y ya puedes acceder.</p><div class="info">
        //                         <p style="text-align: start;"><strong>Correo electrónico:</strong> '.$email.'</p>
        //                         <p style="text-align: start;"><strong>Contraseña:</strong> '.$password.'</p></div><p>Para iniciar sesión, haz clic en el siguiente botón:</p>
        //                         <a href="https://damelodamelo.com/login" target="_blank" style="color:#ffffff;" class="btn">Iniciar Sesión</a><p class="footer">Si no solicitaste esta cuenta, ignora este mensaje.</p></div></body></html>';
        
        $message_email_code_verify = '<!DOCTYPE html>'.
            '<html lang="es"><head><meta charset="UTF-8"><title>Verificación de Código - Dámelo Dámelo</title><style>body {font-family: "Segoe UI", sans-serif;background-color: #f4f4f4;margin: 0;padding: 20px;}.email-container {max-width: 500px;margin: auto;background-color: #ffffff;border-radius: 10px;padding: 30px;box-shadow: 0 4px 12px rgba(0,0,0,0.1);text-align: center;}.logo {margin-bottom: 20px;}.logo img {max-width: 150px;}h1 {color: #333;font-size: 24px;}p {color: #555;font-size: 16px;margin-bottom: 30px;}.code {display: inline-block;background-color: #007BFF;color: white;font-size: 28px;padding: 12px 24px;border-radius: 8px;letter-spacing: 5px;font-weight: bold;}.footer {margin-top: 30px;font-size: 13px;color: #999;}@media only screen and (max-width: 600px) {.email-container {padding: 20px;}'.
              '.code {font-size: 24px;padding: 10px 20px;}}</style></head><body><div class="email-container"><div class="logo">'.
            '</div><h1>Tu código de verificación</h1><p>Hola, gracias por confiar en <strong>damelodamelo.com</strong>. Para continuar, por favor ingresa el siguiente código en el formulario:</p>'.
            '<div class="code">'.$codigo.'</div><p>Este código expira en 10 minutos.</p><div class="footer">© 2025 Dámelo Dámelo · Todos los derechos reservados</div></div></body></html>';

        sendEmail($email, "Código de verificación", $message_email_code_verify);
        
        session()->set('code_verif', $codigo);
        session()->set('user_document_type', $document_type);
        session()->set('user_document_number', $document_number);
        session()->set('user_address', $address);
        session()->set('user_first_name', $first_name);
        session()->set('user_last_name', $last_name);
        session()->set('user_phone', $phone);
        session()->set('user_landline_phone', $landline_phone);
        session()->set('user_email', $email);
        session()->set('user_password', $password);
        session()->set('user_level_id', $user_level);

        session()->set('user_city', $city);
        session()->set('user_postal_code', $postal_code);
        session()->set('user_province', $province);
        session()->set('user_country', $country);
        session()->set('user_latitude', $latitude);
        session()->set('user_longitude', $longitude);

        return redirect()->to('/validate_account');
    }
    public function resultMaps(){
        return view("page/result_maps");
    }
    public function validateAccount(){
        $userAddresModel = new UserAddressModel();
        $code_1 = $this->request->getPost("code_1");
        $code_2 = $this->request->getPost("code_2");
        $code_3 = $this->request->getPost("code_3");
        $code_4 = $this->request->getPost("code_4");
        $code_front = $code_1.$code_2.$code_3.$code_4;
        $code_verif = session()->get("code_verif");

        if ($code_front != $code_verif){
            return redirect()->back()->with('error', 'Código de verificación incorrecto')->withInput();
        }

        $document_type = session()->get('user_document_type');
        $document_number = session()->get('user_document_number');
        $address = session()->get('user_address');
        $first_name = session()->get("user_first_name");
        $last_name = session()->get("user_last_name");
        $phone = session()->get("user_phone");
        $landline_phone = session()->get('user_landline_phone');
        $email = session()->get("user_email");
        $password = session()->get("user_password");
        $user_level = session()->get("user_level_id");

        $city = session()->get('user_city');
        $postal_code = session()->get('user_postal_code');
        $province = session()->get('user_province');
        $country = session()->get('user_country');
        $latitude = session()->get('user_latitude');
        $longitude = session()->get('user_longitude');
        $remember_token = null;
        
        $token = bin2hex(random_bytes(32)); // genera un token aleatorio
        $tokenHash = hash('sha256', $token);
        setcookie("remember_token", $token, time() + (86400 * 30), "/", "", true, true); // cookie por 30 días
        // Guardas el token en la base de datos
        $remember_token = $tokenHash;
    
        $user_id = $this->userModel->insert([
            "document_type" => $document_type,
            "document_number" => $document_number,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "address" => $address,
            "phone" => $phone,
            "landline_phone" => $landline_phone,
            "email" => $email,
            "password" => $password,
            "user_level_id" => $user_level,
            "remember_token" => $remember_token,
        ]);

        $userAddresModel->insert([
            "user_id" => $user_id,
            "address" => $address,
            "city" => $city,
            "province" => $province,
            "postal_code" => $postal_code,
            "country" => $country,
            "latitude" => $latitude,
            "longitude" => $longitude,  
        ]);

        session()->set('user_id', $user_id);
        session()->set('user_first_name', $first_name);
        session()->set('user_last_name', $last_name);
        session()->set('user_email', $email);
        session()->set('user_level_id', $user_level);
        
        return redirect()->to('/home');
    }

    public function validateAccountPage(){
        return view("page/validate_account.php");
    }

    public function PolicyAndPrivacy(){
        return view("page/policy_and_privacy.php");
    }
}
