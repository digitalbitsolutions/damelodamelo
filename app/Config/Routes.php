<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Page::index');
$routes->get('/result', 'Page::resultAll');
$routes->get('/result/services', 'Page::resultAllServices');
$routes->get('/result_maps', 'Page::resultMaps');
$routes->get('/result/([a-zA-Z0-9]+)', 'Page::result/$1');
$routes->get('/result_service/([a-zA-Z0-9]+)', 'Page::resultService/$1');
$routes->get('/login', 'Page::login');
$routes->post('/login/validate', 'Page::loginValidate');
$routes->get('/login/close_session', 'Page::logout');
$routes->post('/signup', 'Page::signup');
$routes->get('/validate_account', 'Page::validateAccountPage');
$routes->post('/validate_code', 'Page::validateAccount');
$routes->get("/policy_and_privacy", "Page::PolicyAndPrivacy");

$routes->get('/home', 'HomeController::index');
$routes->get('/post/index', 'PostController::index');
$routes->get('/post/details/([a-zA-Z0-9]+)', 'PostController::postDetails/$1');
$routes->get('/post/create_form/([a-zA-Z0-9]+)', 'PostController::createForm/$1');
$routes->get("/post/my_posts", "PostController::myPosts");
$routes->post("/post/create", "PostController::create");
$routes->post("/post/update", "PostController::update");
$routes->get('/post/update_form/([a-zA-Z0-9]+)', 'PostController::updateForm/$1');
$routes->get("/post/delete", "PostController::delete");
$routes->get("/post/disabledenabled", "PostController::disabledEnabled");

$routes->get("/post/services", "PostController::services");
$routes->get("/post/services/delete", "PostController::servicesDelete");
$routes->get('/post/services/update_form/([a-zA-Z0-9]+)', 'PostController::servicesUpdate/$1');
$routes->post('/post/services/update/save', 'PostController::servicesUpdateSave');
$routes->post("/post/create_service", "PostController::createService");

$routes->get("/post/blogs", "BlogController::index");
$routes->get("/post/blogs/create", "BlogController::createBlog");
$routes->post("/post/blogs/article/save", "BlogController::saveArticle");

$routes->get("/blogs", "BlogController::showAll");
$routes->get("/blogs/(:segment)", "BlogController::showArticle/$1");

$routes->get("/users", "UserController::index");
$routes->get("/users/([a-zA-Z0-9]+)", "UserController::userView/$1");

$routes->get("/user/update", "UserController::update");
$routes->post("/user/update/save", "UserController::updateSave");
$routes->get("/user/delete", "UserController::userDelete");

$routes->get("/api/properties", "ApiController::searchProperties");
$routes->get("/api/services", "ApiController::searchServices");
$routes->get("/api/properties_for_map", "ApiController::dataPropertiesForMap");
$routes->get("/api/services_for_map", "ApiController::dataServicesForMap");
$routes->get("/api/delete_more_image", "ApiController::deleteMoreImage");
$routes->post("/api/visitor/save", "ApiController::visitorRegister");
$routes->post("/api/visitor/contacted", "ApiController::visitorContactedUpdate");
$routes->post("/api/google/user/verify_token_google", "ApiController::verifyTokenGoogleFloat");
$routes->post("/api/send/message/email_to_provider", "ApiController::sendEmailContactUser");
$routes->get("/api/send/message/email_share", "ApiController::sendEmailShare");
$routes->post("/api/property_stats/register", "ApiController::propertyStatsConfig");