<?php

$url = "https://api.github.com/user/repos";
$username = "xxxxxx";
$password = "xxxxxx";
$auth_data = base64_encode("${username}:${password}");

$curl = curl_init();

$headers = array(
    "User-Agent: ${username}",
    "Authorization: Basic ${auth_data}",
    "Accept: application/vnd.github.v3+json"
);

$post_fields = array(
    "name" => "asdfasdf"
);

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, count($post_fields));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_fields));

$output = curl_exec($curl);
curl_close($curl);

echo $output;