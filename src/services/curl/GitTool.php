<?php

abstract class GitTool
{
    abstract public function exists(string $username, string $token);

    protected function get(string $url, string $username, string $token) : string
    {
        $curl = curl_init();
        $headers = $this->setHeaders($username, $token)

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }

//    protected function post()
//    {
//        $curl = curl_init();
//        $headers = $this->setHeaders($username, $token)
//
//        $post_fields = array(
//            "name" => "asdfasdfaa"
//        );
//
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($curl, CURLOPT_POST, count($post_fields));
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_fields));
//
//        $output = curl_exec($curl);
//        curl_close($curl);
//
//        echo $output;
//    }

    private function setHeaders(string $username, string $token) : array
    {
        return array(
            "User-Agent: ${username}",
            "Authorization: token ${token}",
            "Accept: application/vnd.github.v3+json"
        );
    }
}