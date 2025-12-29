<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Google_Client;
use Google_Service_Oauth2;

use CodeIgniter\API\ResponseTrait;
use App\Libraries\Auth;

use App\Models\PropertyModel;
use App\Models\PropertyAddressModel;
use App\Models\ServiceModel;
use App\Models\ServiceTypeModel;
use App\Models\ServiceTypesModel;
use App\Models\UserAddressModel;
use App\Models\MoreImagesModel;
use App\Models\UserModel;
use App\Models\PostVisitsModel;
use App\Models\UserFreeModel;
use App\Models\PropertyStatsModel;

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



class ApiController extends BaseController{
    use ResponseTrait;
    protected $propertyModel;
    protected $propertyAddressModel;
    protected $auth;

    public function __construct(){
        $this->propertyModel = new PropertyModel();
        $this->propertyAddressModel = new PropertyAddressModel();
        $this->auth = new Auth();
    }
    public function searchProperties(){
        $text_search = $this->request->getGet("text");
        $type_id = $this->request->getGet("type");
        $category_id = $this->request->getGet("category");
        
        $data = $this->propertyAddressModel;
        
        $counter = [];
        if (strlen($text_search) >= 3){
            $data_province = $data->like('province', trim($text_search))->findAll();
            foreach ($data_province as $dp) {
                $nombre = $dp["province"];    
                if (!isset($counter[$nombre])) {
                    $counter[$nombre] = 0;
                }
                
                $counter[$nombre]++;
            }
        }
        if (count($counter) > 2){
            $counter = array_slice($counter, 0, 2);
        }

        $data = $data->like('address', trim($text_search))->findAll();
        $address_counter = [];
        foreach($data as $da){
            $property_id = $da["property_id"];
            $state_property_type = true;
            $state_property_category = true;
            if (!empty($type_id)){
                $data_temp = $this->propertyModel->where("type_id", $type_id)->where("id", $property_id)->where("state_id", 4)->findAll();
                !empty($data_temp) ?  $state_property_type = true : $state_property_type = false;
            }
            if (!empty($category_id)){
                $data_temp = $this->propertyModel->where("category_id", $category_id)->where("id", $property_id)->where("state_id", 4)->findAll();
                !empty($data_temp) ?  $state_property_category = true : $state_property_category = false;
            }
            
            if ($state_property_type && $state_property_category){
                $address = $da["address"];
                if (!isset($address_counter[$address])) {
                    $address_counter[$address] = 0;
                }

                $address_counter[$address]++;
            }
            
        }

        $data_address = array_slice($address_counter, 0, 7);
    
        return $this->respond(["status" => 200, "data" => $data_address, "province" => $counter]);
    }

    public function searchServices(){
        $userAddressModel = new UserAddressModel();
        $userModel = new UserModel();
        $serviceTypesModel = new ServiceTypesModel();
        $serviceModel = new ServiceModel();

        $text_search = $this->request->getGet("text");
        $sti = $this->request->getGet("service_type");
        

        $data = $userAddressModel;
        
        $counter = [];
        if (strlen($text_search) >= 3){
            $data_province = $data->like('province', trim($text_search))->findAll();
            foreach ($data_province as $dp) {
                $nombre = $dp["province"];    
                if (!isset($counter[$nombre])) {
                    $counter[$nombre] = 0;
                }
                
                $counter[$nombre]++;
            }
        }
        if (count($counter) > 2){
            $counter = array_slice($counter, 0, 2);
        }

        $data = $data->like('address', trim($text_search))->findAll();
        $address_counter = [];
        foreach($data as $da){
            $user_id = $da["user_id"];
            $state_service_type = true;
            if (!empty($sti)){
                $data_temp_service = $serviceModel->where("user_id", $user_id)->findAll();
                if (empty($data_temp_service)){
                    continue;
                }
                $data_temp_service_types = $serviceTypesModel->where("service_type_id", $sti)->where("service_id", $data_temp_service[0]["id"])->findAll();
                !empty($data_temp_service_types) ?  $state_service_type = true : $state_service_type = false;
            }
            
            if ($state_service_type){
                $address = $da["address"];
                if (!isset($address_counter[$address])) {
                    $address_counter[$address] = 0;
                }

                $address_counter[$address]++;
            }
            
        }

        $data_address = array_slice($address_counter, 0, 7);
    
        return $this->respond(["status" => 200, "data" => $data_address, "province" => $counter]);
    }

