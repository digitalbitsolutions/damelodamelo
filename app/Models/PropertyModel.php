<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table      = 'property';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'reference',
        'title', 
        'description', 
        'meters_built', 
        'useful_meters', 
        'plot_meters',
        'm_long',
        'm_wide', 
        'land_size', 
        'plant', 
        'number_of_plants', 
        'emissions_consumption', 
        'energy_consumption', 
        'sale_price', 
        'rental_price', 
        'garage_price',
        'community_expenses', 
        'year_of_construction', 
        'bedrooms', 
        'bathrooms', 
        'rooms', 
        'elevator', 
        'appropriate_for_children', 
        'pet_friendly', 
        'linear_meters_of_facade', 
        'stays', 
        'number_of_shop_windows', 
        'has_tenants', 
        'max_num_tenants', 
        'bank_owned_property', 
        'guarantee', 
        'ibi', 
        'mortgage_rate', 
        'parking', 
        'interior_wheelchair', 
        'outdoor_wheelchair', 
        'wheelchair_accessible_elevator', 
        'locality', 
        'address', 
        'number', 
        'esc_block', 
        'name_urbanization', 
        'door', 
        'zip_code', 
        'close_to', 
        'page_url', 
        'state_id', 
        'user_id', 'type_id', 'category_id', 'features_id', 'city_id', 'province_id', 'country_id', 'typology_id', 'orientation_id', 'type_heating_id', 'emissions_rating_id', 'energy_class_id', 'state_conservation_id', 'visibility_in_portals_id', 'rental_type_id', 'contact_option_id', 'power_consumption_rating_id', 'reason_for_sale_id', 'plant_id', 'door_id', 'facade_id', 'plaza_capacity_id', 'type_of_terrain_id', 'wheeled_access_id', 'nearest_municipality_distance_id', 
        'heating_fuel_id',
        'location_premises_id',
        'garage_price_category_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}