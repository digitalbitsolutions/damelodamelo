<?php

namespace App\Controllers;

use App\Libraries\Auth;
use App\Models\PostVisitsModel;
use App\Models\PropertyModel;
use App\Models\TypeModel;

class HomeController extends BaseController{
    protected $auth;
    public function __construct(){
        $this->auth = new Auth();
    }
    public function index(){
        if (!$this->auth->isLoggedIn()){return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');}
        $postVisitsModel = new PostVisitsModel();
        $propertyModel = new PropertyModel();
        $typeModel = new TypeModel();


        $user_id = session()->get("user_id");
        $user_level = session()->get("user_level_id");

        $number_of_visits = 0;
        $number_of_visitors = 0;
        $number_of_times_contacted = 0;
        $data_types = [];

        if ($user_level == 5 || $user_level == 1){
            $property_ids = $propertyModel->where("user_id", $user_id)->findColumn("id");
            if (!empty($property_ids)){
                $property_ids = array_map("intval", $property_ids);
        
                $post_visits = $postVisitsModel->whereIn("post_id", $property_ids)->findAll();
                $number_of_visits = count($post_visits);
                $ip_address_all = array_column($post_visits, "ip_address");
                $ip_address_unique = array_unique($ip_address_all);
                $number_of_visitors = count($ip_address_unique);
                $number_of_times_contacted = 0;
                foreach($post_visits as $rw){
                    if ($rw["contacted"] == 1){
                        $number_of_times_contacted += 1;
                    }
                }
                $property_ids = array_column($post_visits, "post_id");
                $types_id = [];
                foreach($property_ids as $pr_id){
                    if (!empty($pr_id)){
                        $res_temp = $propertyModel->find($pr_id);
                        if (!empty($res_temp)){
                            array_push($types_id, $res_temp["type_id"]);
                        }
                    }
                }
    
                $types_id_ass = array_count_values($types_id);
                foreach($types_id_ass as $key => $value){
                    if (!empty($key)){
                        $rest_temp = $typeModel->find($key);
                        if (!empty($rest_temp)){
                            array_push($data_types, [$rest_temp["name"] => $value]);
                        }
                    }
                }
            }
        }
        
        
        return view('app/home', ["number_of_visits" => $number_of_visits, "number_of_visitors" => $number_of_visitors, "number_of_times_contacted" => $number_of_times_contacted, "data_types" => $data_types]);
    }
}
