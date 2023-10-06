<?php

function get_req($store)
{

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $store,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $dec_data = json_decode($response, true);
    if ($dec_data) {
        return $dec_data['products'];
    } else {
        return 'something went wrong Please check Internet Connectivity';
    }
}

function getProduct($store, $id)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores where store_name='$store'");
    $store = $qry->row()->store_api;
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/';
        $post_url .= $get_store[1] . '/products/' . $id . '.json';
    }
    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $dec_data = json_decode($response, true);

    return $dec_data;
}
function update_req($store, $data)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $store);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function update_meta($store, $data)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $store);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function isInArray($filter, $tags2)
{
    foreach ($tags2 as $key => $value) {
        // if(in_array($value,$arr1)){
        //     return true;
        // }
        if (binarySearch($filter, $value) == true) {
            return true;
        }
    }
    return false;
}

function getpostUrl($store_name, $product_id)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores where store_name='$store_name'");

    $store = $qry->row()->store_api;
    $post_url = '';

    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        //$get_first_name[0] == $store_name
        if ($store_name) {
            $get_store[4] = 'products/' . $product_id . '.json';
            $post_url = $get_store_name[0] . '@';
            $post_url .= $get_store[0] . '/';
            $post_url .= $get_store[1] . '/';
            $post_url .= $get_store[2] . '/';
            $post_url .= $get_store[3] . '/';
            $post_url .= $get_store[4];
        }
    }

    return $post_url;
}
function metaupdateUrl($store_name, $product_id)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores where store_name='$store_name'");

    $store = $qry->row()->store_api;
    $post_url = '';

    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        //$get_first_name[0] == $store_name
        if ($store_name) {
            $get_store[4] = 'products/' . $product_id . '/metafields.json';
            $post_url = $get_store_name[0] . '@';
            $post_url .= $get_store[0] . '/';
            $post_url .= $get_store[1] . '/';
            $post_url .= $get_store[2] . '/';
            $post_url .= $get_store[3] . '/';
            $post_url .= $get_store[4];
        }
    }

    return $post_url;
}

function get_metafields($store_name)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores where store_name='$store_name'");

    $store = $qry->row()->store_api;
    $post_url = '';

    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        //$get_first_name[0] == $store_name
        if ($store_name) {
            $get_store[4] = 'metafields.json';
            $post_url = $get_store_name[0] . '@';
            $post_url .= $get_store[0] . '/';
            $post_url .= $get_store[1] . '/';
            $post_url .= $get_store[2] . '/';
            $post_url .= $get_store[3] . '/';
            $post_url .= $get_store[4];
        }
    }
    echo $post_url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $post_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}


function get_order($order_id, $bytype = "name")
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    //18008969999
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        $get_store[4] = 'orders/' . $order_id . '.json';
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/';
        $post_url .= $get_store[1] . '/orders.json?' . $bytype . '=' . $order_id . '';
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $dec_data = json_decode($response, true);

    if ($dec_data) {
        return $dec_data;
    } else {
        return [];
    }
}
function get_single_order($order_id)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    //18008969999
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        $get_store[4] = 'orders/' . $order_id . '.json';
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/';
        $post_url .= $get_store[1] . '/orders/' . $order_id . '.json';
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $dec_data = json_decode($response, true);
    if ($dec_data) {
        return $dec_data["order"];
    } else {
        return [];
    }
}
function get_custom_url($order_id)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    //18008969999
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        $get_store[4] = 'orders/' . $order_id . '.json';
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/';
        $post_url .= $get_store[1] . '/orders/' . $order_id . '/refunds.json';
    }
    return $post_url;
}
function get_calculate($order_id)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    //18008969999
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $get_first_name = explode('-', $get_store[0]);
        $get_store[4] = 'orders/' . $order_id . '.json';
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/';
        $post_url .= $get_store[1] . "/api/2022-07/orders/$order_id/refunds/calculate.json";
        //$post_url .= $get_store[1] . '/orders/' . $order_id . '/transactions.json';
    }
    // var_dump($post_url);
    // exit;
    return $post_url;
}
function create_fulfillment_order_status($order_id, $tracking_no, $line_item_id, $line_item_qty)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/admin/api/2021-10/orders/' . $order_id . '/fulfillments.json';
    }

    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "fulfillment": {
            "location_id": 61634314300,
            "tracking_number": null,
              "tracking_url": "https://shiprocket.co/tracking/' . $tracking_no . '",
            "line_items": [
              {
                "id": ' . $line_item_id . ',
                "quantity": ' . $line_item_qty . '
              }
            ]
          }
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));

    $dec_data = json_decode($response, true);
    if (!array_key_exists('errors', $dec_data)) {
        return $dec_data;
    } else {
        return $dec_data["errors"];
    }
}

