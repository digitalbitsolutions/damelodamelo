<?php

namespace App\Controllers;
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
use App\Models\TypeHeatingModel;
use App\Models\EmissionsRatingModel;
use App\Models\EnergyClassModel;
use App\Models\StateConservationModel;
use App\Models\VisibilityInPortalsModel;
use App\Models\RentalTypeModel;
use App\Models\ContactOptionModel;
use App\Models\PowerConsumptionRatingModel;
use App\Models\ReasonForSaleModel;
use App\Models\PlantModel;
use App\Models\DoorModel;
use App\Models\TypeFloorModel;
use App\Models\TypesFloorsModel;
use App\Models\OrientationsModel;
use App\Models\FacadeModel;
use App\Models\EquipmentModel;
use App\Models\EquipmentsModel;
use App\Models\PlazaCapacityModel;

use App\Models\TypeOfTerrainModel;
use App\Models\WheeledAccessModel;
use App\Models\NearestMunicipalityDistanceModel;
use App\Models\VideoModel;

use App\Models\ServiceModel;
use App\Models\LocationActionModel;
use App\Models\LocationsActionModel;
use App\Models\ServiceTypeModel;
use App\Models\ServiceTypesModel;
use App\Models\HeatingFuelModel;
use App\Models\PropertyAddressModel;
use App\Models\LocationPremisesModel;
use App\Models\GaragePriceCategoryModel;
use App\Models\FavoriteModel;
use App\Models\ServiceAddressModel;
use App\Models\UserAddressModel;
use App\Models\UserFreeModel;

use App\Models\PsEmailOwnerModel;
use App\Models\PsLinkCopiedModel;
use App\Models\PsOwnerCallsModel;
use App\Models\PsSavedFavoriteModel;
use App\Models\PsSharedFacebookModel;
use App\Models\PsSharedFriendsModel;
use App\Models\PsViewsDetailModel;
use App\Models\PsViewsSearchModel;
use App\Models\PsWhatsappClicksModel;
use App\Models\PsMessagesReceivedModel;

use App\Libraries\Auth;
use App\Models\PropertyStatsModel;
use CodeIgniter\Config\Services;

class PostController extends BaseController{
    protected $countryModel;
    protected $cityModel;
    protected $categoryModel;
    protected $heatingFuelModel;
    protected $propertyAddressModel;
    protected $locationPremisesModel;
    protected $garagePriceCategoryModel;

    protected $coverImageModel;
    protected $featureModel;
    protected $featuresModel;
    protected $moreImagesModel;
    protected $propertyModel;
    protected $provinceModel;
    protected $stateModel;
    protected $typeModel;
    protected $userLevelModel;
    protected $userModel;
    protected $typologyModel;
    protected $orientationModel;
    protected $typeHeatingModel;
    protected $emissionsRatingModel;
    protected $energyClassModel;
    protected $stateConservationModel;
    protected $visibilityInPortalsModel;
    protected $rentalTypeModel;
    protected $contactOptionModel;
    protected $powerConsumptionRatingModel;
    protected $reasonForSaleModel;
    protected $plantModel;
    protected $doorModel;
    protected $typeFloorModel;
    protected $typesFloorsModel;
    protected $orientationsModel;
    protected $facadeModel;
    protected $equipmentModel;
    protected $equipmentsModel;
    protected $plazaCapacityModel;
    protected $typeOfTerrainModel;
    protected $wheeledAccessModel;
    protected $nearestMunicipalityDistanceModel;
    protected $videoModel;
    protected $serviceModel;
    protected $locationActionModel;
    protected $locationsActionModel;
    protected $serviceTypeModel;
    protected $serviceTypesModel;
    
    protected $auth;
    public function __construct(){
        $this->serviceTypesModel = new ServiceTypesModel();
        $this->serviceTypeModel = new ServiceTypeModel();
        $this->locationsActionModel = new LocationsActionModel();
        $this->locationActionModel = new LocationActionModel();
        $this->serviceModel = new ServiceModel();
        $this->videoModel = new VideoModel();
        $this->nearestMunicipalityDistanceModel = new NearestMunicipalityDistanceModel();
        $this->wheeledAccessModel = new WheeledAccessModel();
        $this->typeOfTerrainModel = new TypeOfTerrainModel();
        $this->plazaCapacityModel = new PlazaCapacityModel();
        $this->equipmentsModel = new EquipmentsModel();
        $this->equipmentModel = new EquipmentModel();
        $this->facadeModel = new FacadeModel();
        $this->orientationsModel = new OrientationsModel();
        $this->typesFloorsModel = new TypesFloorsModel();
        $this->typeFloorModel = new TypeFloorModel();
        $this->doorModel = new DoorModel();
        $this->plantModel = new PlantModel();
        $this->reasonForSaleModel = new ReasonForSaleModel();
        $this->powerConsumptionRatingModel = new PowerConsumptionRatingModel();
        $this->contactOptionModel = new ContactOptionModel();
        $this->rentalTypeModel = new RentalTypeModel();
        $this->visibilityInPortalsModel = new VisibilityInPortalsModel();
        $this->stateConservationModel = new StateConservationModel();
        $this->energyClassModel = new EnergyClassModel();
        $this->emissionsRatingModel = new EmissionsRatingModel();
        $this->typeHeatingModel = new TypeHeatingModel();
        $this->orientationModel = new OrientationModel();
        $this->typologyModel = new TypologyModel();
        $this->userModel = new UserModel();
        $this->userLevelModel = new UserLevelModel();
        $this->typeModel = new TypeModel();
        $this->stateModel = new StateModel();
        $this->provinceModel = new ProvinceModel();
        $this->propertyModel = new PropertyModel();
        $this->moreImagesModel = new MoreImagesModel();
        $this->featuresModel = new FeaturesModel();
        $this->featureModel = new FeatureModel();
        $this->coverImageModel = new CoverImageModel();
        $this->countryModel = new CountryModel();
        $this->cityModel = new CityModel();
        $this->categoryModel = new CategoryModel();
        $this->heatingFuelModel = new HeatingFuelModel();
        $this->propertyAddressModel = new PropertyAddressModel();
        $this->locationPremisesModel = new LocationPremisesModel();
        $this->garagePriceCategoryModel = new GaragePriceCategoryModel();
        $this->auth = new Auth();
    }
    public function index(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $userModel = new UserModel();
        $typeModel = new TypeModel();

        $type = $typeModel->findAll();
        
        return view('app/create_start', [
                                        "type" => $type,
            ]);
    }
    public function createForm($id){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();
        $cityModel = new CityModel();
        $countryModel = new CountryModel();
        $coverImageModel = new CoverImageModel();
        $featureModel = new FeatureModel();
        $featuresModel = new FeaturesModel();
        $moreImagesModel = new MoreImagesModel();
        $propertyModel = new PropertyModel();
        $provinceModel = new ProvinceModel();
        $stateModel = new StateModel();
        $typeModel = new TypeModel();
        $userLevelModel = new UserLevelModel();
        $typologyModel = new TypologyModel();
        $orientationModel = new OrientationModel();
        $typeHeatingModel = new TypeHeatingModel();
        $emissionsRatingModel = new EmissionsRatingModel();
        $energyClassModel = new EnergyClassModel();
        $stateConservationModel = new StateConservationModel();
        $visibilityInPortalsModel = new VisibilityInPortalsModel();
        $rentalTypeModel = new RentalTypeModel();
        $contactOptionModel = new ContactOptionModel();
        $powerConsumptionRatingModel = new PowerConsumptionRatingModel();
        $reasonForSaleModel = new ReasonForSaleModel();
        $plantModel = new PlantModel();
        $doorModel = new DoorModel();
        $typeFloorModel = new TypeFloorModel();
        $typesFloorsModel = new TypesFloorsModel();
        $facadeModel = new FacadeModel();
        $equipmentModel = new EquipmentModel();
        $plazaCapacityModel = new PlazaCapacityModel();
        $typeOfTerrainModel = new TypeOfTerrainModel();
        $wheeledAccessModel = new WheeledAccessModel();
        $nearestMunicipalityDistanceModel = new NearestMunicipalityDistanceModel();
        $serviceTypeModel = new ServiceTypeModel();
        $locationActionModel = new LocationActionModel();

        $category = $categoryModel->findAll();
        $city = $cityModel->findAll();
        $country = $countryModel->findAll();
        $coverImage = $coverImageModel->findAll();
        $feature = $featureModel->findAll();
        $features = $featuresModel->findAll();
        $moreImages = $moreImagesModel->findAll();
        $property = $propertyModel->findAll();
        $province = $provinceModel->findAll();
        $state = $stateModel->findAll();
        $type = $typeModel->findAll();
        $user = $userModel->findAll();
        $userLevel = $userLevelModel->findAll();
        $typology = $typologyModel->where("type_id", 1)->findAll();
        $orientation = $orientationModel->findAll();
        $typeHeating = $typeHeatingModel->findAll();
        $emissionsRating = $emissionsRatingModel->findAll();
        $energyClass = $energyClassModel->findAll();
        $stateConservation = $stateConservationModel->findAll();
        $visibilityInPortals = $visibilityInPortalsModel->findAll();
        $rentalType = $rentalTypeModel->findAll();
        $contactOption = $contactOptionModel->findAll();
        $powerConsumptionRating = $powerConsumptionRatingModel->findAll();
        $reasonForSale = $reasonForSaleModel->findAll();

        $plant = $plantModel->findAll();
        $door = $doorModel->findAll();
        $typeFloor = $typeFloorModel->findAll();
        $facade = $facadeModel->findAll();
        $equipment = $equipmentModel->findAll();
        $plazaCapacity = $plazaCapacityModel->findAll();
        $typeOfTerrain = $typeOfTerrainModel->findAll();
        $wheeledAccess = $wheeledAccessModel->findAll();
        $nearestMunicipalityDistance = $nearestMunicipalityDistanceModel->findAll();
        $serviceType = $serviceTypeModel->findAll();
        $locationAction = $locationActionModel->findAll();
        $heatingFuel = $this->heatingFuelModel->findAll();
        $locationPremises = $this->locationPremisesModel->findAll();
        $garagePriceCategory = $this->garagePriceCategoryModel->findAll();

        $form_name = "";
        
        if ($id == 1){
            $equipment = $equipmentModel->where("type_id", 1)->findAll();
            $form_name = "form_1";
        }else if ($id == 13){
            $equipment = $equipmentModel->where("type_id", 1)->findAll();
            $form_name = "form_2";
        }else if ($id == 4){
            $equipment = $equipmentModel->where("type_id", $id)->findAll();
            $form_name = "form_3";
        }else if ($id == 14){
            $feature = $featureModel->where("id_type", 14)->findAll();
            $equipment = $equipmentModel->where("type_id", 14)->findAll();
            $form_name = "form_4";
        }else if ($id == 9){
            $equipment = $equipmentModel->where("type_id", 4)->findAll();
            $form_name = "form_5";
        }else if ($id == "service"){
            // $form_data = ["serviceType" => $serviceType, "locationAction" => $locationAction];
            $form_name = "form_service";
        }else if ($id == 15){
            $typology = $typologyModel->where("type_id", 15)->findAll();
            // $form_data = ["serviceType" => $serviceType, "locationAction" => $locationAction];
            $typology = $typologyModel->where("type_id", 15)->findAll();
            $form_name = "form_casa_rustica";
        }else if ($id == 16){
            // $typology = $typologyModel->where("type_id", 15)->findAll();
            // $form_data = ["serviceType" => $serviceType, "locationAction" => $locationAction];
            // $typology = $typologyModel->where("type_id", 15)->findAll();
            $form_name = "form_casa_rustica_2";
        }else{
            session()->setFlashdata('error', "Ocurrió un error");
            return redirect()->to(base_url('post/index'));
            
        }
        $form_data = [
            "serviceType" => $serviceType, "locationAction" => $locationAction,
            "locationPremises" => $locationPremises,
            "heatingFuel" => $heatingFuel,
            "category" => $category,
            "city" => $city, 
            "country" => $country,
            "coverImage" => $coverImage,
            "feature" => $feature,
            "features" => $features,
            "moreImages" => $moreImages,
            "property" => $property,
            "province" => $province,
            "state" => $state,
            "type" => $type,
            "user" => $user,
            "userLevel" => $userLevel, 
            "typology" => $typology,
            "orientation" => $orientation,
            "typeHeating" => $typeHeating,
            "emissionsRating" => $emissionsRating,
            "energyClass" => $energyClass,
            "stateConservation" => $stateConservation,
            "visibilityInPortals" => $visibilityInPortals,
            "rentalType" => $rentalType,
            "contactOption" => $contactOption,
            "powerConsumptionRating" => $powerConsumptionRating,
            "reasonForSale" => $reasonForSale,
            "plant" => $plant,
            "door" => $door,
            "typeFloor" => $typeFloor,
            "facade" => $facade,
            "equipment" => $equipment,
            "plazaCapacity" => $plazaCapacity,
            "typeOfTerrain" => $typeOfTerrain,
            "wheeledAccess" => $wheeledAccess,
            "nearestMunicipalityDistance" => $nearestMunicipalityDistance,
            "garagePriceCategory" => $garagePriceCategory,
        ];
        return view('app/'. $form_name, $form_data);
    }