    public function dataPropertiesForMap(){
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
        
        $data = $this->propertyAddressModel;
        
        $counter = [];
        
        if (count($counter) > 2){
            $counter = array_slice($counter, 0, 2);
        }

        $address_max = explode(",", $address);
        if (!empty($city) || !empty($province)){
            $data = $this->propertyAddressModel;
            if (!empty($province) && empty($city)){
                $data = $data->where("province", trim($province));
            }else if (!empty($city)){
                $data = $data->where("city", trim($city));
            }
            $data = $data->findAll();
        }else if (!empty($address)){
            if (count($address_max) == 2){
                $data = $data->like('address', trim($address))->orLike("address", $address_max[0])->orLike("city", $address_max[0])->orLike("province", $address_max[0])->findAll();
            }else{
                $data = $data->like('address', trim($address))->findAll();
            }
        }
        $data_properties = [];
        foreach($data as $da){
            $property_id = $da["property_id"];
            $property_temp = $this->propertyModel->where("id", $property_id);
            $priceField = ($category_id == 1) ? "rental_price" : "sale_price";
            if (!empty($type_id)){
                $property_temp = $property_temp->where("type_id", $type_id);
            }
            if (!empty($category_id)){
                $property_temp = $property_temp->where("category_id", $category_id);
            }
            if (!empty($p_min)){
                $property_temp = $property_temp->where("$priceField >=", $p_min);
            }
            if (!empty($p_max)){
                $property_temp = $property_temp->where("$priceField <=", $p_max);
            }
            if (!empty($built_min)){
                $property_temp = $property_temp->where("meters_built >=", $built_min);
            }
            if (!empty($built_max)){
                $property_temp = $property_temp->where("meters_built <=", $built_max);
            }
            if (!empty($num_min_bathrooms)){
                $property_temp = $property_temp->where("bathrooms >=", $num_min_bathrooms);
            }
            if (!empty($num_min_bedrooms)){
                $property_temp = $property_temp->where("bedrooms >=", $num_min_bedrooms);
            }
            $property_temp = $property_temp->findAll();
            if (!empty($property_temp)){
                array_push($data_properties, [
                    "id" => $property_temp[0]["reference"],
                    "title" => $property_temp[0]["title"],
                    "price" => !empty($property_temp[0]["sale_price"]) ? $property_temp[0]["sale_price"] : $property_temp[0]["rental_price"],
                    "lat" => $da["latitude"],
                    "lng" => $da["longitude"],
                ]);
            }
            
        }
    
        return $this->respond(["status" => 200, "data" => $data_properties]);
    }
    public function dataServicesForMap(){
        $serviceModel = new ServiceModel();
        $serviceTypeModel = new ServiceTypeModel();
        $serviceTypesModel = new ServiceTypesModel();
        $userAddressModel = new UserAddressModel();
        $userModel = new UserModel();

        $sti = $this->request->getGet("sti");
        $mode = $this->request->getGet("mode");
        $address = $this->request->getGet("address");
        

        $city = $this->request->getGet("city");
        $province = $this->request->getGet("province");
        
        $service_types = [];
        if (!empty($sti)){
            $sti = array_map("intval", $sti);
            $service_types = $serviceTypesModel->whereIn("service_type_id", $sti)->findColumn("service_id");
        }

        $data = $userAddressModel;
        
        $counter = [];
        
        if (count($counter) > 2){
            $counter = array_slice($counter, 0, 2);
        }

        $address_max = explode(",", $address);
        if (!empty($city) || !empty($province)){
            $data = $userAddressModel;
            if (!empty($province) && empty($city)){
                $data = $data->where("province", trim($province));
            }else if (!empty($city)){
                $data = $data->where("city", trim($city));
            }
            $data = $data->findAll();
        }else if (!empty($address)){
            if (count($address_max) == 2){
                $data = $data->like('address', trim($address))->orLike("address", $address_max[0])->orLike("city", $address_max[0])->orLike("province", $address_max[0])->findAll();
            }else{
                $data = $data->like('address', trim($address))->findAll();
            }
        }
        $data_properties = [];
        foreach($data as $da){
            $user_id = $da["user_id"];
            $user_temp = $userModel->find($user_id);
            $user_name_temp = "";
            if ($user_temp){
                $user_name_temp = $user_temp["first_name"];
                if (!empty($user_temp["last_name"])){
                    $user_name_temp =$user_name_temp .", ".$user_temp["last_name"];
                }
            }
            if (!empty($service_types)){
                $property_temp = $serviceModel->whereIn("id", array_map("intval", $service_types));
            }

            $property_temp = $serviceModel->where("user_id", $user_id);
            
            // if (!empty($type_id)){
            //     $property_temp = $property_temp->where("type_id", $type_id);
            // }
            
            $property_temp = $property_temp->findAll();
            if (!empty($property_temp)){
                array_push($data_properties, [
                    "id" => $property_temp[0]["id"],
                    "title" => $user_name_temp,
                    "lat" => $da["latitude"],
                    "lng" => $da["longitude"],
                ]);
            }
            
        }
    
        return $this->respond(["status" => 200, "data" => $data_properties]);
    }