function update_fulfillment_order_status($fulfillment_id, $tracking_no, $courier_name, $line_item_qty)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/admin/api/2021-10/fulfillments/' . $fulfillment_id . '/update_tracking.json';
    }

    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "fulfillment": {
              "notify_customer": true,
              "tracking_info": {
                "number": "' . $tracking_no . '",
                "url": "http:\\/\\/www.shiprocket.co/tracking/' . $tracking_no . '",
                "company": ' . $courier_name . '
              }
            }
          }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));
    $dec_data = json_decode($response, true);
    if (!empty($dec_data) && !array_key_exists('errors', $dec_data)) {
        return $dec_data;
    } else {
        if (!empty($dec_data)) {
            return $dec_data["errors"];
        }
    }
}

function cancel_fulfillment($order_id, $fulfillment_id)
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/admin/api/2021-10/orders/' . $order_id . '/fulfillments/' . $fulfillment_id . 'cancel.json';
    }
    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));
    $dec_data = json_decode($response, true);
    if (!array_key_exists('errors', $dec_data)) {
        return $dec_data;
    } else {
        return $dec_data["errors"];
    }
}

function create_gift_card($data = array())
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/admin/api/2022-01/gift_cards.json';
    }
    // echo "<pre>";
    // print_r($post_url);
    // exit;
    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"gift_card":{"initial_value":25.0}}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
    ));
    var_dump($response);
    exit;
    /** CURLOPT_POSTFIELDS => '{"gift_card":{"note":"' . $data['note'] . '","initial_value": 100.0 ,"code":"' . $data['code'] . '","template_suffix":"gift_cards.birthday.liquid"}}', */
    $dec_data = json_decode($response, true);
    if (!array_key_exists('errors', $dec_data)) {
        return $dec_data;
    } else {
        return $dec_data["errors"];
    }
}
/** not using these three function  create_fulfillment_service,
 * get_fulfillment_id,
 * cancel_nonfulfillment_order*/
function create_fulfillment_service()
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/' . $get_store[1] . '/' . $get_store[2] . '/' . $get_store[3];
        $post_url .=  '/fulfillment_services.json';
    }
    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $dec_data = json_decode($response, true);
    if (empty($dec_data)) {
        $response = curl_req(array(
            CURLOPT_URL => $post_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"fulfillment_service":{"name":"Jupiter Fulfillment","callback_url":"http://google.com","inventory_management":true,"tracking_support":true,"requires_shipping_method":true,"format":"json"}}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $dec_data = json_decode($response, true);
        if ($dec_data) {
            return $dec_data;
        } else {
            return [];
        }
    } else {
        return $dec_data;
    }
}
function get_fulfillment_id($order_id)
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    //$order_id = 4291621814332;
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/' . $get_store[1] . '/' . $get_store[2] . '/' . $get_store[3];
        $post_url .=  '/orders/' . $order_id . '/fulfillment_orders.json';
    }
    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $dec_data = json_decode($response, true);
    if ($dec_data) {
        // var_dump($dec_data);
        // exit;
        // $ids = array_column($dec_data['fulfillment_orders'], 'line_items');
        // $ids = array_column($ids[0], 'fulfillment_order_id');
        return $dec_data;
    } else {
        return [];
    }
}
function cancel_nonfulfillment_order($order_id)
{

    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select store_api from stores limit 1");
    $store = $qry->row()->store_api;
    //18008969999
    $post_url = '';
    if (!empty($store)) {
        $get_store_name = explode('@', $store);
        $get_store = explode('/', $get_store_name[1]);
        $post_url = $get_store_name[0] . '@';
        $post_url .= $get_store[0] . '/' . $get_store[1] . '/' . $get_store[2] . '/' . $get_store[3];
        $post_url .=  '/fulfillment_orders/' . $order_id . '/cancel.json';
    }
    $response = curl_req(array(
        CURLOPT_URL => $post_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $dec_data = json_decode($response, true);
    if ($dec_data) {
        return $dec_data;
    } else {
        return [];
    }
}
function get_duplicates($array)
{
    return array_unique(array_diff_assoc($array, array_unique($array)));
}
function unique_multidim_array($array, $key)
{
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

function dd($params)
{
    echo "<pre>";
    print_r($params);
    exit;
}

function fabric_option()
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select * from front_options where option_name ='Fabric' or option_name ='fabric'");
    if ($qry->num_rows > 0) {
        foreach ($qry->result() as $result) {
            var_dump($result);
            if ($result->option_name == "Fabric") {
                $arr = json_decode($result->option_values, true);
            }
        }
    } else {
        $arr = [
            '' => 'n/a',
        ];
    }
    $output = '';
    foreach ($arr as $key => $value) {
        $output .= '<div class="form-check form-check-inline">
        <input  type="checkbox" class="form-check-input"  name="fabric[]" id="' . $key . '" value="' . $key . '">
        <label class="form-check-label" for="' . $key . '">' . $key . '</label>
      </div>';
    }
    return $output;
}
function colors_option()
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select * from front_options where option_name ='Colors' or option_name ='colors'");
    if ($qry->num_rows > 0) {
        foreach ($qry->result() as $result) {
            if ($result->option_name == "Colors") {
                $arr = json_decode($result->option_values, true);
            }
        }
    } else {
        $arr = [
            '' => 'n/a',
        ];
    }
    $output = '';
    foreach ($arr as $key => $value) {
        $output .= '<option value="' . $value . '">' . $value . '</option>';
    }
    return $output;
}
function season_option()
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select * from front_options where option_name ='Season' or option_name ='season'");
    if ($qry->num_rows > 0) {
        foreach ($qry->result() as $result) {
            if ($result->option_name == "Season") {
                $arr = json_decode($result->option_values, true);
            }
        }
    } else {
        $arr = [
            '' => 'n/a',
        ];
    }
    $output = '';
    foreach ($arr as $key => $value) {
        $output .= '<option value="' . $value . '">' . $value . '</option>';
    }
    return $output;
}
function occasion_option()
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery("select * from front_options where option_name ='Occasion' or option_name ='occasion'");
    if ($qry->num_rows > 0) {
        foreach ($qry->result() as $result) {
            if ($result->option_name == "Occasion") {
                $arr = json_decode($result->option_values, true);
            }
        }
    } else {
        $arr = [
            '' => 'n/a',
        ];
    }
    $output = '';
    foreach ($arr as $key => $value) {
        $output .= '<option value="' . $value . '">' . $value . '</option>';
    }
    return $output;
}
function encode_url($string)
{

    $CI = &get_instance();
    $CI->load->library('encryption');
    $ret = $CI->encryption->encrypt($string);
    return str_replace(array('+', '/', '='), array('-', '_', '~'), $ret);
}