    public function create(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        helper('refer');
        helper("email");
        $propertyModel = new PropertyModel();
        $coverImageModel = new CoverImageModel();        
        $moreImagesModel = new MoreImagesModel();
        $videoModel = new VideoModel();
        $user_id = session()->get("user_id");
        $featuresModel = new FeaturesModel();
        $typesFloorsModel = new TypesFloorsModel();
        $orientationsModel = new OrientationsModel();
        $equipmentModel = new EquipmentModel();
        $equipmentsModel = new EquipmentsModel();
        $typeModel = new TypeModel();
        
        $reference = generateUniqueReference($propertyModel);
        $data_for_db = ["user_id" => $user_id, "state_id" => 4, "reference" => $reference];
        
        $type_id = $this->request->getPost("type");
        $locality = $this->request->getPost("locality");
        $number = $this->request->getPost("number");
        $esc_block = $this->request->getPost("esc_block");
        $door = $this->request->getPost("door");
        $name_urbanization = $this->request->getPost("name_urbanization");
        $visibility_in_portals_id = $this->request->getPost("visibility_in_portals");
        $typology_id = $this->request->getPost("typology");
        $plot_meters = $this->request->getPost("plot_meters");
        $number_of_plants = $this->request->getPost("number_of_plants");
        $energy_class_id = $this->request->getPost("energy_class");
        $energy_consumption = $this->request->getPost("energy_consumption");
        $emissions_rating_id = $this->request->getPost("emissions_rating");
        $emissions_consumption = $this->request->getPost("emissions_consumption");
        $state_conservation_id = $this->request->getPost("state_conservation");
        $orientation = $this->request->getPost("orientation");
        $outdoor_wheelchair = $this->request->getPost("outdoor_wheelchair");
        $interior_wheelchair = $this->request->getPost("interior_wheelchair");
        $type_heating_id = $this->request->getPost("type_heating");
        $page_url = $this->request->getPost("page_url");
        $title = $this->request->getPost("title");
        $description = $this->request->getPost("description");
        $category_id = $this->request->getPost("category");
        $meters_built = $this->request->getPost("meters_built");
        $useful_meters = $this->request->getPost("useful_meters");
        $sale_price = $this->request->getPost("sale_price");
        $rental_price = $this->request->getPost("rental_price");
        $community_expenses = $this->request->getPost("community_expenses");
        $year_of_construction = $this->request->getPost("year_of_construction");
        $bedrooms = $this->request->getPost("bedrooms");
        $bathrooms = $this->request->getPost("bathrooms");
        $parking = $this->request->getPost("parking");
        $feature = $this->request->getPost("feature");
        $country_id = $this->request->getPost("country");
        $city_id = $this->request->getPost("city");
        $province_id = $this->request->getPost("province");
        $address = $this->request->getPost("address");
        $close_to = $this->request->getPost("close_to");
        $zip_code = $this->request->getPost("zip_code");
        $cover_image = $this->request->getFile("cover_image");
        $more_images = $this->request->getFileMultiple("more_images");
        $video = $this->request->getFile("video");
        $sale_price = $this->request->getPost("sale_price");
        $rental_price = $this->request->getPost("rental_price");
        $rental_type_id = $this->request->getPost("rental_type");
        $contact_option_id = $this->request->getPost("contact_option");
        $power_consumption_rating_id = $this->request->getPost("power_consumption_rating");
        $reason_for_sale_id = $this->request->getPost("reason_for_sale");

        $rooms = $this->request->getPost("rooms");
        $elevator = $this->request->getPost("elevator");
        $plant_id = $this->request->getPost("plant");
        $door_id = $this->request->getPost("door");
        $type_floor = $this->request->getPost("type_floor");
        
        $appropriate_for_children = $this->request->getPost("appropriate_for_children");
        $pet_friendly = $this->request->getPost("pet_friendly");
        $max_num_tenants = $this->request->getPost("max_num_tenants");
        $bank_owned_property = $this->request->getPost("bank_owned_property");
        $guarantee = $this->request->getPost("guarantee");
        $ibi = $this->request->getPost("ibi");
        $mortgage_rate = $this->request->getPost("mortgage_rate");
        $wheelchair_accessible_elevator = $this->request->getPost("wheelchair_accessible_elevator");
        $facade_id = $this->request->getPost("facade");
        $equipment = $this->request->getPost("equipment");
        $no_number = $this->request->getPost("no-number");
        $plaza_capacity_id = $this->request->getPost("plaza_capacity");
        $linear_meters_of_facade = $this->request->getPost("linear_meters_of_facade");
        $stays = $this->request->getPost("stays");
        $number_of_shop_windows = $this->request->getPost("number_of_shop_windows");
        $has_tenants = $this->request->getPost("has_tenants");
        $land_size = $this->request->getPost("land_size");
        $nearest_municipality_distance_id = $this->request->getPost("nearest_municipality_distance");
        $wheeled_access_id = $this->request->getPost("wheeled_access");
        $type_of_terrain_id = $this->request->getPost("type_of_terrain");
        $heating_fuel_id = $this->request->getPost("heating_fuel");
        $m_long = $this->request->getPost("m_long");
        $m_wide = $this->request->getPost("m_wide");
        $location_premises_id = $this->request->getPost("location_premises");
        $garage_price_category_id = $this->request->getPost("garage_price_category");
        $garage_price = $this->request->getPost("garage_price");

        // property_address
        $address = $this->request->getPost("address");
        $city = $this->request->getPost("city");
        $postal_code = $this->request->getPost("postal_code");
        $province = $this->request->getPost("province");
        $country = $this->request->getPost("country");
        $latitude = $this->request->getPost("latitude");
        $longitude = $this->request->getPost("longitude");

        !empty($garage_price) ? $data_for_db['garage_price'] = $garage_price : null;
        !empty($garage_price_category_id) ? $data_for_db['garage_price_category_id'] = $garage_price_category_id : null;
        !empty($location_premises_id) ? $data_for_db['location_premises_id'] = $location_premises_id : null;
        !empty($m_long) ? $data_for_db['m_long'] = str_replace(".","",$m_long) : null;
        !empty($m_wide) ? $data_for_db['m_wide'] = str_replace(".","",$m_wide) : null;
        !empty($heating_fuel_id) ? $data_for_db['heating_fuel_id'] = $heating_fuel_id : null;
        !empty($land_size) ? $data_for_db['land_size'] = str_replace(".","",$land_size) : null;
        !empty($nearest_municipality_distance_id) ? $data_for_db['nearest_municipality_distance_id'] = $nearest_municipality_distance_id : null;
        !empty($wheeled_access_id) ? $data_for_db['wheeled_access_id'] = $wheeled_access_id : null;
        !empty($type_of_terrain_id) ? $data_for_db['type_of_terrain_id'] = $type_of_terrain_id : null;


        !empty($linear_meters_of_facade) ? $data_for_db['linear_meters_of_facade'] = str_replace(".","",$linear_meters_of_facade) : null;
        !empty($stays) ? $data_for_db['stays'] = $stays : null;
        !empty($number_of_shop_windows) ? $data_for_db['number_of_shop_windows'] = $number_of_shop_windows : null;
        !empty($has_tenants) ? $data_for_db['has_tenants'] = $has_tenants : null;

        !empty($plaza_capacity_id) ? $data_for_db['plaza_capacity_id'] = $plaza_capacity_id : null;
        !empty($appropriate_for_children) ? $data_for_db['appropriate_for_children'] = $appropriate_for_children : null;
        !empty($pet_friendly) ? $data_for_db['pet_friendly'] = $pet_friendly : null;
        !empty($max_num_tenants) ? $data_for_db['max_num_tenants'] = str_replace(".","",$max_num_tenants) : null;
        !empty($bank_owned_property) ? $data_for_db['bank_owned_property'] = $bank_owned_property : null;
        !empty($guarantee) ? $data_for_db['guarantee'] = $guarantee : null;
        !empty($ibi) ? $data_for_db['ibi'] = str_replace(".","",$ibi) : null;
        !empty($mortgage_rate) ? $data_for_db['mortgage_rate'] = $mortgage_rate : null;
        !empty($wheelchair_accessible_elevator) ? $data_for_db['wheelchair_accessible_elevator'] = $wheelchair_accessible_elevator : null;
        !empty($facade_id) ? $data_for_db['facade_id'] = $facade_id : null;

        !empty($rooms) ? $data_for_db['rooms'] = str_replace(".","",$rooms) : null;
        !empty($elevator) ? $data_for_db['elevator'] = $elevator : null;
        !empty($plant_id) ? $data_for_db['plant_id'] = $plant_id : null;
        !empty($door_id) ? $data_for_db['door_id'] = $door_id : null;

        !empty($type_id) ? $data_for_db['type_id'] = $type_id : null;
        !empty($locality) ? $data_for_db['locality'] = $locality : null;
        !empty($number) ? $data_for_db['number'] = $number : (!empty($no_number) ? $data_for_db['number'] = $no_number : null);
        !empty($esc_block) ? $data_for_db['esc_block'] = $esc_block : null;
        !empty($door) ? $data_for_db['door'] = $door : null;
        !empty($name_urbanization) ? $data_for_db['name_urbanization'] = $name_urbanization : null;
        !empty($visibility_in_portals_id) ? $data_for_db['visibility_in_portals_id'] = $visibility_in_portals_id : null;
        !empty($typology_id) ? $data_for_db['typology_id'] = $typology_id : null;
        !empty($plot_meters) ? $data_for_db['plot_meters'] = str_replace(".","",$plot_meters) : null;
        !empty($number_of_plants) ? $data_for_db['number_of_plants'] = str_replace(".","",$number_of_plants) : null;
        !empty($energy_class_id) ? $data_for_db['energy_class_id'] = $energy_class_id : null;
        !empty($energy_consumption) ? $data_for_db['energy_consumption'] = $energy_consumption : null;
        !empty($emissions_rating_id) ? $data_for_db['emissions_rating_id'] = $emissions_rating_id : null;
        !empty($emissions_consumption) ? $data_for_db['emissions_consumption'] = $emissions_consumption : null;
        !empty($state_conservation_id) ? $data_for_db['state_conservation_id'] = $state_conservation_id : null;
        !empty($orientation_id) ? $data_for_db['orientation_id'] = $orientation_id : null;
        !empty($outdoor_wheelchair) ? $data_for_db['outdoor_wheelchair'] = $outdoor_wheelchair : null;
        !empty($interior_wheelchair) ? $data_for_db['interior_wheelchair'] = $interior_wheelchair : null;
        !empty($type_heating_id) ? $data_for_db['type_heating_id'] = $type_heating_id : null;
        !empty($page_url) ? $data_for_db['page_url'] = $page_url : null;
        !empty($title) ? $data_for_db['title'] = $title : null;
        !empty($description) ? $data_for_db['description'] = $description : null;
        !empty($category_id) ? $data_for_db['category_id'] = $category_id : null;
        !empty($meters_built) ? $data_for_db['meters_built'] = str_replace(".","",$meters_built) : null;
        !empty($useful_meters) ? $data_for_db['useful_meters'] = str_replace(".","",$useful_meters) : null;
        !empty($sale_price) ? $data_for_db['sale_price'] = str_replace(".","",$sale_price) : null;
        !empty($rental_price) ? $data_for_db['rental_price'] = str_replace(".","",$rental_price) : null;
        !empty($community_expenses) ? $data_for_db['community_expenses'] = str_replace(".","",$community_expenses) : null;
        !empty($year_of_construction) ? $data_for_db['year_of_construction'] = $year_of_construction : null;
        !empty($bedrooms) ? $data_for_db['bedrooms'] = str_replace(".","",$bedrooms) : null;
        !empty($bathrooms) ? $data_for_db['bathrooms'] = str_replace(".","",$bathrooms) : null;
        !empty($parking) ? $data_for_db['parking'] = $parking : null;
        !empty($country_id) ? $data_for_db['country_id'] = $country_id : null;
        !empty($city_id) ? $data_for_db['city_id'] = $city_id : null;
        !empty($province_id) ? $data_for_db['province_id'] = $province_id : null;
        !empty($address) ? $data_for_db['address'] = $address : null;
        !empty($close_to) ? $data_for_db['close_to'] = $close_to : null;
        !empty($zip_code) ? $data_for_db['zip_code'] = $zip_code : null;
        !empty($cover_image) ? $data_for_db['cover_image'] = $cover_image : null;
        !empty($more_images) ? $data_for_db['more_images'] = $more_images : null;
        !empty($rental_type_id) ? $data_for_db['rental_type_id'] = $rental_type_id : null;
        !empty($contact_option_id) ? $data_for_db['contact_option_id'] = $contact_option_id : null;
        !empty($power_consumption_rating_id) ? $data_for_db['power_consumption_rating_id'] = $power_consumption_rating_id : null;
        !empty($reason_for_sale_id) ? $data_for_db['reason_for_sale_id'] = $reason_for_sale_id : null;





        $propertyModel->insert($data_for_db);
        $property_id_temp = $propertyModel->getInsertID();

        $this->propertyAddressModel->insert([
            "property_id" => $property_id_temp,
            "address" => $address,
            "city" => $city,
            "province" => $province,
            "postal_code" => $postal_code,
            "country" => $country,
            "latitude" => $latitude,
            "longitude" => $longitude,  
        ]);

        if (!empty($equipment)) {
            foreach ($equipment as $value) {
                $equipmentsModel->insert([
                    "property_id" => $property_id_temp,
                    "equipment_id" => $value,
                ]);
            };
        };

        if (!empty($feature)) {
            foreach ($feature as $value) {
                $featuresModel->insert([
                    "property_id" => $property_id_temp,
                    "feature_id" => $value,
                ]);
            };
        };
        if (!empty($type_floor)) {
            foreach ($type_floor as $tf) {
                $typesFloorsModel->insert([
                    "property_id" => $property_id_temp,
                    "type_floor_id" => $tf,
                ]);
            };
        };
        if (!empty($orientation)) {
            foreach ($orientation as $ort) {
                $orientationsModel->insert([
                    "property_id" => $property_id_temp,
                    "orientation_id" => $ort,
                ]);
            };
        };

        $session = session();
        $imagePath = FCPATH . 'img/uploads/';
        $videoPath = FCPATH . 'video/uploads/';
        if (!is_dir($imagePath)) {
            mkdir($imagePath, 0755, true);
        }
        if (!is_dir($videoPath)) {
            mkdir($videoPath, 0755, true);
        }
        if ($cover_image && $cover_image->getName() != '') {
            if ($cover_image->isValid() && !$cover_image->hasMoved()) {
                $randomName = pathinfo($cover_image->getRandomName(), PATHINFO_FILENAME) . '.webp';
                $tempPath = $cover_image->getTempName();
                $image = null;
                $is_webp = false;
                switch ($cover_image->getMimeType()) {
                    case 'image/webp':
                        $is_webp = true;                    
                        if (!$cover_image->move($imagePath, $randomName)) {
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
                    if (imagewebp($image, $webpPath, 80)) {
                        $coverImageModel->insert(["url"=> $randomName, "property_id" => $property_id_temp]);
                    } else {
                        $session->setFlashdata('error', 'Error al convertir la imagen a WebP.');
                        return redirect()->to(base_url('post/index'));
                    }
                    imagedestroy($image);
                }else{
                    $coverImageModel->insert(["url"=> $randomName, "property_id" => $property_id_temp]);
                }
            }
        }
        foreach ($more_images as $file) {
            if ($file && $file->getName() != '') {
                if ($file->isValid() && !$file->hasMoved()) {
                    $randomName = pathinfo($file->getRandomName(), PATHINFO_FILENAME) . '.webp';
                    $tempPath = $file->getTempName();
                    $image = null;
                    $is_webp = false;
                    switch ($file->getMimeType()) {
                        case 'image/webp':
                            $is_webp = true;                    
                            if (!$file->move($imagePath, $randomName)) {
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
                            $session->setFlashdata('error', "Formato de imagen no soportado: " . $file->getMimeType());
                            return redirect()->to(base_url('post/index'));
                    }
                    if (!$is_webp){
                        $webpPath = $imagePath . $randomName;
                        if (imagewebp($image, $webpPath, 80)) {
                            $moreImagesModel->insert(["url"=> $randomName, "property_id" => $property_id_temp]);
                        } else {
                            $session->setFlashdata('error', "Error al convertir la imagen a WebP: " . $file->getName());
                            return redirect()->to(base_url('post/index'));
                        }
                        imagedestroy($image);
                    }else{
                        $moreImagesModel->insert(["url"=> $randomName, "property_id" => $property_id_temp]);
                    }
                } else {
                    $session->setFlashdata('error', "Archivo no válido o ya movido: " . $file->getName());
                    return redirect()->to(base_url('post/index'));
                }
            }
        }
        if ($video && $video->getName() != '') {
            if ($video->isValid() || !$video->hasMoved()) {
                $extension = $video->getClientExtension();
                $validationRules = [
                    'video' => [
                        'uploaded[video]',
                        'mime_in[video,video/mp4,video/avi,video/mov,video/mpeg]',
                        'max_size[video,51200]', // 50MB
                    ],
                ];
                if (!$this->validate($validationRules)) {
                    $session->setFlashdata('error', 'El video no es válido.');
                    return redirect()->to(base_url('post/index'));
                }
                $randomName = pathinfo($video->getRandomName(), PATHINFO_FILENAME) .".". $extension;
                if (!$video->move($videoPath, $randomName)) {
                    $session->setFlashdata('error', 'Error al guardar el video.');
                    return redirect()->to(base_url('post/index'));
                }
    
                $videoModel->insert(["url" => $randomName, "property_id" => $property_id_temp]);
            }else{
                $session->setFlashdata('error', 'Error al subir el video.');
                return redirect()->to(base_url('post/index'));
            }
        }

        $message_email = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Nueva Propiedad Registrada</title><style type="text/css">body {font-family: Arial, sans-serif;line-height: 1.6;color: #333333;background-color: #f4f4f4;margin: 0;padding: 0;}.email-container {max-width: 600px;margin: 0 auto;padding: 20px;}.header {background-color: #63c4ca;color: #ffffff;padding: 20px;text-align: center;font-size: 1rem;font-weight: bold;}.content {background-color: #ffffff;padding: 20px;border: 1px solid #dddddd;}.footer {text-align: center;padding: 20px;font-size: 12px;color: #777777;}.details {margin: 15px 0;}.details strong {color: #2c3e50;}</style></head><body><div class="email-container"><div class="header">🏡 Nueva Propiedad Registrada</div><div class="content">
        <p>El usuario <strong>'.session()->get("user_first_name").' '.session()->get("user_last_name").'</strong> (<a href="mailto:'.session()->get("user_email").'" style="color: #3498db;">'.session()->get("user_email").'</a>) ha subido una nueva propiedad al sistema.</p><div class="details"><h3 style="color: #2c3e50; margin-bottom: 10px;">Detalles de la propiedad:</h3><ul style="padding-left: 20px; margin: 10px 0;">
        <li><strong>Título:</strong> '.$title.'</li>
        <li><strong>Tipo:</strong> '.$typeModel->where("id", $type_id)->findAll()[0]["name"].'</li>
        <li><strong>Precio:</strong> $'.(!empty($sale_price) ? $sale_price : $rental_price).'</li></ul></div><p style="margin-top: 20px;">Por favor verificar la información para su aprobación.</p></div><div class="footer"><p>© 2023 damelodamelo.com. Todos los derechos reservados.</p><p><a href="https://damelodamelo.com/" style="color: #3498db;">Acceder al sistema</a></p></div></div></body></html>';
        
        sendEmail("info@damelodamelo.com", "Nueva propiedad agregada", $message_email);
        
        $session->setFlashdata('success', "La propiedad ha sido creada correctamente");

        

        return redirect()->to(base_url('post/index'));
        
    }
    public function myPosts(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");
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
        $typeHeatingModel = new TypeHeatingModel();
        $emissionsRatingModel = new EmissionsRatingModel();
        $energyClassModel = new EnergyClassModel();
        $stateConservationModel = new StateConservationModel();
        $visibilityInPortalsModel = new VisibilityInPortalsModel();
        $rentalTypeModel = new RentalTypeModel();
        $contactOptionModel = new ContactOptionModel();
        $powerConsumptionRatingModel = new PowerConsumptionRatingModel();
        $reasonForSaleModel = new ReasonForSaleModel();


        
        $date_start = $this->request->getGet("ds");
        $date_end = $this->request->getGet("de");
        $index = $this->request->getGet("i");
        $query = $propertyModel->where("user_id", $user_id);
        if (!empty($date_start)) {
            $query->where('created_at >=', $date_start);
        } 
        if (!empty($date_end)) {
            $query->where('created_at <=', $date_end);
        }
        $property = $query->orderBy('id', 'DESC')->findAll();
        $number_of_properties = count($property);
        if (!empty($index)){
            $property = array_slice($property, ($index-1) * 9, 9);
        }else{
            $property = array_slice($property, 0, 9);
        }
        
        $updatedProperties = [];
        foreach ($property as $pr) {
            $createdAt = $pr['updated_at'];
            $time = Time::parse($createdAt);
            $pr["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $pr["type_name"] = ($type = $typeModel->find([$pr["type_id"]])) ? $type[0]["name"] : "";
            $pr["category_name"] = ($category = $categoryModel->find([$pr["category_id"]])) ? $category[0]["name"] : "";
            $pr["cover_image"] = ($cover_image = $coverImageModel->where("property_id", $pr["id"])->findAll()) ? $cover_image[0] : ["url" => ""];
            $pr["more_images"] = ($more_images = $moreImagesModel->where("property_id", $pr["id"])->findAll()) ? $more_images[0] : ["url" => ""];

            $pr["city"] = ($city = $cityModel->where("id", $pr["city_id"])->findAll()) ? $city : [];
            $pr["province"] = ($province = $provinceModel->where("id", $pr["province_id"])->findAll()) ? $province : [];
            $pr["country"] = ($country = $countryModel->where("id", $pr["country_id"])->findAll()) ? $country : [];
            $pr["typology"] = ($typology = $typologyModel->where("id", $pr["typology_id"])->findAll()) ? $typology : [];
            $pr["orientation"] = ($orientation = $orientationModel->where("id", $pr["orientation_id"])->findAll()) ? $orientation : [];
            $pr["type_heating"] = ($type_heating = $typeHeatingModel->where("id", $pr["type_heating_id"])->findAll()) ? $type_heating : [];
            $pr["emissions_rating"] = ($emissions_rating = $emissionsRatingModel->where("id", $pr["emissions_rating_id"])->findAll()) ? $emissions_rating : [];
            $pr["energy_class"] = ($energy_class = $energyClassModel->where("id", $pr["energy_class_id"])->findAll()) ? $energy_class : [];
            $pr["state_conservation"] = ($state_conservation = $stateConservationModel->where("id", $pr["state_conservation_id"])->findAll()) ? $state_conservation : [];
            $pr["visibility_in_portals"] = ($visibility_in_portals = $visibilityInPortalsModel->where("id", $pr["visibility_in_portals_id"])->findAll()) ? $visibility_in_portals : [];
            $pr["rental_type"] = ($rental_type = $rentalTypeModel->where("id", $pr["rental_type_id"])->findAll()) ? $rental_type : [];
            $pr["contact_option"] = ($contact_option = $contactOptionModel->where("id", $pr["contact_option_id"])->findAll()) ? $contact_option : [];
            $pr["power_consumption_rating"] = ($power_consumption_rating = $powerConsumptionRatingModel->where("id", $pr["power_consumption_rating_id"])->findAll()) ? $power_consumption_rating : [];
            $pr["reason_for_sale"] = ($reason_for_sale = $reasonForSaleModel->where("id", $pr["reason_for_sale_id"])->findAll()) ? $reason_for_sale : [];

            $pr["features"] = [];
            $features = $featuresModel->where("property_id", $pr["id"])->findAll();
            foreach($features as $f){
                $feature = $featureModel->find($f["feature_id"]);
                if ($feature){
                    $pr["features"][] = $feature;
                }
            }
            
            $updatedProperties[] = $pr;
        }

        $property = $updatedProperties;

        return view('app/my_posts', ["property" => $property,"number_of_properties" => $number_of_properties, "index" => $index]);
    }
    public function delete(){
        $propertyModel = new PropertyModel();
        $featuresModel = new FeaturesModel();
        $equipmentsModel = new EquipmentsModel();
        $typesFloorsModel = new TypesFloorsModel();
        $orientationsModel = new OrientationsModel();
        $coverImageModel = new CoverImageModel();
        $moreImagesModel = new MoreImagesModel();


        $user_id = session()->get("user_id");
        $id = $this->request->getGet("id");
        $property_temp = $propertyModel->where("user_id", $user_id)->where("id", $id)->findAll();
        if (!empty($property_temp)){
            $propertyModel
                ->where("id", $id)
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

        return $this->response->setJSON(["id" => $id]);
    }
    public function disabledEnabled(){
        $propertyModel = new PropertyModel();
        
        $user_id = session()->get("user_id");
        $id = $this->request->getGet("id");
        $property_temp = $propertyModel->where("user_id", $user_id)->where("id", $id)->findAll();
        $text_state = "";
        $state_id = "";
        if (!empty($property_temp)){
            $state_id = $property_temp[0]["state_id"];
            if ($state_id == 5){
                $state_id = 4;
                $text_state = "Deshabilitar";
            }else{
                $state_id = 5;
                $text_state = "Habilitar";
            }
            $propertyModel
                ->set(["state_id" => $state_id])
                ->where("id", $id)
                ->update();
        }
        return $this->response->setJSON(["id" => $id, "text_state" => $text_state, "state_id" => $state_id]);
    }
    public function updateForm($id){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");

        $userModel = new UserModel();
        $categoryModel = new CategoryModel();
        $cityModel = new CityModel();
        $countryModel = new CountryModel();
        $coverImageModel = new CoverImageModel();
        $featureModel = new FeatureModel();
        $featuresModel = new FeaturesModel();
        $moreImagesModel = new MoreImagesModel();
        $propertyModel = new PropertyModel();
        $provinceModel = new ProvinceModel();
        $stateModel = new StateModel();
        $typeModel = new TypeModel();
        $userLevelModel = new UserLevelModel();
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
        $plantModel = new PlantModel();
        $doorModel = new DoorModel();
        $typeFloorModel = new TypeFloorModel();
        $typesFloorsModel = new TypesFloorsModel();
        $facadeModel = new FacadeModel();
        $equipmentModel = new EquipmentModel();
        $plazaCapacityModel = new PlazaCapacityModel();
        $typeOfTerrainModel = new TypeOfTerrainModel();
        $wheeledAccessModel = new WheeledAccessModel();
        $nearestMunicipalityDistanceModel = new NearestMunicipalityDistanceModel();
        $equipmentsModel = new EquipmentsModel();
        $videoModel = new VideoModel();
        $propertyAddressModel = new PropertyAddressModel();

        $property = $propertyModel->where("id", $id)->where("user_id", session()->get("user_id"))->find();
        if (empty($property)){
            session()->setFlashdata('success', "Ocurrió un error interno");
            return redirect()->to(base_url('post/my_posts'));   
        }

        $category = $categoryModel->findAll();
        $city = $cityModel->findAll();
        $country = $countryModel->findAll();
        $feature = $featureModel->findAll();
        $province = $provinceModel->findAll();
        $state = $stateModel->findAll();
        $type = $typeModel->findAll();
        $user = $userModel->findAll();
        $userLevel = $userLevelModel->findAll();
        $typology = $typologyModel->findAll();
        $orientation = $orientationModel->findAll();
        $typeHeating = $typeHeatingModel->findAll();
        $emissionsRating = $emissionsRatingModel->findAll();
        $energyClass = $energyClassModel->findAll();
        $stateConservation = $stateConservationModel->findAll();
        $visibilityInPortals = $visibilityInPortalsModel->findAll();
        $rentalType = $rentalTypeModel->findAll();
        $contactOption = $contactOptionModel->findAll();
        $powerConsumptionRating = $powerConsumptionRatingModel->findAll();
        $reasonForSale = $reasonForSaleModel->findAll();

        $plant = $plantModel->findAll();
        $door = $doorModel->findAll();
        $typeFloor = $typeFloorModel->findAll();
        $facade = $facadeModel->findAll();
        
        $plazaCapacity = $plazaCapacityModel->findAll();
        $typeOfTerrain = $typeOfTerrainModel->findAll();
        $wheeledAccess = $wheeledAccessModel->findAll();
        $nearestMunicipalityDistance = $nearestMunicipalityDistanceModel->findAll();

        $typesFloors = $typesFloorsModel->where("property_id", $id)->findAll();
        $equipments = $equipmentsModel->where("property_id", $id)->findAll();
        $coverImage = $coverImageModel->where("property_id", $id)->findAll();
        $moreImages = $moreImagesModel->where("property_id", $id)->findAll();
        $video = $videoModel->where("property_id", $id)->findAll();
        $orientations = $orientationsModel->where("property_id", $id)->findAll();
        $features = $featuresModel->where("property_id", $id)->findAll();
        $heatingFuel = $this->heatingFuelModel->findAll();
        $locationPremises = $this->locationPremisesModel->findAll();
        $garagePriceCategory = $this->garagePriceCategoryModel->findAll();
        $propertyAddress = $propertyAddressModel->where("property_id", $id)->findAll();

        $form_name = "";

        if ($property[0]["type_id"] == 1){
            $equipment = $equipmentModel->where("type_id", 1)->findAll();
            $form_name = "form_1_update";
        }else if ($property[0]["type_id"] == 13){
            $equipment = $equipmentModel->where("type_id", 1)->findAll();
            $form_name = "form_2_update";
        }else if ($property[0]["type_id"] == 4){
            $equipment = $equipmentModel->where("type_id", 4)->findAll();
            $form_name = "form_3_update";
        }else if ($property[0]["type_id"] == 14){
            $feature = $featureModel->where("id_type", 14)->findAll();
            $equipment = $equipmentModel->where("type_id", 14)->findAll();
            $form_name = "form_4_update";
        }else if ($property[0]["type_id"] == 9){
            $equipment = $equipmentModel->where("type_id", 4)->findAll();
            $form_name = "form_5_update";
        }else{
            $equipment = $equipmentModel->findAll();
            $form_name = "form_1_update";
        }
        return view('app/'. $form_name, [
                                        "propertyAddress" => $propertyAddress,
                                        "locationPremises" => $locationPremises,
                                        "heatingFuel" => $heatingFuel,
                                        "category" => $category,
                                        "city" => $city, 
                                        "country" => $country,
                                        "coverImage" => $coverImage,
                                        "feature" => $feature,
                                        "features" => $features,
                                        "moreImages" => $moreImages,
                                        "property" => $property,
                                        "province" => $province,
                                        "state" => $state,
                                        "type" => $type,
                                        "user" => $user,
                                        "userLevel" => $userLevel, 
                                        "typology" => $typology,
                                        "orientation" => $orientation,
                                        "orientations" => $orientations,
                                        "typeHeating" => $typeHeating,
                                        "emissionsRating" => $emissionsRating,
                                        "energyClass" => $energyClass,
                                        "stateConservation" => $stateConservation,
                                        "visibilityInPortals" => $visibilityInPortals,
                                        "rentalType" => $rentalType,
                                        "contactOption" => $contactOption,
                                        "powerConsumptionRating" => $powerConsumptionRating,
                                        "reasonForSale" => $reasonForSale,
                                        "plant" => $plant,
                                        "door" => $door,
                                        "typeFloor" => $typeFloor,
                                        "typesFloors" => $typesFloors,
                                        "facade" => $facade,
                                        "equipment" => $equipment,
                                        "equipments" => $equipments,
                                        "plazaCapacity" => $plazaCapacity,
                                        "typeOfTerrain" => $typeOfTerrain,
                                        "wheeledAccess" => $wheeledAccess,
                                        "nearestMunicipalityDistance" => $nearestMunicipalityDistance,
                                        "video" => $video,
                                        "garagePriceCategory" => $garagePriceCategory,
                                    ]);
    }
    public function update(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");

        $propertyModel = new PropertyModel();
        $coverImageModel = new CoverImageModel();        
        $moreImagesModel = new MoreImagesModel();
        $videoModel = new VideoModel();
        
        $featuresModel = new FeaturesModel();
        $typesFloorsModel = new TypesFloorsModel();
        $orientationsModel = new OrientationsModel();
        $equipmentModel = new EquipmentModel();
        $equipmentsModel = new EquipmentsModel();
        $data_for_db = ["user_id" => $user_id];
        
        $property_id = $this->request->getPost("property_id");
        $type_id = $this->request->getPost("type");
        $locality = $this->request->getPost("locality");
        $number = $this->request->getPost("number");
        $esc_block = $this->request->getPost("esc_block");
        $door = $this->request->getPost("door");
        $name_urbanization = $this->request->getPost("name_urbanization");
        $visibility_in_portals_id = $this->request->getPost("visibility_in_portals");
        $typology_id = $this->request->getPost("typology");
        $plot_meters = $this->request->getPost("plot_meters");
        $number_of_plants = $this->request->getPost("number_of_plants");
        $energy_class_id = $this->request->getPost("energy_class");
        $energy_consumption = $this->request->getPost("energy_consumption");
        $emissions_rating_id = $this->request->getPost("emissions_rating");
        $emissions_consumption = $this->request->getPost("emissions_consumption");
        $state_conservation_id = $this->request->getPost("state_conservation");
        $orientation = $this->request->getPost("orientation");
        $outdoor_wheelchair = $this->request->getPost("outdoor_wheelchair");
        $interior_wheelchair = $this->request->getPost("interior_wheelchair");
        $type_heating_id = $this->request->getPost("type_heating");
        $page_url = $this->request->getPost("page_url");
        $title = $this->request->getPost("title");
        $description = $this->request->getPost("description");
        $category_id = $this->request->getPost("category");
        $meters_built = $this->request->getPost("meters_built");
        $useful_meters = $this->request->getPost("useful_meters");
        $sale_price = $this->request->getPost("sale_price");
        $rental_price = $this->request->getPost("rental_price");
        $community_expenses = $this->request->getPost("community_expenses");
        $year_of_construction = $this->request->getPost("year_of_construction");
        $bedrooms = $this->request->getPost("bedrooms");
        $bathrooms = $this->request->getPost("bathrooms");
        $parking = $this->request->getPost("parking");
        $feature = $this->request->getPost("feature");
        $country_id = $this->request->getPost("country");
        $city_id = $this->request->getPost("city");
        $province_id = $this->request->getPost("province");
        $address = $this->request->getPost("address");
        $close_to = $this->request->getPost("close_to");
        $zip_code = $this->request->getPost("zip_code");
        $cover_image = $this->request->getFile("cover_image");
        $more_images = $this->request->getFileMultiple("more_images");
        $video = $this->request->getFile("video");
        $sale_price = $this->request->getPost("sale_price");
        $rental_price = $this->request->getPost("rental_price");
        $rental_type_id = $this->request->getPost("rental_type");
        $contact_option_id = $this->request->getPost("contact_option");
        $power_consumption_rating_id = $this->request->getPost("power_consumption_rating");
        $reason_for_sale_id = $this->request->getPost("reason_for_sale");

        $rooms = $this->request->getPost("rooms");
        $elevator = $this->request->getPost("elevator");
        $plant_id = $this->request->getPost("plant");
        $door_id = $this->request->getPost("door");
        $type_floor = $this->request->getPost("type_floor");
        
        $appropriate_for_children = $this->request->getPost("appropriate_for_children");
        $pet_friendly = $this->request->getPost("pet_friendly");
        $max_num_tenants = $this->request->getPost("max_num_tenants");
        $bank_owned_property = $this->request->getPost("bank_owned_property");
        $guarantee = $this->request->getPost("guarantee");
        $ibi = $this->request->getPost("ibi");
        $mortgage_rate = $this->request->getPost("mortgage_rate");
        $wheelchair_accessible_elevator = $this->request->getPost("wheelchair_accessible_elevator");
        $facade_id = $this->request->getPost("facade");
        $equipment = $this->request->getPost("equipment");
        $no_number = $this->request->getPost("no-number");
        $plaza_capacity_id = $this->request->getPost("plaza_capacity");
        $linear_meters_of_facade = $this->request->getPost("linear_meters_of_facade");
        $stays = $this->request->getPost("stays");
        $number_of_shop_windows = $this->request->getPost("number_of_shop_windows");
        $has_tenants = $this->request->getPost("has_tenants");
        $land_size = $this->request->getPost("land_size");
        $nearest_municipality_distance_id = $this->request->getPost("nearest_municipality_distance");
        $wheeled_access_id = $this->request->getPost("wheeled_access");
        $type_of_terrain_id = $this->request->getPost("type_of_terrain");
        $heating_fuel_id = $this->request->getPost("heating_fuel");
        $m_long = $this->request->getPost("m_long");
        $m_wide = $this->request->getPost("m_wide");
        $location_premises_id = $this->request->getPost("location_premises");
        $garage_price_category_id = $this->request->getPost("garage_price_category");
        $garage_price = $this->request->getPost("garage_price");

        // property_address
        $address = $this->request->getPost("address");
        $city = $this->request->getPost("city");
        $postal_code = $this->request->getPost("postal_code");
        $province = $this->request->getPost("province");
        $country = $this->request->getPost("country");
        $latitude = $this->request->getPost("latitude");
        $longitude = $this->request->getPost("longitude");
        
        !empty($garage_price) ? $data_for_db['garage_price'] = $garage_price : null;
        $data_for_db['garage_price_category_id'] = $garage_price_category_id;
        !empty($location_premises_id) ? $data_for_db['location_premises_id'] = $location_premises_id : null;
        !empty($m_long) ? $data_for_db['m_long'] = str_replace(".","",$m_long) : null;
        !empty($m_wide) ? $data_for_db['m_wide'] = str_replace(".","",$m_wide) : null;
        !empty($heating_fuel_id) ? $data_for_db['heating_fuel_id'] = $heating_fuel_id : null;
        !empty($land_size) ? $data_for_db['land_size'] = str_replace(".","",$land_size) : null;
        !empty($nearest_municipality_distance_id) ? $data_for_db['nearest_municipality_distance_id'] = $nearest_municipality_distance_id : null;
        !empty($wheeled_access_id) ? $data_for_db['wheeled_access_id'] = $wheeled_access_id : null;
        !empty($type_of_terrain_id) ? $data_for_db['type_of_terrain_id'] = $type_of_terrain_id : null;


        !empty($linear_meters_of_facade) ? $data_for_db['linear_meters_of_facade'] = $linear_meters_of_facade : null;
        !empty($stays) ? $data_for_db['stays'] = $stays : null;
        !empty($number_of_shop_windows) ? $data_for_db['number_of_shop_windows'] = $number_of_shop_windows : null;
        !empty($has_tenants) ? $data_for_db['has_tenants'] = $has_tenants : null;

        !empty($plaza_capacity_id) ? $data_for_db['plaza_capacity_id'] = $plaza_capacity_id : null;
        !empty($appropriate_for_children) ? $data_for_db['appropriate_for_children'] = $appropriate_for_children : null;
        !empty($pet_friendly) ? $data_for_db['pet_friendly'] = $pet_friendly : null;
        !empty($max_num_tenants) ? $data_for_db['max_num_tenants'] = str_replace(".","",$max_num_tenants) : null;
        !empty($bank_owned_property) ? $data_for_db['bank_owned_property'] = $bank_owned_property : null;
        !empty($guarantee) ? $data_for_db['guarantee'] = $guarantee : null;
        !empty($ibi) ? $data_for_db['ibi'] = $ibi : null;
        !empty($mortgage_rate) ? $data_for_db['mortgage_rate'] = $mortgage_rate : null;
        !empty($wheelchair_accessible_elevator) ? $data_for_db['wheelchair_accessible_elevator'] = $wheelchair_accessible_elevator : null;
        !empty($facade_id) ? $data_for_db['facade_id'] = $facade_id : null;

        !empty($rooms) ? $data_for_db['rooms'] = str_replace(".","",$rooms) : null;
        !empty($elevator) ? $data_for_db['elevator'] = $elevator : null;
        !empty($plant_id) ? $data_for_db['plant_id'] = $plant_id : null;
        !empty($door_id) ? $data_for_db['door_id'] = $door_id : null;

        !empty($type_id) ? $data_for_db['type_id'] = $type_id : null;
        !empty($locality) ? $data_for_db['locality'] = $locality : null;
        !empty($number) ? $data_for_db['number'] = $number : (!empty($no_number) ? $data_for_db['number'] = $no_number : null);
        !empty($esc_block) ? $data_for_db['esc_block'] = $esc_block : null;
        !empty($door) ? $data_for_db['door'] = $door : null;
        !empty($name_urbanization) ? $data_for_db['name_urbanization'] = $name_urbanization : null;
        !empty($visibility_in_portals_id) ? $data_for_db['visibility_in_portals_id'] = $visibility_in_portals_id : null;
        !empty($typology_id) ? $data_for_db['typology_id'] = $typology_id : null;
        !empty($plot_meters) ? $data_for_db['plot_meters'] = str_replace(".","",$plot_meters) : null;
        !empty($number_of_plants) ? $data_for_db['number_of_plants'] = str_replace(".","",$number_of_plants) : null;
        !empty($energy_class_id) ? $data_for_db['energy_class_id'] = $energy_class_id : null;
        !empty($energy_consumption) ? $data_for_db['energy_consumption'] = $energy_consumption : null;
        !empty($emissions_rating_id) ? $data_for_db['emissions_rating_id'] = $emissions_rating_id : null;
        !empty($emissions_consumption) ? $data_for_db['emissions_consumption'] = $emissions_consumption : null;
        !empty($state_conservation_id) ? $data_for_db['state_conservation_id'] = $state_conservation_id : null;
        !empty($orientation_id) ? $data_for_db['orientation_id'] = $orientation_id : null;
        !empty($outdoor_wheelchair) ? $data_for_db['outdoor_wheelchair'] = $outdoor_wheelchair : null;
        !empty($interior_wheelchair) ? $data_for_db['interior_wheelchair'] = $interior_wheelchair : null;
        !empty($type_heating_id) ? $data_for_db['type_heating_id'] = $type_heating_id : null;
        !empty($page_url) ? $data_for_db['page_url'] = $page_url : null;
        !empty($title) ? $data_for_db['title'] = $title : null;
        !empty($description) ? $data_for_db['description'] = $description : null;
        !empty($category_id) ? $data_for_db['category_id'] = $category_id : null;
        !empty($meters_built) ? $data_for_db['meters_built'] = str_replace(".","",$meters_built) : null;
        !empty($useful_meters) ? $data_for_db['useful_meters'] = str_replace(".","",$useful_meters) : null;
        !empty($sale_price) ? $data_for_db['sale_price'] = str_replace(".","",$sale_price) : null;
        !empty($rental_price) ? $data_for_db['rental_price'] = str_replace(".","",$rental_price) : null;
        !empty($community_expenses) ? $data_for_db['community_expenses'] = str_replace(".","",$community_expenses) : null;
        !empty($year_of_construction) ? $data_for_db['year_of_construction'] = $year_of_construction : null;
        !empty($bedrooms) ? $data_for_db['bedrooms'] = str_replace(".","",$bedrooms) : null;
        !empty($bathrooms) ? $data_for_db['bathrooms'] = str_replace(".","",$bathrooms) : null;
        !empty($parking) ? $data_for_db['parking'] = $parking : null;
        !empty($country_id) ? $data_for_db['country_id'] = $country_id : null;
        !empty($city_id) ? $data_for_db['city_id'] = $city_id : null;
        !empty($province_id) ? $data_for_db['province_id'] = $province_id : null;
        !empty($address) ? $data_for_db['address'] = $address : null;
        !empty($close_to) ? $data_for_db['close_to'] = $close_to : null;
        !empty($zip_code) ? $data_for_db['zip_code'] = $zip_code : null;
        !empty($cover_image) ? $data_for_db['cover_image'] = $cover_image : null;
        !empty($more_images) ? $data_for_db['more_images'] = $more_images : null;
        !empty($rental_type_id) ? $data_for_db['rental_type_id'] = $rental_type_id : null;
        !empty($contact_option_id) ? $data_for_db['contact_option_id'] = $contact_option_id : null;
        !empty($power_consumption_rating_id) ? $data_for_db['power_consumption_rating_id'] = $power_consumption_rating_id : null;
        !empty($reason_for_sale_id) ? $data_for_db['reason_for_sale_id'] = $reason_for_sale_id : null;


        $data_temp = $propertyModel
            ->where("user_id", $user_id)
            ->where("id", $property_id)
            ->first();
        if (empty($data_temp)){
            session()->setFlashdata('success', "Ocurrió un error interno");
            return redirect()->to(base_url('post/my_posts'));   
        }
        $propertyModel->update($property_id, $data_for_db);

        $property_id_temp = $property_id;
        
        $this->propertyAddressModel->set([
            "address" => $address,
            "city" => $city,
            "province" => $province,
            "postal_code" => $postal_code,
            "country" => $country,
            "latitude" => $latitude,
            "longitude" => $longitude,])
            ->where("property_id", $property_id_temp)->update();
        

        if (!empty($equipment)) {
            $equipmentsModel->where("property_id", $property_id_temp)->delete();
            foreach ($equipment as $value) {
                $equipmentsModel->insert([
                    "property_id" => $property_id_temp,
                    "equipment_id" => $value,
                ]);
            };
        };
        if (!empty($feature)) {
            $featuresModel->where("property_id", $property_id_temp)->delete();
            foreach ($feature as $value) {
                $featuresModel->insert([
                    "property_id" => $property_id_temp,
                    "feature_id" => $value,
                ]);
            };
        };
        if (!empty($type_floor)) {
            $typesFloorsModel->where("property_id", $property_id_temp)->delete();
            foreach ($type_floor as $tf) {
                $typesFloorsModel->insert([
                    "property_id" => $property_id_temp,
                    "type_floor_id" => $tf,
                ]);
            };
        };
        if (!empty($orientation)) {
            $orientationsModel->where("property_id", $property_id_temp)->delete();
            foreach ($orientation as $ort) {
                $orientationsModel->insert([
                    "property_id" => $property_id_temp,
                    "orientation_id" => $ort,
                ]);
            };
        };

        $session = session();
        $imagePath = FCPATH . 'img/uploads/';
        $videoPath = FCPATH . 'video/uploads/';
        if (!is_dir($imagePath)) {
            mkdir($imagePath, 0755, true);
        }
        if (!is_dir($videoPath)) {
            mkdir($videoPath, 0755, true);
        }
        if ($cover_image && $cover_image->getName() != '') {
            if ($cover_image->isValid() && !$cover_image->hasMoved()) {
                $randomName = pathinfo($cover_image->getRandomName(), PATHINFO_FILENAME) . '.webp';
                $tempPath = $cover_image->getTempName();
                $image = null;
                $is_webp = false;
                switch ($cover_image->getMimeType()) {
                    case 'image/webp':
                        $is_webp = true;                    
                        if (!$cover_image->move($imagePath, $randomName)) {
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
                    if (imagewebp($image, $webpPath, 80)) {
                        $coverImageModel->set(["url"=> $randomName])->where("property_id", $property_id_temp)->update();
                    } else {
                        $session->setFlashdata('error', 'Error al convertir la imagen a WebP.');
                        return redirect()->to(base_url('post/index'));
                    }
                    imagedestroy($image);
                }else{
                    $coverImageModel->set(["url"=> $randomName])->where("property_id", $property_id_temp)->update();
                }
            }
        }
        if (!empty($more_images)){
            foreach ($more_images as $file) {
                if ($file && $file->getName() != '') {
                    if ($file->isValid() && !$file->hasMoved()) {
                        
                        $randomName = pathinfo($file->getRandomName(), PATHINFO_FILENAME) . '.webp';
                        $tempPath = $file->getTempName();
                        $image = null;
                        $is_webp = false;
                        switch ($file->getMimeType()) {
                            case 'image/webp':
                                $is_webp = true;                    
                                if (!$file->move($imagePath, $randomName)) {
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
                                $session->setFlashdata('error', "Formato de imagen no soportado: " . $file->getMimeType());
                                return redirect()->to(base_url('post/index'));
                        }
                        if (!$is_webp){
                            $webpPath = $imagePath . $randomName;
                            if (imagewebp($image, $webpPath, 80)) {
                                $moreImagesModel->insert(["url"=> $randomName, "property_id" => $property_id_temp]);
                            } else {
                                $session->setFlashdata('error', "Error al convertir la imagen a WebP: " . $file->getName());
                                return redirect()->to(base_url('post/index'));
                            }
                            imagedestroy($image);
                        }else{
                            $moreImagesModel->insert(["url"=> $randomName, "property_id" => $property_id_temp]);
                        }
                    } else {
                        $session->setFlashdata('error', "Archivo no válido o ya movido: " . $file->getName());
                        return redirect()->to(base_url('post/index'));
                    }
                }
            }
        }
        if ($video && $video->getName() != '') {
            if ($video->isValid() || !$video->hasMoved()) {
                $extension = $video->getClientExtension();
                $validationRules = [
                    'video' => [
                        'uploaded[video]',
                        'mime_in[video,video/mp4,video/avi,video/mov,video/mpeg]',
                        'max_size[video,51200]', // 50MB
                    ],
                ];
                if (!$this->validate($validationRules)) {
                    $session->setFlashdata('error', 'El video no es válido.');
                    return redirect()->to(base_url('post/index'));
                }
                $randomName = pathinfo($video->getRandomName(), PATHINFO_FILENAME) .".". $extension;
                if (!$video->move($videoPath, $randomName)) {
                    $session->setFlashdata('error', 'Error al guardar el video.');
                    return redirect()->to(base_url('post/index'));
                }
                $video_test = $videoModel->where("property_id", $property_id_temp)->findAll();
                if (!empty($video_test)){
                    $videoModel->set(["url" => $randomName])->where("property_id", $property_id_temp)->update();
                }else{
                    $videoModel->insert(["url" => $randomName, "property_id" => $property_id_temp]);
                }

            }else{
                $session->setFlashdata('error', 'Error al subir el video.');
                return redirect()->to(base_url('post/index'));
            }
        }

        

        
        $session->setFlashdata('success', "Actualizado correctamente");
        return redirect()->to(base_url('post/my_posts'));
        
    }
    // Servicios

    public function createService(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        helper("email");

        $serviceModel = new ServiceModel();
        $serviceTypeModel = new ServiceTypeModel();
        $serviceTypesModel = new ServiceTypesModel();
        $locationActionModel = new LocationActionModel();
        $locationsActionModel = new LocationsActionModel();
        $serviceAddressModel = new ServiceAddressModel();
        $userAddressModel = new UserAddressModel();

        $coverImageModel = new CoverImageModel();        
        $moreImagesModel = new MoreImagesModel();
        $videoModel = new VideoModel();
        
        $user_id_temp_client = session()->get("user_id");

        // Datos del usuario
        $first_name = $this->request->getPost("first_name");
        $last_name = $this->request->getPost("last_name");
        $address = $this->request->getPost("address");
        $document_type = $this->request->getPost("document_type");
        $document_number = $this->request->getPost("document_number");
        $phone = $this->request->getPost("phone");
        $landline_phone = $this->request->getPost("landline_phone");
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");

        // service_address
        $address = $this->request->getPost("address");
        $city = $this->request->getPost("city");
        $postal_code = $this->request->getPost("postal_code");
        $province = $this->request->getPost("province");
        $country = $this->request->getPost("country");
        $latitude = $this->request->getPost("latitude");
        $longitude = $this->request->getPost("longitude");

        $with_user = false;
        if (!empty($first_name) && !empty($document_type) && !empty($email) && !empty($password)){
            $with_user = true;
            $this->userModel->insert([
                "first_name" => $first_name,
                "last_name" => $last_name,
                "user_name" => "",
                "email" => $email,
                "phone" => $phone,
                "landline_phone" => $landline_phone,
                "document_type" => $document_type,
                "document_number" => $document_number,
                "address" => $address,
                "password" => $password,
                "user_level_id" => 4,
            ]);
            
            $user_id_temp_client = $this->userModel->getInsertID();
            $userAddressModel->insert([
                "user_id" => $user_id_temp_client,
                "address" => $address,
                "city" => $city,
                "province" => $province,
                "postal_code" => $postal_code,
                "country" => $country,
                "latitude" => $latitude,
                "longitude" => $longitude,  
            ]);
            
            $message_html_model = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cuenta Creada</title><style>
                                    body {font-family: Arial, sans-serif;background-color:#f4f4f4;margin: 0;padding: 20px;}a{color:#ffffff;}.container {max-width: 600px;background:#ffffff;padding: 20px;border-radius: 8px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);text-align: center;margin: auto;}h2 {color: #333;}p {color: #666;font-size: 16px;}.info {background: #eee;padding: 10px;border-radius: 5px;display: inline-block;margin: 10px 0;justify-content:start;}.btn {display: inline-block;background:#007bff;color: #fff;text-decoration: none;padding: 10px 20px;border-radius: 5px;font-size: 16px;margin-top: 20px;}.btn:hover {background:#0056b3;}.footer {margin-top: 20px;font-size: 12px;color: #999;}</style></head><body><div class="container"><h2>🎉 ¡Tu cuenta ha sido creada con éxito! 🎉</h2>
                                    <p>Hola <strong>'.$first_name. " ".$last_name.'</strong></p><p>Te damos la bienvenida a <strong>Dámelo Dámelo</strong>. Tu cuenta ha sido creada y ya puedes acceder.</p><div class="info">
                                    <p style="text-align: start;"><strong>Correo electrónico:</strong> '.$email.'</p>
                                    <p style="text-align: start;"><strong>Contraseña:</strong> '.$password.'</p></div><p>Para iniciar sesión, haz clic en el siguiente botón:</p>
                                    <a href="https://damelodamelo.com/login" target="_blank" style="color:#ffffff;" class="btn">Iniciar Sesión</a><p class="footer">Si no solicitaste esta cuenta, ignora este mensaje.</p></div></body></html>';
            sendEmail($email, "Bienvenido a Damelo Damelo", $message_html_model);

        }

        $description = $this->request->getPost("description");
        $availability = $this->request->getPost("availability");
        $page_url = $this->request->getPost("page_url");
        
        // $location_action = $this->request->getPost("location_action");
        $service_type = $this->request->getPost("service_type");
        $cover_image = $this->request->getFile("cover_image");
        $more_images = $this->request->getFileMultiple("more_images");
        $video = $this->request->getFile("video");

        
        $data_for_db = ["user_id" => $user_id_temp_client, "state_id" => 1,];
        // !empty($document_number) ? $data_for_db["document_number"] = $document_number : null;
        // !empty($title) ? $data_for_db['title'] = $title : null;
        !empty($description) ? $data_for_db['description'] = $description : null;
        !empty($availability) ? $data_for_db['availability'] = $availability : null;
        !empty($page_url) ? $data_for_db['page_url'] = $page_url : null;
        
        
        $serviceModel->insert($data_for_db);
        $service_id_temp = $serviceModel->getInsertID();
        
        if (!empty($service_type)) {
            foreach ($service_type as $st) {
                $serviceTypesModel->insert([
                    "service_id" => $service_id_temp,
                    "service_type_id" => $st,
                ]);
            };
        };
        

        $session = session();
        $imagePath = FCPATH . 'img/uploads/';
        $videoPath = FCPATH . 'video/uploads/';
        if (!is_dir($imagePath)) {
            mkdir($imagePath, 0755, true);
        }
        if (!is_dir($videoPath)) {
            mkdir($videoPath, 0755, true);
        }
        if ($cover_image && $cover_image->getName() != '') {
            if ($cover_image->isValid() && !$cover_image->hasMoved()) {
                $randomName = pathinfo($cover_image->getRandomName(), PATHINFO_FILENAME) . '.webp';
                $tempPath = $cover_image->getTempName();
                $image = null;
                $is_webp = false;
                switch ($cover_image->getMimeType()) {
                    case 'image/webp':
                        $is_webp = true;                    
                        if (!$cover_image->move($imagePath, $randomName)) {
                            $session->setFlashdata('error', 'Error al mover la imagen WebP.');
                            return redirect()->to(base_url('post/services'));
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
                        return redirect()->to(base_url('post/services'));
                }
                if (!$is_webp){
                    $webpPath = $imagePath . $randomName;
                    if (imagewebp($image, $webpPath, 80)) {
                        $coverImageModel->insert(["url"=> $randomName, "service_id" => $service_id_temp]);
                    } else {
                        $session->setFlashdata('error', 'Error al convertir la imagen a WebP.');
                        return redirect()->to(base_url('post/services'));
                    }
                    imagedestroy($image);
                }else{
                    $coverImageModel->insert(["url"=> $randomName, "service_id" => $service_id_temp]);
                }
            }
        }
        foreach ($more_images as $file) {
            if ($file && $file->getName() != '') {
                if ($file->isValid() && !$file->hasMoved()) {
                    $randomName = pathinfo($file->getRandomName(), PATHINFO_FILENAME) . '.webp';
                    $tempPath = $file->getTempName();
                    $image = null;
                    $is_webp = false;
                    switch ($file->getMimeType()) {
                        case 'image/webp':
                            $is_webp = true;                    
                            if (!$file->move($imagePath, $randomName)) {
                                $session->setFlashdata('error', 'Error al mover la imagen WebP.');
                                return redirect()->to(base_url('post/services'));
                            }
                            break;
                        case 'image/jpeg':
                            $image = imagecreatefromjpeg($tempPath);
                            break;
                        case 'image/png':
                            $image = imagecreatefrompng($tempPath);
                            break;
                        default:
                            $session->setFlashdata('error', "Formato de imagen no soportado: " . $file->getMimeType());
                            return redirect()->to(base_url('post/services'));
                    }
                    if (!$is_webp){
                        $webpPath = $imagePath . $randomName;
                        if (imagewebp($image, $webpPath, 80)) {
                            $moreImagesModel->insert(["url"=> $randomName, "service_id" => $service_id_temp]);
                        } else {
                            $session->setFlashdata('error', "Error al convertir la imagen a WebP: " . $file->getName());
                            return redirect()->to(base_url('post/services'));
                        }
                        imagedestroy($image);
                    }else{
                        $moreImagesModel->insert(["url"=> $randomName, "service_id" => $service_id_temp]);
                    }
                } else {
                    $session->setFlashdata('error', "Archivo no válido o ya movido: " . $file->getName());
                    return redirect()->to(base_url('post/services'));
                }
            }
        }
        if ($video && $video->getName() != '') {
            if ($video->isValid() || !$video->hasMoved()) {
                $extension = $video->getClientExtension();
                $validationRules = [
                    'video' => [
                        'uploaded[video]',
                        'mime_in[video,video/mp4,video/avi,video/mov,video/mpeg]',
                        'max_size[video,51200]', // 50MB
                    ],
                ];
                if (!$this->validate($validationRules)) {
                    $session->setFlashdata('error', 'El video no es válido.');
                    return redirect()->to(base_url('post/services'));
                }
                $randomName = pathinfo($video->getRandomName(), PATHINFO_FILENAME) .".". $extension;
                if (!$video->move($videoPath, $randomName)) {
                    $session->setFlashdata('error', 'Error al guardar el video.');
                    return redirect()->to(base_url('post/services'));
                }
    
                $videoModel->insert(["url" => $randomName, "service_id" => $service_id_temp]);
            }else{
                $session->setFlashdata('error', 'Error al subir el video.');
                return redirect()->to(base_url('post/services'));
            }
        }

        

        
        $session->setFlashdata('success', "Creada correctamente");
        if ($with_user){
            return redirect()->to(base_url('post/create_form/service'));
        }else{
            return redirect()->to(base_url('post/services'));
        }
    }
    public function services(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");
        $userModel = new UserModel();
        $stateModel = new StateModel();
        $userLevelModel = new UserLevelModel();  
        $serviceTypeModel = new ServiceTypeModel();  

        
        $coverImageModel = new CoverImageModel();
        $moreImagesModel = new MoreImagesModel();
        $serviceModel = new ServiceModel();
        
        $date_start = $this->request->getGet("ds");
        $date_end = $this->request->getGet("de");
        
        $user = $userModel->find($user_id);
        $serviceType = $serviceTypeModel->findAll();
        $query = $serviceModel->where("user_id", $user_id)->orderBy('id', 'DESC');
        if (!empty($date_start)) {
            $query->where('created_at >=', $date_start);
        } 
        if (!empty($date_end)) {
            $query->where('created_at <=', $date_end);
        }
        $services = $query->findAll();
        
        $updatedServices = [];
        foreach ($services as $ser) {
            $createdAt = $ser['updated_at'];
            $time = Time::parse($createdAt);
            $ser["updated_at_text"] = $time->toLocalizedString('d \'de\' MMMM \'de\' yyyy', 'es_ES');
            $ser["cover_image"] = ($cover_image = $coverImageModel->where("service_id", $ser["id"])->findAll()) ? $cover_image[0] : ["url" => ""];
            $ser["more_images"] = ($more_images = $moreImagesModel->where("service_id", $ser["id"])->findAll()) ? $more_images[0] : ["url" => ""];

            $updatedServices[] = $ser;
        }

        $services = $updatedServices;

        return view('app/services', ["user"=> $user, "services" => $services, "serviceType" => $serviceType]);
        
    }
    public function servicesUpdate($service_id){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");

        $serviceModel = new ServiceModel();
        $serviceTypeModel = new ServiceTypeModel();
        $serviceTypesModel = new ServiceTypesModel();
        $locationActionModel = new LocationActionModel();
        $locationsActionModel = new LocationsActionModel();
        $coverImageModel = new CoverImageModel();
        $moreImagesModel = new MoreImagesModel();
        $videoModel = new VideoModel();
        $serviceAddressModel = new ServiceAddressModel();

        $service = $serviceModel->where("id", $service_id)->where("user_id", $user_id)->find();
        if (empty($service)){
            session()->setFlashdata('success', "Ocurrió un error interno");
            return redirect()->to(base_url('post/services'));   
        }

        $serviceType = $serviceTypeModel->findAll();
        $serviceTypes = $serviceTypesModel->where("service_id", $service_id)->findAll();
        $locationAction = $locationActionModel->findAll();
        $locationsAction = $locationsActionModel->where("service_id", $service_id)->findAll();
        $coverImage = $coverImageModel->where("service_id", $service_id)->findAll();
        $moreImages = $moreImagesModel->where("service_id", $service_id)->findAll();
        $video = $videoModel->where("service_id", $service_id)->findAll();
        $serviceAddress = $serviceAddressModel->where("service_id", $service_id)->findAll();

        $form_name = "form_service_update";
        return view('app/'. $form_name, [
                                        "serviceType" => $serviceType,
                                        "serviceTypes" => $serviceTypes,
                                        "serviceAddress" => $serviceAddress,
                                        "locationAction" => $locationAction,
                                        "locationsAction" => $locationsAction,
                                        "moreImages" => $moreImages,
                                        "coverImage" => $coverImage,
                                        "service" => $service,
                                        "video" => $video,
                                    ]);
    
    }
    public function servicesUpdateSave(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");

        $serviceModel = new ServiceModel();
        $serviceTypesModel = new ServiceTypesModel();
        $locationsActionModel = new LocationsActionModel();

        $coverImageModel = new CoverImageModel();        
        $moreImagesModel = new MoreImagesModel();
        $videoModel = new VideoModel();
        $serviceAddressModel = new ServiceAddressModel();
        
        
        $data_for_db = ["user_id" => $user_id, "state_id" => 1,];
        
        $service_id = $this->request->getPost("service_id");
        $cover_image = $this->request->getFile("cover_image");
        $more_images = $this->request->getFileMultiple("more_images");
        $video = $this->request->getFile("video");
        

        $title = $this->request->getPost("title");
        $description = $this->request->getPost("description");
        $availability = $this->request->getPost("availability");
        $document_number = $this->request->getPost("document_number");
        $page_url = $this->request->getPost("page_url");

        $service_types = $this->request->getPost("service_type");
        $locations_action = $this->request->getPost("location_action");
        
        // service_address
        $address = $this->request->getPost("address");
        $city = $this->request->getPost("city");
        $postal_code = $this->request->getPost("postal_code");
        $province = $this->request->getPost("province");
        $country = $this->request->getPost("country");
        $latitude = $this->request->getPost("latitude");
        $longitude = $this->request->getPost("longitude");

        !empty($title) ? $data_for_db['title'] = $title : null;
        !empty($description) ? $data_for_db['description'] = $description : null;
        !empty($availability) ? $data_for_db['availability'] = $availability : null;
        !empty($document_number) ? $data_for_db["document_number"] = $document_number : null;
        !empty($page_url) ? $data_for_db['page_url'] = $page_url : null;


        $data_temp = $serviceModel
            ->where("user_id", $user_id)
            ->where("id", $service_id)
            ->first();

        if (empty($data_temp)){
            session()->setFlashdata('success', "Ocurrió un error interno");
            return redirect()->to(base_url('post/services'));   
        }
        $serviceModel->update($service_id, $data_for_db);

        if (!empty($service_types)) {
            $serviceTypesModel->where("service_id", $service_id)->delete();
            foreach ($service_types as $value) {
                $serviceTypesModel->insert([
                    "service_id" => $service_id,
                    "service_type_id" => $value,
                ]);
            };
        };
        $serviceAddressModel->set([
            "address" => $address,
            "city" => $city,
            "province" => $province,
            "postal_code" => $postal_code,
            "country" => $country,
            "latitude" => $latitude,
            "longitude" => $longitude,])
            ->where("service_id", $service_id)->update();

        // if (!empty($locations_action)) {
        //     $locationsActionModel->where("service_id", $service_id)->delete();
        //     foreach ($locations_action as $value) {
        //         $locationsActionModel->insert([
        //             "service_id" => $service_id,
        //             "location_action_id" => $value,
        //         ]);
        //     };
        // };
        
        $session = session();
        $imagePath = FCPATH . 'img/uploads/';
        $videoPath = FCPATH . 'video/uploads/';
        if (!is_dir($imagePath)) {
            mkdir($imagePath, 0755, true);
        }
        if (!is_dir($videoPath)) {
            mkdir($videoPath, 0755, true);
        }
        if ($cover_image && $cover_image->getName() != '') {
            if ($cover_image->isValid() && !$cover_image->hasMoved()) {
                $randomName = pathinfo($cover_image->getRandomName(), PATHINFO_FILENAME) . '.webp';
                $tempPath = $cover_image->getTempName();
                $image = null;
                $is_webp = false;
                switch ($cover_image->getMimeType()) {
                    case 'image/webp':
                        $is_webp = true;                    
                        if (!$cover_image->move($imagePath, $randomName)) {
                            $session->setFlashdata('error', 'Error al mover la imagen WebP.');
                            return redirect()->to(base_url('post/services'));
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
                        return redirect()->to(base_url('post/services'));
                }
                if (!$is_webp){
                    $webpPath = $imagePath . $randomName;
                    if (imagewebp($image, $webpPath, 80)) {
                        $coverImageModel->set(["url"=> $randomName])->where("service_id", $service_id)->update();
                    } else {
                        $session->setFlashdata('error', 'Error al convertir la imagen a WebP.');
                        return redirect()->to(base_url('post/services'));
                    }
                    imagedestroy($image);
                }else{
                    $coverImageModel->set(["url"=> $randomName])->where("service_id", $service_id)->update();
                }
            }
        }
        foreach ($more_images as $file) {
            if ($file && $file->getName() != '') {
                if ($file->isValid() && !$file->hasMoved()) {
                    
                    $randomName = pathinfo($file->getRandomName(), PATHINFO_FILENAME) . '.webp';
                    $tempPath = $file->getTempName();
                    $image = null;
                    $is_webp = false;
                    switch ($file->getMimeType()) {
                        case 'image/webp':
                            $is_webp = true;                    
                            if (!$file->move($imagePath, $randomName)) {
                                $session->setFlashdata('error', 'Error al mover la imagen WebP.');
                                return redirect()->to(base_url('post/services'));
                            }
                            break;
                        case 'image/jpeg':
                            $image = imagecreatefromjpeg($tempPath);
                            break;
                        case 'image/png':
                            $image = imagecreatefrompng($tempPath);
                            break;
                        default:
                            $session->setFlashdata('error', "Formato de imagen no soportado: " . $file->getMimeType());
                            return redirect()->to(base_url('post/services'));
                    }
                    if (!$is_webp){
                        $webpPath = $imagePath . $randomName;
                        if (imagewebp($image, $webpPath, 80)) {
                            $moreImagesModel->insert(["url"=> $randomName, "service_id" => $service_id]);
                        } else {
                            $session->setFlashdata('error', "Error al convertir la imagen a WebP: " . $file->getName());
                            return redirect()->to(base_url('post/services'));
                        }
                        imagedestroy($image);
                    }else{
                        $moreImagesModel->insert(["url"=> $randomName, "service_id" => $service_id]);
                    }
                } else {
                    $session->setFlashdata('error', "Archivo no válido o ya movido: " . $file->getName());
                    return redirect()->to(base_url('post/services'));
                }
            }
        }
        if ($video && $video->getName() != '') {
            if ($video->isValid() || !$video->hasMoved()) {
                $extension = $video->getClientExtension();
                $validationRules = [
                    'video' => [
                        'uploaded[video]',
                        'mime_in[video,video/mp4,video/avi,video/mov,video/mpeg]',
                        'max_size[video,51200]', // 50MB
                    ],
                ];
                if (!$this->validate($validationRules)) {
                    $session->setFlashdata('error', 'El video no es válido.');
                    return redirect()->to(base_url('post/services'));
                }
                $randomName = pathinfo($video->getRandomName(), PATHINFO_FILENAME) .".". $extension;
                if (!$video->move($videoPath, $randomName)) {
                    $session->setFlashdata('error', 'Error al guardar el video.');
                    return redirect()->to(base_url('post/services'));
                }
    
                $videoModel->set(["url" => $randomName])->where("service_id", $service_id)->update();

            }else{
                $session->setFlashdata('error', 'Error al subir el video.');
                return redirect()->to(base_url('post/services'));
            }
        }

        

        
        $session->setFlashdata('success', "Actualizado correctamente");
        return redirect()->to(base_url('post/services'));
    }
    public function servicesDelete(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $user_id = session()->get("user_id");

        $serviceModel = new ServiceModel();
        $serviceTypesModel = new ServiceTypesModel();
        $locationsActionModel = new LocationsActionModel();
        $coverImageModel = new CoverImageModel();
        $moreImagesModel = new MoreImagesModel();


        $id = $this->request->getGet("id");

        $dataService = $serviceModel->where("user_id", $user_id)->where("id", $id)->findAll();
        if (!empty($dataService)){
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


        return $this->response->setJSON(["id" => $id]);
    }
    public function postDetails($reference){
        if (!$this->auth->isLoggedIn()) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        $propertyModel = new PropertyModel();
        $userFreeModel = new UserFreeModel();

        $psViewsDetailModel     = new PsViewsDetailModel();
        $psWhatsappClicksModel  = new PsWhatsappClicksModel();
        $psViewsSearchModel     = new PsViewsSearchModel();
        $psOwnerCallsModel      = new PsOwnerCallsModel();
        $psSharedFacebookModel  = new PsSharedFacebookModel();
        $psLinkCopiedModel      = new PsLinkCopiedModel();
        $psSharedFriendsModel   = new PsSharedFriendsModel();
        $psEmailOwnerModel      = new PsEmailOwnerModel();
        $psSavedFavoriteModel   = new PsSavedFavoriteModel();
        $psMessagesReceivedModel = new PsMessagesReceivedModel();

        $date_start = $this->request->getGet("ds");
        $date_end = $this->request->getGet("de");

        $property = $propertyModel->where('reference', $reference)->first();

        if (!$property) {
            return redirect()->back()->with('error', 'Propiedad no encontrada.');
        }

        $propertyId = $property['id'];

        $messages = $psMessagesReceivedModel->where('property_id', $propertyId)->findAll();
        foreach ($messages as &$msg) {
            $user = $userFreeModel->find($msg['user_free_id']);
            $msg['user'] = $user ?: [];
        }

        $stats_json = [];

        if ($date_start || $date_end) {
            $startDate = $date_start ?: date('Y-m-d');
            $endDate = $date_end ?: date('Y-m-d');

            $start = strtotime($startDate);
            $end = strtotime($endDate);

            $chartData = [];
            $totals = [
                'viewsListings'   => 0,
                'viewsDetail'     => 0,
                'whatsappClicks'  => 0,
                'phoneCalls'      => 0,
                'sharedFB'        => 0,
                'copiedLink'      => 0,
                'savedFavorites'  => 0,
                'viewsSearch'     => 0,
                'sharedFriends'   => 0,
                'emailOwner'      => 0,
            ];

            for ($date = $start; $date <= $end; $date += 86400) {
                $dateStr = date('Y-m-d', $date);
                $label = date('d/m/Y', $date);

                $row = [
                    'date'           => $label,
                    'viewsListings'  => 0,
                    'viewsDetail'    => 0,
                    'whatsappClicks' => 0,
                    'phoneCalls'     => 0,
                    'sharedFB'       => 0,
                    'copiedLink'     => 0,
                    'savedFavorites' => 0,
                    'viewsSearch'    => 0,
                    'sharedFriends'  => 0,
                    'emailOwner'     => 0,
                ];

                $row['viewsDetail']     = $psViewsDetailModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['whatsappClicks']  = $psWhatsappClicksModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['viewsSearch']     = $psViewsSearchModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['phoneCalls']      = $psOwnerCallsModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['sharedFB']        = $psSharedFacebookModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['copiedLink']      = $psLinkCopiedModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['sharedFriends']   = $psSharedFriendsModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['emailOwner']      = $psEmailOwnerModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();
                $row['savedFavorites']  = $psSavedFavoriteModel->where('property_id', $propertyId)->where('DATE(created_at)', $dateStr)->countAllResults();

                $row['viewsListings'] = $row['viewsDetail'] + $row['viewsSearch'];

                foreach ($totals as $keyName => $val) {
                    $totals[$keyName] += $row[$keyName];
                }

                $chartData[] = $row;
            }

            $totalImpacts = $totals['viewsListings'] + $totals['whatsappClicks'] + $totals['phoneCalls'] + $totals['sharedFB'] + $totals['copiedLink'] + $totals['savedFavorites'] + $totals['sharedFriends'] + $totals['emailOwner'];
            $totalActions = $totals['whatsappClicks'] + $totals['phoneCalls'] + $totals['sharedFB'] + $totals['copiedLink'] + $totals['savedFavorites'] + $totals['sharedFriends'] + $totals['emailOwner'];

            $stats_json["30"] = [
                'totalImpacts'    => $totalImpacts,
                'totalActions'    => $totalActions,
                'viewsListings'   => $totals['viewsListings'],
                'viewsDetail'     => $totals['viewsDetail'],
                'whatsappClicks'  => $totals['whatsappClicks'],
                'phoneCalls'      => $totals['phoneCalls'],
                'sharedFB'        => $totals['sharedFB'],
                'copiedLink'      => $totals['copiedLink'],
                'savedFavorites'  => $totals['savedFavorites'],
                'viewsSearch'     => $totals['viewsSearch'],
                'sharedFriends'   => $totals['sharedFriends'],
                'emailOwner'      => $totals['emailOwner'],
                'chartData'       => $chartData
            ];

        } else {
            $periods = ['0' => 1, '7' => 7, '30' => 30, '90' => 90];

            foreach ($periods as $key => $days) {
                $startDate = date('Y-m-d', strtotime("-" . ($days - 1) . " days"));
                $endDate = date('Y-m-d');
                $chartData = [];

                $totals = [
                    'viewsListings'   => 0,
                    'viewsDetail'     => 0,
                    'whatsappClicks'  => 0,
                    'phoneCalls'      => 0,
                    'sharedFB'        => 0,
                    'copiedLink'      => 0,
                    'savedFavorites'  => 0,
                    'viewsSearch'     => 0,
                    'sharedFriends'   => 0,
                    'emailOwner'      => 0,
                ];

                for ($i = 0; $i < $days; $i++) {
                    $date = date('Y-m-d', strtotime("-" . ($days - 1 - $i) . " days"));
                    $label = date('d/m/Y', strtotime($date));

                    $row = [
                        'date'           => $label,
                        'viewsListings'  => 0,
                        'viewsDetail'    => 0,
                        'whatsappClicks' => 0,
                        'phoneCalls'     => 0,
                        'sharedFB'       => 0,
                        'copiedLink'     => 0,
                        'savedFavorites' => 0,
                        'viewsSearch'    => 0,
                        'sharedFriends'  => 0,
                        'emailOwner'     => 0,
                    ];

                    $row['viewsDetail']     = $psViewsDetailModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['whatsappClicks']  = $psWhatsappClicksModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['viewsSearch']     = $psViewsSearchModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['phoneCalls']      = $psOwnerCallsModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['sharedFB']        = $psSharedFacebookModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['copiedLink']      = $psLinkCopiedModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['sharedFriends']   = $psSharedFriendsModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['emailOwner']      = $psEmailOwnerModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
                    $row['savedFavorites']  = $psSavedFavoriteModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();

                    $row['viewsListings'] = $row['viewsDetail'] + $row['viewsSearch'];

                    foreach ($totals as $keyName => $val) {
                        $totals[$keyName] += $row[$keyName];
                    }

                    $chartData[] = $row;
                }

                $totalImpacts = $totals['viewsListings'] + $totals['whatsappClicks'] + $totals['phoneCalls'] + $totals['sharedFB'] + $totals['copiedLink'] + $totals['savedFavorites'] + $totals['sharedFriends'] + $totals['emailOwner'];
                $totalActions = $totals['whatsappClicks'] + $totals['phoneCalls'] + $totals['sharedFB'] + $totals['copiedLink'] + $totals['savedFavorites'] + $totals['sharedFriends'] + $totals['emailOwner'];

                $stats_json[$key] = [
                    'totalImpacts'    => $totalImpacts,
                    'totalActions'    => $totalActions,
                    'viewsListings'   => $totals['viewsListings'],
                    'viewsDetail'     => $totals['viewsDetail'],
                    'whatsappClicks'  => $totals['whatsappClicks'],
                    'phoneCalls'      => $totals['phoneCalls'],
                    'sharedFB'        => $totals['sharedFB'],
                    'copiedLink'      => $totals['copiedLink'],
                    'savedFavorites'  => $totals['savedFavorites'],
                    'viewsSearch'     => $totals['viewsSearch'],
                    'sharedFriends'   => $totals['sharedFriends'],
                    'emailOwner'      => $totals['emailOwner'],
                    'chartData'       => $chartData
                ];
            }
        }

        return view('app/statics', [
            'property'    => $property,
            'stats'       => [],
            'stats_json'  => $stats_json,
            'messages'    => $messages,
            "date_start" => $date_start,
            "date_end"   => $date_end,
        ]);


        // if (!$this->auth->isLoggedIn()) {
        //     return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        // }

        // $propertyModel = new PropertyModel();
        // $userFreeModel = new UserFreeModel();

        // // Modelos de estadísticas
        // $psViewsDetailModel     = new PsViewsDetailModel();
        // $psWhatsappClicksModel  = new PsWhatsappClicksModel();
        // $psViewsSearchModel     = new PsViewsSearchModel();
        // $psOwnerCallsModel      = new PsOwnerCallsModel();
        // $psSharedFacebookModel  = new PsSharedFacebookModel();
        // $psLinkCopiedModel      = new PsLinkCopiedModel();
        // $psSharedFriendsModel   = new PsSharedFriendsModel();
        // $psEmailOwnerModel      = new PsEmailOwnerModel();
        // $psSavedFavoriteModel   = new PsSavedFavoriteModel();
        // $psMessagesReceivedModel = new PsMessagesReceivedModel();

        // $date_start = $this->request->getGet("ds");
        // $date_end = $this->request->getGet("de");



        // // Buscar propiedad
        // $property = $propertyModel->where('reference', $reference)->first();

        // if (!$property) {
        //     return redirect()->back()->with('error', 'Propiedad no encontrada.');
        // }

        // $propertyId = $property['id'];

        // $messages = $psMessagesReceivedModel->where('property_id', $propertyId)->findAll();
        // // Enlazar los datos del usuario
        // foreach ($messages as &$msg) {
        //     $user = $userFreeModel->find($msg['user_free_id']);
        //     $msg['user'] = $user ?: [];
        // }

        // // Períodos a analizar: hoy, 7, 30, 90 días
        // $periods = ['0' => 1, '7' => 7, '30' => 30, '90' => 90];
        // $stats_json = [];

        // foreach ($periods as $key => $days) {
        //     $startDate = date('Y-m-d', strtotime("-" . ($days - 1) . " days"));
        //     $endDate = date('Y-m-d');
        //     $chartData = [];

        //     // Inicializar totales
        //     $totals = [
        //         'viewsListings'   => 0,
        //         'viewsDetail'     => 0,
        //         'whatsappClicks'  => 0,
        //         'phoneCalls'      => 0,
        //         'sharedFB'        => 0,
        //         'copiedLink'      => 0,
        //         'savedFavorites'  => 0,
        //         'viewsSearch'     => 0,
        //         'sharedFriends'   => 0,
        //         'emailOwner'      => 0,
        //     ];

        //     for ($i = 0; $i < $days; $i++) {
        //         $date = date('Y-m-d', strtotime("-" . ($days - 1 - $i) . " days"));
        //         $label = date('d/m/Y', strtotime($date));

        //         // Acumuladores diarios
        //         $row = [
        //             'date'           => $label,
        //             'viewsListings'  => 0,
        //             'viewsDetail'    => 0,
        //             'whatsappClicks' => 0,
        //             'phoneCalls'     => 0,
        //             'sharedFB'       => 0,
        //             'copiedLink'     => 0,
        //             'savedFavorites' => 0,
        //             'viewsSearch'    => 0,
        //             'sharedFriends'  => 0,
        //             'emailOwner'     => 0,
        //         ];

        //         // Recolectar datos diarios
        //         $row['viewsDetail']     = $psViewsDetailModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['whatsappClicks']  = $psWhatsappClicksModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['viewsSearch']     = $psViewsSearchModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['phoneCalls']      = $psOwnerCallsModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['sharedFB']        = $psSharedFacebookModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['copiedLink']      = $psLinkCopiedModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['sharedFriends']   = $psSharedFriendsModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['emailOwner']      = $psEmailOwnerModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();
        //         $row['savedFavorites']  = $psSavedFavoriteModel->where('property_id', $propertyId)->where('DATE(created_at)', $date)->countAllResults();

        //         // Simular "viewsListings" como suma de algunas acciones
        //         $row['viewsListings'] = $row['viewsDetail'] + $row['viewsSearch'];

        //         // Sumar totales
        //         foreach ($totals as $keyName => $val) {
        //             $totals[$keyName] += $row[$keyName];
        //         }

        //         $chartData[] = $row;
        //     }

        //     // Calcular totales generales para el período
        //     $totalImpacts = $totals['viewsListings'] + $totals['viewsDetail'] + $totals['viewsSearch'];
        //     $totalActions = $totals['whatsappClicks'] + $totals['phoneCalls'] + $totals['sharedFB'] + $totals['copiedLink'] + $totals['savedFavorites'] + $totals['sharedFriends'] + $totals['emailOwner'];

        //     $stats_json[$key] = [
        //         'totalImpacts'    => $totalImpacts,
        //         'totalActions'    => $totalActions,
        //         'viewsListings'   => $totals['viewsListings'],
        //         'viewsDetail'     => $totals['viewsDetail'],
        //         'whatsappClicks'  => $totals['whatsappClicks'],
        //         'phoneCalls'      => $totals['phoneCalls'],
        //         'sharedFB'        => $totals['sharedFB'],
        //         'copiedLink'      => $totals['copiedLink'],
        //         'savedFavorites'  => $totals['savedFavorites'],
        //         'viewsSearch'     => $totals['viewsSearch'],
        //         'sharedFriends'   => $totals['sharedFriends'],
        //         'emailOwner'      => $totals['emailOwner'],
        //         'chartData'       => $chartData
        //     ];
        // }

        // return view('app/statics', [
        //     'property'    => $property,
        //     'stats'       => [], // ya no se usa, si quieres puedes quitarlo
        //     'stats_json'  => $stats_json,
        //     'messages'    => $messages,
        //     "date_start" => $date_start,
        //     "date_end" => $date_end,
        // ]);
    }

}
