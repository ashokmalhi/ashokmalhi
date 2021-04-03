<?php

namespace App\Helper;

use Session;
use Auth;
use App\Models\Permission;

class Helper {

    static function callApi($api_name, $method = "GET", $postData = false, $contentType = 'json', $debug = false) {
        try {

            $url = env('API_URL', '') . '/' . $api_name;
            $ch = curl_init();
            $headers = array();

            if ($contentType == 'form-data') {
                $headers[] = "Content-Type: multipart/form-data";
            } else {
                $headers[] = "Content-Type: application/json";
            }

            $authToken = Session::get('authToken');
            if ($authToken) {
                $headers[] = "Authorization: Bearer " . $authToken;
            } else {
                $headers[] = "api-token: " . env('API_TOKEN');
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            //curl_setopt($ch, CURLOPT_FAILONERROR, true);
            // add for ssl local certificate isssue
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            //For Patch request
            if (strtolower($method) == 'patch') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            }
            if ($postData) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

                // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                if ($contentType == 'form-data') {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
                } else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
                }
            }
            $result = curl_exec($ch);
            // dd($result);
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
                Log::info("here", ["curl errror" => $error_msg]);
            }

            if ($debug) {
                pd($result);
            }

            $result = json_decode($result, TRUE);
            return $result;
            curl_close($ch);
            exit;
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    public static function check_permission($permission) {
        
        $permission_array = session()->get('user_permissions');
        $return = false;

        if (!$permission_array) {
            Permission::get_user_permissions(Auth::id());
            $permission_array = session()->get('user_permissions');
        }

        if (count($permission_array) > 0) {
            if (in_array($permission, $permission_array)) {
                $return = true;
                return $return;
            } else {
                return $return;
            }
        } else {
            //header('Location: '.config('constant.APP_URL'));
        }
    }

}