function decode_url($string)
{
    $CI = &get_instance();
    $CI->load->library('encryption');
    $ret = str_replace(array('-', '_', '~'), array('+', '/', '='), $string);
    return $CI->encryption->decrypt($ret);
}

function get_roles($id)
{
    $res = '';
    //$arr = [];
    $CI = &get_instance();

    $CI = &get_instance();
    $CI->load->model('global_model');
    $arr = $CI->global_model->customeQuery("select `role` from `tbl_roles` where `roleId`='$id'");
    if ($arr->num_rows() > 0) {
        foreach ($arr->result() as $row) {
            $res = $row->role;
        }
        return $res;
    } else {
        return 'Unknown Role';
    }
}

function get_username($id)
{
    $res = '';
    $CI = &get_instance();
    $CI->load->model('global_model');
    $arr = $CI->global_model->customeQuery("select `full_name` from `tbl_users` where `userId`='$id'");
    if ($arr->num_rows() > 0) {
        return $arr->row()->full_name;
    } else {
        return 'Unknown User';
    }
}



function multi_rename_key(&$array, $old_keys, $new_keys)
{
    if (!is_array($array)) {
        ($array == "") ? $array = array() : false;
        return $array;
    }
    foreach ($array as &$arr) {
        if (is_array($old_keys)) {
            foreach ($new_keys as $k => $new_key) {
                (isset($old_keys[$k])) ? true : $old_keys[$k] = NULL;
                $arr[$new_key] = (isset($arr[$old_keys[$k]]) ? $arr[$old_keys[$k]] : null);
                unset($arr[$old_keys[$k]]);
            }
        } else {
            $arr[$new_keys] = (isset($arr[$old_keys]) ? $arr[$old_keys] : null);
            unset($arr[$old_keys]);
        }
    }
    return $array;
}

function curl_req($request = array())
{
    $curl = curl_init();
    curl_setopt_array($curl, $request);
    $response = curl_exec($curl);
    // $info = curl_getinfo($curl);
    // echo "<pre>";
    // print_r($info);exit;
    // $data = curl_exec($curl);
    // if (curl_errno($curl)) {
    //     $data .= 'Retrieve Base Page Error: ' . curl_error($curl);
    // } else {
    //     $skip = intval(curl_getinfo($curl, CURLINFO_HEADER_SIZE));
    //     $head = substr($data, 0, $skip);
    //     $data = substr($data, $skip);
    //     $info = curl_getinfo($curl);
    //     $info = var_export($info, true);
    // }
    // echo $head;
    // echo $info;
    curl_close($curl);
    return $response;
}

function get_option($string)
{
    $CI = &get_instance();
    $CI->load->model('global_model');
    $qry = $CI->global_model->customeQuery('select * from `front_options` where option_name="' . $string . '"');
    $result = array();
    if ($qry->num_rows() > 0) {
        foreach ($qry->result() as $key => $value) {
            $result['status'] = $value->status;
            $result['data'] = json_decode($value->option_values);
        }
        return $result;
    }
    return false;
}