    public function deleteMoreImage(){
        if (!$this->auth->isLoggedIn()){return $this->respond(["status"=>403]);}
        
        $user_id = session()->get("user_id");

        $moreImagesModel = new MoreImagesModel();

        $id = $this->request->getGet("id");
        
        $moreImagesModel->where("id", $id)->delete();

        return $this->respond(["status"=>200]);
    }

    // Control de visitas
    public function visitorRegister(){
        $postVisitsModel = new PostVisitsModel();

        $post_id = $this->request->getPost("post_id");
        $contacted = null;

        $ip_address = $this->request->getIPAddress();
        $referer = $_SERVER['HTTP_REFERER'] ?? null;

        $data = [
            "post_id" => $post_id,
            "ip_address" => $ip_address,
            "referer" => $referer,
            "contacted" => $contacted,
        ];

        $postVisitsModel->insert($data);
        $row_id = $postVisitsModel->getInsertID();

        return $this->respond(["status" => 200, "id" => $row_id]);
    }
    public function visitorContactedUpdate(){
        $postVisitsModel = new PostVisitsModel();

        $row_id = $this->request->getPost("row_id");
        if (!empty($row_id)){
            $postVisitsModel->set(["contacted" => 1])->where("id", $row_id)->update();
            return $this->respond(["status" => 200, "post_id" => $row_id]);
        }else{
            return $this->respond(["status" => 503, "post_id" => $row_id]);
        }

    }
    // Fin Control de visitas
    // Google oauth modal
    public function verifyTokenGoogleFloat(){
        $userFreeModel = new UserFreeModel();
        $client = new Google_Client(['client_id' => "916285583768-enj3t3n6c9esrggsn8giik6j541kbcjg.apps.googleusercontent.com"]);
        $token = $this->request->getPost('credential');

        try {
            $payload = $client->verifyIdToken($token);
            
            if ($payload) {
                $session = session();
                $userData = [
                    'id' => $payload['sub'],
                    'email' => $payload['email'],
                    'name' => $payload['name'] ?? 'Usuario Google',
                    'picture' => $payload['picture'] ?? '',
                    'logged_in' => true,
                ];
                
                // $session->set($userData);
                $data_user_free_temp = $userFreeModel->where("email", $payload['email'])->findAll();
                if (empty($data_user_free_temp)){
                    $userFreeModel->insert([
                        'email' => $payload['email'],
                        'name' => $payload['name'] ?? 'Usuario Google',
                        'photo' => $payload['picture'] ?? '',
                    ]);
                }
                return $this->response->setJSON([
                    'success' => true,
                    'user' => $userData
                ]);
            }
            
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Token inválido'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function sendEmailContactUser(){
        helper("email");
        $userFreeModel = new UserFreeModel();
        $PsMessagesReceivedModel = new PsMessagesReceivedModel();

        $user_email = $this->request->getPost("user_email");
        $user_name = $this->request->getPost("user_name");
        $provider_email = $this->request->getPost("provider_email");
        $message = $this->request->getPost("message");
        $property_link = $this->request->getPost("property_link");
        $template = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Correo Electrónico de Consulta de Propiedad</title><style>a{color:blue;}body {font-family: Arial, sans-serif;margin: 0;padding: 0;background-color: #f4f4f4;color: #333;line-height: 1.6;}.container {max-width: 600px;margin: 20px auto;padding: 20px;background-color: #fff;border-radius: 8px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);}p {margin-bottom: 16px;}.datos-contacto {margin-bottom: 20px;padding: 15px;border: 1px solid #ddd;border-radius: 8px;background-color: #f9f9f9;}.datos-contacto strong {color: #0078d7;}</style></head><body><div class="container"><div class="datos-contacto">
            <p><strong>Usuario:</strong> '. $user_name .'</p>
            <p><strong>Correo:</strong> '. $user_email .'</p>
            <p><strong>Mensaje:</strong> '. $message .'.</p>
            <a href="' .$property_link. '" target="_blank">'. $property_link .'</a></div></div></body></html>
        ';
        sendEmail($provider_email, "Un usuario se ha contactado con tigo", $template);        
        $data_user_free_temp = $userFreeModel->where("email", $user_email)->findAll();
        if (!empty($data_user_free_temp)){
            $user_free_id = $data_user_free_temp[0]["id"];
            $PsMessagesReceivedModel->insert([
                'property_id' => $this->request->getPost("property_id"),
                'user_free_id' => $user_free_id,
                'message' => $message,
            ]);
        }

    }
    
    public function sendEmailShare(){
        helper("email");
        $user_email = $this->request->getGet("user_emails");
        $emails = explode(",", $user_email);
        $property_link = $this->request->getGet("property_link");
        $template = '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>¡Mira este increíble inmueble que encontré!</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #ffffff;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding-bottom: 20px;
                        border-bottom: 1px solid #eee;
                    }
                    .header h1 {
                        color: #0056b3;
                        font-size: 24px;
                        margin: 0;
                    }
                    .content {
                        padding: 20px 0;
                    }
                    .content p {
                        margin-bottom: 15px;
                    }
                    .button-container {
                        text-align: center;
                        padding: 20px 0;
                    }
                    .button {
                        display: inline-block;
                        padding: 12px 25px;
                        background-color: #63c4ca;
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 5px;
                        font-size: 16px;
                    }
                    .footer {
                        text-align: center;
                        padding-top: 20px;
                        border-top: 1px solid #eee;
                        font-size: 12px;
                        color: #777;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>¡Mira este increíble inmueble que encontré!</h1>
                    </div>
                    <div class="content">
                        <p>Hola,</p>
                        <p>Espero que este correo te encuentre bien. Quería compartir contigo un inmueble que creo que te podría interesar.</p>
                        <p>Puedes ver todos los detalles en el siguiente enlace:</p>
                        <div class="button-container">
                            <a href="' . htmlspecialchars($property_link) . '" class="button" style="color: white;">Ver Inmueble Ahora</a>
                        </div>
                        <p>¡Espero que te guste!</p>
                        <p>Saludos cordiales,</p>
                        <p>Tu amigo/a</p>
                    </div>
                    <div class="footer">
                        <p>Este correo ha sido enviado porque un usuario ha compartido contigo un inmueble.</p>
                        <p>&copy; ' . date('Y') . ' Tu Sitio Web. Todos los derechos reservados.</p>
                    </div>
                </div>
            </body>
            </html>';

        foreach ($emails as $email) {
            $email = trim($email);
            sendEmail($email, "¡Mira este increíble inmueble que encontré!", $template);
        }

        // You might want to return a response to the client indicating success
        return $this->response->setJSON(['status' => 'success', 'message' => 'Emails sent successfully']);
    }
    public function propertyStatsConfig(){
        $property_id = $this->request->getPost('_i');
        $ip_address = $this->request->getIPAddress();

        $fieldModelMap = [
            'views_detail'      => new PsViewsDetailModel(),
            'whatsapp_clicks'   => new PsWhatsappClicksModel(),
            'views_search'      => new PsViewsSearchModel(),
            'owner_calls'       => new PsOwnerCallsModel(),
            'shared_facebook'   => new PsSharedFacebookModel(),
            'link_copied'       => new PsLinkCopiedModel(),
            'shared_friends'    => new PsSharedFriendsModel(),
            'email_owner'       => new PsEmailOwnerModel(),
            'saved_favorite'    => new PsSavedFavoriteModel(),
        ];

        foreach ($fieldModelMap as $field => $model) {
            if ($this->request->getPost($field)) {
                $existing = $model->where('property_id', $property_id)
                                ->where('ip_address', $ip_address)
                                ->first();

                if (!$existing) {
                    $model->insert([
                        'property_id' => $property_id,
                        'ip_address'  => $ip_address,
                        'counter'     => 1
                    ]);
                }

                break; // Solo se permite un campo por request
            }
        }

        return $this->respond(["status" => 200]);
    }

}