function pure_decimal($number)
{
    if (is_numeric($number) and floor($number) != $number) {
        //decimal detected
        $explode = explode('.', $number);
        $first_no = $explode['0'];
        $second_no = $explode['1'];
        $get_only_two = substr($second_no, 0, 2);
        $final_no = $first_no . '.' . $get_only_two;
        $final_no = ($final_no * 1);
    } else {
        //normal
        $final_no = $number;
    }
    return $final_no;
}



function clean_mobile_no($mobile)
{
    $shipping_no =  isset($mobile) && !empty($mobile) ? str_replace(" ", "", $mobile) : null;
    $shipping_no = $shipping_no != null ? str_replace("+91", "", $mobile) : null;
    $shipping_no = trim($shipping_no);
    $shipping_no = str_replace(" ", "", $shipping_no);
    $shipping_no = (int)$shipping_no;
    return  $shipping_no;
}

function binarySearch(array $arr, $x)
{
    // check for empty array
    if (count($arr) === 0) return false;
    $low = 0;
    $high = count($arr) - 1;

    while ($low <= $high) {

        // compute middle index
        $mid = floor(($low + $high) / 2);

        // element found at mid
        if ($arr[$mid] == $x) {
            return true;
        }

        if ($x < $arr[$mid]) {
            // search the left side of the array
            $high = $mid - 1;
        } else {
            // search the right side of the array
            $low = $mid + 1;
        }
    }

    // If we reach here element x doesnt exist
    return false;
}

function server_data_table($request, $table, $where, $valid_columns = array())
{

    $CI = &get_instance();
    if ($table == "temp_order") {
        $total_rows = $CI->global_model->customeQuery('SELECT COUNT(id) as total_id from ' . $table . ' WHERE  tags!="Pending" and `isDeleted` IN(0,2)');
    } else {
        $total_rows = $CI->global_model->customeQuery('SELECT COUNT(id) as total_id from ' . $table . '');
    }
    $result = array();
    extract($request);
    $search =  $search['value'];
    $col = 0;
    $dir = "";
    if (!empty($order)) {
        foreach ($order as $or) {
            $col = $or['column'];
            $dir = $or['dir'];
        }
    }
    if ($dir != "asc" && $dir != 'desc') {
        $dir = "desc";
    }
    if (!isset($valid_columns[$col])) {
        $order = 'id';
    } else {
        $order = $valid_columns[$col];
    }
    if ($order != null) {
        $CI->db->order_by($order, $dir);
    } else {
        $CI->db->order_by('id', 'desc');
    }
    if (!empty($where)) {
        if ($table == "temp_order") {
            //$CI->db->where_in('gateway',array("Cash on Delivery (COD)","cash_on_delivery"));
            $CI->db->where("tags !=", "Pending");
            $CI->db->where_in('isDeleted', $where);
        } else {
            if (array_key_exists('operator', $where)) {
                foreach ($where as $k => $v) {
                    if ($k != 'operator') {
                        $CI->db->where_in($k, $v);
                    }
                }
            } else {
                $CI->db->where($where);
            }/**/
        }
    }
    if (!empty($search)) {
        /** add where with search to show only new and partial order */
        if ($table == "temp_order") {
            $CI->db->where_in('isDeleted', $where);
        } else {
            $CI->db->where($where);
        }
        $x = 0;
        foreach ($valid_columns as $cols) {
            if ($x == 0) {
                $CI->db->like($cols, $search);
            } else {
                $CI->db->or_like($cols, $search);
            }
            $x++;
        }
    }
    $CI->db->limit($length, $start);
    $qry = $CI->db->get($table);
    $result['result'] =  $qry->result();
    $result['total_records'] = $total_rows->row()->total_id;
    return $result;
}

/* helper func for sorting the order by address and phone*/
function order_by_address_phone($a, $b)
{
    return $a["address1"] = $b["address1"];
}


function explodable($symbol, $string)
{
    $a = explode($symbol, $string);
    if (count($a) > 1) {
        return true;
    }
    return false;
}


function add_cron_log($data)
{
    $CI = &get_instance();
    $result = $CI->global_model->insert('cron_job', array(
        'date' => time(),
        'status' => json_encode($data)
    ));
    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}
function add_notification($store, $order_id)
{
    $CI = &get_instance();
    $result = $CI->db->insert_batch('notifications', array(
        'store' => $store,
        'order_id' => $order_id,
        'created_at' => time()
    ));
    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

function add_to_blacklist($mobile_no)
{
    $CI = &get_instance();
    $result = $CI->db->insert('blacklist', array(
        'mobile' => $mobile_no,
        'created_at' => time()
    ));
    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}
function is_blacklist($mobile_no)
{
    $CI = &get_instance();
    $qry = $CI->global_model->customeQuery('select * from `blacklist` where mobile="' . $mobile_no . '"');
    if ($qry->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
function site_option($name){
    $CI =&get_instance();
    $qry = $CI ->global_model->customeQuery('select option_value from options where option_name="'.$name.'"');
    return  $qry->result();

}

function all_icons(){
    return  $icons = array(
         "addons"=>"icofont-addons",
         "address-book"=>"icofont-address-book",
         "adjust"=>"icofont-adjust",
         "alarm"=>"icofont-alarm",
         "anchor"=>"icofont-anchor",
         "archive"=>"icofont-archive",
         "at"=>"icofont-at",
         "attachment"=>"icofont-attachment",
         "audio"=>"icofont-audio",
         "automation"=>"icofont-automation",
         "badge"=>"icofont-badge",
         "bag"=>"icofont-bag",
         "bag-alt"=>"icofont-bag-alt",
         "ban"=>"icofont-ban",
         "bar-code"=>"icofont-bar-code",
         "bars"=>"icofont-bars",
         "basket"=>"icofont-basket",
         "battery-empty"=>"icofont-battery-empty",
         "battery-full"=>"icofont-battery-full",
         "battery-half"=>"icofont-battery-half",
         "battery-low"=>"icofont-battery-low",
         "beaker"=>"icofont-beaker",
         "beard"=>"icofont-beard",
         "bed"=>"icofont-bed",
         "bell"=>"icofont-bell",
         "beverage"=>"icofont-beverage",
         "bill"=>"icofont-bill",
         "bin"=>"icofont-bin",
         "binary"=>"icofont-binary",
         "binoculars"=>"icofont-binoculars",
         "bluetooth"=>"icofont-bluetooth",
         "bomb"=>"icofont-bomb",
         "book-mark"=>"icofont-book-mark",
         "box"=>"icofont-box",
         "briefcase"=>"icofont-briefcase",
         "broken"=>"icofont-broken",
         "bucket1"=>"icofont-bucket1",
         "bucket2"=>"icofont-bucket2",
         "bucket"=>"icofont-bucket",
         "bug"=>"icofont-bug",
         "building"=>"icofont-building",
         "bulb-alt"=>"icofont-bulb-alt",
         "bullet"=>"icofont-bullet",
         "bullhorn"=>"icofont-bullhorn",
         "bullseye"=>"icofont-bullseye",
         "calendar"=>"icofont-calendar",
         "camera"=>"icofont-camera",
         "camera-alt"=>"icofont-camera-alt",
         "card"=>"icofont-card",
         "cart"=>"icofont-cart",
         "cart-alt"=>"icofont-cart-alt",
         "cc"=>"icofont-cc",
         "charging"=>"icofont-charging",
         "chat"=>"icofont-chat",
         "check"=>"icofont-check",
         "check-alt"=>"icofont-check-alt",
         "check-circled"=>"icofont-check-circled",
         "checked"=>"icofont-checked",
         "children-care"=>"icofont-children-care",
         "clip"=>"icofont-clip",
         "clock-time"=>"icofont-clock-time",
         "close"=>"icofont-close",
         "close-circled"=>"icofont-close-circled",
         "close-line"=>"icofont-close-line",
         "close-line-circled"=>"icofont-close-line-circled",
         "close-line-squared"=>"icofont-close-line-squared",
         "close-line-squared-alt"=>"icofont-close-line-squared-alt",
         "close-squared"=>"icofont-close-squared",
         "close-squared-alt"=>"icofont-close-squared-alt",
         "cloud"=>"icofont-cloud",
         "cloud-download"=>"icofont-cloud-download",
         "cloud-refresh"=>"icofont-cloud-refresh",
         "cloud-upload"=>"icofont-cloud-upload",
         "code"=>"icofont-code",
         "code-not-allowed"=>"icofont-code-not-allowed",
         "comment"=>"icofont-comment",
         "compass"=>"icofont-compass",
         "compass-alt"=>"icofont-compass-alt",
         "computer"=>"icofont-computer",
         "connection"=>"icofont-connection",
         "console"=>"icofont-console",
         "contacts"=>"icofont-contacts",
         "contrast"=>"icofont-contrast",
         "copyright"=>"icofont-copyright",
         "credit-card"=>"icofont-credit-card",
         "crop"=>"icofont-crop",
         "crown"=>"icofont-crown",
         "cube"=>"icofont-cube",
         "cubes"=>"icofont-cubes",
         "dashboard"=>"icofont-dashboard",
         "dashboard-web"=>"icofont-dashboard-web",
         "data"=>"icofont-data",
         "database"=>"icofont-database",
         "database-add"=>"icofont-database-add",
         "database-locked"=>"icofont-database-locked",
         "database-remove"=>"icofont-database-remove",
         "delete"=>"icofont-delete",
         "diamond"=>"icofont-diamond",
         "dice"=>"icofont-dice",
         "dice-multiple"=>"icofont-dice-multiple",
         "disc"=>"icofont-disc",
         "diskette"=>"icofont-diskette",
         "document-folder"=>"icofont-document-folder",
         "download"=>"icofont-download",
         "download-alt"=>"icofont-download-alt",
         "downloaded"=>"icofont-downloaded",
         "drag1"=>"icofont-drag1",
         "drag2"=>"icofont-drag2",
         "drag3"=>"icofont-drag3",
         "drag"=>"icofont-drag",
         "earth"=>"icofont-earth",
         "ebook"=>"icofont-ebook",
         "edit"=>"icofont-edit",
         "eject"=>"icofont-eject",
         "email"=>"icofont-email",
         "envelope"=>"icofont-envelope",
         "envelope-open"=>"icofont-envelope-open",
         "eraser"=>"icofont-eraser",
         "error"=>"icofont-error",
         "excavator"=>"icofont-excavator",
         "exchange"=>"icofont-exchange",
         "exclamation"=>"icofont-exclamation",
         "exclamation-circle"=>"icofont-exclamation-circle",
         "exclamation-square"=>"icofont-exclamation-square",
         "exclamation-tringle"=>"icofont-exclamation-tringle",
         "exit"=>"icofont-exit",
         "expand"=>"icofont-expand",
         "external"=>"icofont-external",
         "external-link"=>"icofont-external-link",
         "eye"=>"icofont-eye",
         "eye-alt"=>"icofont-eye-alt",
         "eye-blocked"=>"icofont-eye-blocked",
         "eye-dropper"=>"icofont-eye-dropper",
         "favourite"=>"icofont-favourite",
         "fax"=>"icofont-fax",
         "file-fill"=>"icofont-file-fill",
         "film"=>"icofont-film",
         "filter"=>"icofont-filter",
         "fire"=>"icofont-fire",
         "fire-alt"=>"icofont-fire-alt",
         "fire-burn"=>"icofont-fire-burn",
         "flag"=>"icofont-flag",
         "flag-alt-1"=>"icofont-flag-alt-1",
         "flag-alt-2"=>"icofont-flag-alt-2",
         "flame-torch"=>"icofont-flame-torch",
         "flash"=>"icofont-flash",
         "flash-light"=>"icofont-flash-lig,ht",
         "flask"=>"icofont-flask",
         "focus"=>"icofont-focus",
         "folder"=>"icofont-folder",
         "folder-open"=>"icofont-folder-open",
         "foot-print"=>"icofont-foot-print",
         "garbage"=>"icofont-garbage",
         "gear"=>"icofont-gear",
         "gear-alt"=>"icofont-gear-alt",
         "gears"=>"icofont-gears",
         "gift"=>"icofont-gift",
         "glass"=>"icofont-glass",
         "globe"=>"icofont-globe",
         "graffiti"=>"icofont-graffiti",
         "grocery"=>"icofont-grocery",
         "hand"=>"icofont-hand",
         "hanger"=>"icofont-hanger",
         "hard-disk"=>"icofont-hard-disk",
         "heart"=>"icofont-heart",
         "heart-alt"=>"icofont-heart-alt",
         "history"=>"icofont-history",
         "home"=>"icofont-home",
         "horn"=>"icofont-horn",
         "hour-glass"=>"icofont-hour-glass",
         "id"=>"icofont-id",
         "image"=>"icofont-image",
         "inbox"=>"icofont-inbox",
         "infinite"=>"icofont-infinite",
         "info"=>"icofont-info",
         "info-circle"=>"icofont-info-circle",
         "info-square"=>"icofont-info-square",
         "institution"=>"icofont-institution",
         "interface"=>"icofont-interface",
         "invisible"=>"icofont-invisible",
         "jacket"=>"icofont-jacket",
         "jar"=>"icofont-jar",
         "jewlery"=>"icofont-jewlery",
         "karate"=>"icofont-karate",
         "key"=>"icofont-key",
         "key-hole"=>"icofont-key-hole",
         "label"=>"icofont-label",
         "lamp"=>"icofont-lamp",
         "layers"=>"icofont-layers",
         "layout"=>"icofont-layout",
         "leaf"=>"icofont-leaf",
         "leaflet"=>"icofont-leaflet",
         "learn"=>"icofont-learn",
         "lego"=>"icofont-lego",
         "lens"=>"icofont-lens",
         "letter"=>"icofont-letter",
         "letterbox"=>"icofont-letterbox",
         "library"=>"icofont-library",
         "license"=>"icofont-license",
         "life-bouy"=>"icofont-life-bouy",
         "life-buoy"=>"icofont-life-buoy",
         "life-jacket"=>"icofont-life-jacket",
         "life-ring"=>"icofont-life-ring",
         "light-bulb"=>"icofont-light-bulb",
         "lighter"=>"icofont-lighter",
         "lightning-ray"=>"icofont-lightning-ray",
         "like"=>"icofont-like",
         "line-height"=>"icofont-line-height",
         "link"=>"icofont-link",
         "link-alt"=>"icofont-link-alt",
         "list"=>"icofont-list",
         "listening"=>"icofont-listening",
         "listine-dots"=>"icofont-listine-dots",
         "listing-box"=>"icofont-listing-box",
         "listing-number"=>"icofont-listing-number",
         "live-support"=>"icofont-live-support",
         "location-arrow"=>"icofont-location-arrow",
         "location-pin"=>"icofont-location-pin",
         "lock"=>"icofont-lock",
         "login"=>"icofont-login",
         "logout"=>"icofont-logout",
         "lollipop"=>"icofont-lollipop",
         "long-drive"=>"icofont-long-drive",
         "look"=>"icofont-look",
         "loop"=>"icofont-loop",
         "luggage"=>"icofont-luggage",
         "lunch"=>"icofont-lunch",
         "lungs"=>"icofont-lungs",
         "magic"=>"icofont-magic",
         "magic-alt"=>"icofont-magic-alt",
         "magnet"=>"icofont-magnet",
         "mail"=>"icofont-mail",
         "mail-box"=>"icofont-mail-box",
         "male"=>"icofont-male",
         "map"=>"icofont-map",
         "map-pins"=>"icofont-map-pins",
         "maximize"=>"icofont-maximize",
         "measure"=>"icofont-measure",
         "medicine"=>"icofont-medicine",
         "mega-phone"=>"icofont-mega-phone",
         "megaphone"=>"icofont-megaphone",
         "megaphone-alt"=>"icofont-megaphone-alt",
         "memorial"=>"icofont-memorial",
         "memory-card"=>"icofont-memory-card",
         "mic"=>"icofont-mic",
         "mic-mute"=>"icofont-mic-mute",
         "military"=>"icofont-military",
         "mill"=>"icofont-mill",
         "minus"=>"icofont-minus",
         "minus-circle"=>"icofont-minus-circle",
         "minus-square"=>"icofont-minus-square",
         "mobile-phone"=>"icofont-mobile-phone",
         "molecule"=>"icofont-molecule",
         "money"=>"icofont-money",
         "moon"=>"icofont-moon",
         "mop"=>"icofont-mop",
         "muffin"=>"icofont-muffin",
         "mustache"=>"icofont-mustache",
         "navigation"=>"icofont-navigation",
         "navigation-menu"=>"icofont-navigation-menu",
         "network"=>"icofont-network",
         "network-tower"=>"icofont-network-tower",
         "news"=>"icofont-news",
         "newspaper"=>"icofont-newspaper",
         "no-smoking"=>"icofont-no-smoking",
         "not-allowed"=>"icofont-not-allowed",
         "notebook"=>"icofont-notebook",
         "notepad"=>"icofont-notepad",
         "notification"=>"icofont-notification",
         "numbered"=>"icofont-numbered",
         "opposite"=>"icofont-opposite",
         "optic"=>"icofont-optic",
         "options"=>"icofont-options",
         "package"=>"icofont-package",
         "page"=>"icofont-page",
         "paint"=>"icofont-paint",
         "paper-plane"=>"icofont-paper-plane",
         "paperclip"=>"icofont-paperclip",
         "papers"=>"icofont-papers",
         "pay"=>"icofont-pay",
         "penguin-linux"=>"icofont-penguin-linux",
         "pestle"=>"icofont-pestle",
         "phone"=>"icofont-phone",
         "phone-circle"=>"icofont-phone-circle",
         "picture"=>"icofont-picture",
         "pine"=>"icofont-pine",
         "pixels"=>"icofont-pixels",
         "plugin"=>"icofont-plugin",
         "plus"=>"icofont-plus",
         "plus-circle"=>"icofont-plus-circle",
         "plus-square"=>"icofont-plus-square",
         "polygonal"=>"icofont-polygonal",
         "power"=>"icofont-power",
         "price"=>"icofont-price",
         "print"=>"icofont-print",
         "puzzle"=>"icofont-puzzle",
         "qr-code"=>"icofont-qr-code",
         "queen"=>"icofont-queen",
         "question"=>"icofont-question",
         "question-circle"=>"icofont-question-circle",
         "question-square"=>"icofont-question-square",
         "quote-left"=>"icofont-quote-left",
         "quote-right"=>"icofont-quote-right",
         "random"=>"icofont-random",
         "recycle"=>"icofont-recycle",
         "refresh"=>"icofont-refresh",
         "repair"=>"icofont-repair",
         "reply"=>"icofont-reply",
         "reply-all"=>"icofont-reply-all",
         "resize"=>"icofont-resize",
         "responsive"=>"icofont-responsive",
         "retweet"=>"icofont-retweet",
         "road"=>"icofont-road",
         "robot"=>"icofont-robot",
         "royal"=>"icofont-royal",
         "rss-feed"=>"icofont-rss-feed",
         "safety"=>"icofont-safety",
         "sale-discount"=>"icofont-sale-discount",
         "satellite"=>"icofont-satellite",
         "send-mail"=>"icofont-send-mail",
         "server"=>"icofont-server",
         "settings"=>"icofont-settings",
         "settings-alt"=>"icofont-settings-alt",
         "share"=>"icofont-share",
         "share-alt"=>"icofont-share-alt",
         "share-boxed"=>"icofont-share-boxed",
         "shield"=>"icofont-shield",
         "shopping-cart"=>"icofont-shopping-cart",
         "sign-in"=>"icofont-sign-in",
         "sign-out"=>"icofont-sign-out",
         "signal"=>"icofont-signal",
         "site-map"=>"icofont-site-map",
         "smart-phone"=>"icofont-smart-phone",
         "soccer"=>"icofont-soccer",
         "sort"=>"icofont-sort",
         "sort-alt"=>"icofont-sort-alt",
         "space"=>"icofont-space",
         "spanner"=>"icofont-spanner",
         "speech-comments"=>"icofont-speech-comments",
         "speed-meter"=>"icofont-speed-meter",
         "spinner"=>"icofont-spinner",
         "spinner-alt-1"=>"icofont-spinner-alt-1",
         "spinner-alt-2"=>"icofont-spinner-alt-2",
         "spinner-alt-3"=>"icofont-spinner-alt-3",
         "spinner-alt-4"=>"icofont-spinner-alt-4",
         "spinner-alt-5"=>"icofont-spinner-alt-5",
         "spinner-alt-6"=>"icofont-spinner-alt-6",
         "spreadsheet"=>"icofont-spreadsheet",
         "square"=>"icofont-square",
         "ssl-security"=>"icofont-ssl-security",
         "star"=>"icofont-star",
         "star-alt-1"=>"icofont-star-alt-1",
         "star-alt-2"=>"icofont-star-alt-2",
         "street-view"=>"icofont-street-view",
         "support-faq"=>"icofont-support-faq",
         "tack-pin"=>"icofont-tack-pin",
         "tag"=>"icofont-tag",
         "tags"=>"icofont-tags",
         "tasks"=>"icofont-tasks",
         "tasks-alt"=>"icofont-tasks-alt",
         "telephone"=>"icofont-telephone",
         "telescope"=>"icofont-telescope",
         "terminal"=>"icofont-terminal",
         "thumbs-down"=>"icofont-thumbs-down",
         "thumbs-up"=>"icofont-thumbs-up",
         "tick-boxed"=>"icofont-tick-boxed",
         "tick-mark"=>"icofont-tick-mark",
         "ticket"=>"icofont-ticket",
         "tie"=>"icofont-tie",
         "toggle-off"=>"icofont-toggle-off",
         "toggle-on"=>"icofont-toggle-on",
         "tools"=>"icofont-tools",
         "tools-alt-2"=>"icofont-tools-alt-2",
         "touch"=>"icofont-touch",
         "traffic-light"=>"icofont-traffic-light",
         "transparent"=>"icofont-transparent",
         "tree"=>"icofont-tree",
         "unique-idea"=>"icofont-unique-idea",
         "unlock"=>"icofont-unlock",
         "unlocked"=>"icofont-unlocked",
         "upload"=>"icofont-upload",
         "upload-alt"=>"icofont-upload-alt",
         "usb"=>"icofont-usb",
         "usb-drive"=>"icofont-usb-drive",
         "vector-path"=>"icofont-vector-path",
         "verification-check"=>"icofont-verification-check",
         "wall"=>"icofont-wall",
         "wall-clock"=>"icofont-wall-clock",
         "wallet"=>"icofont-wallet",
         "warning"=>"icofont-warning",
         "warning-alt"=>"icofont-warning-alt",
         "water-drop"=>"icofont-water-drop",
         "web"=>"icofont-web",
         "wheelchair"=>"icofont-wheelchair",
         "wifi"=>"icofont-wifi",
         "wifi-alt"=>"icofont-wifi-alt",
         "world"=>"icofont-world",
         "zigzag"=>"icofont-zigzag",
         "zipped"=>"icofont-zipped",
     );
     //return $icons;
 }
//   function hooks(){
//     include(APPPATH.'libraries/php-hooks.php');
//     global $hooks;
//     return $hooks;
//   }