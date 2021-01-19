<?php

abstract class GitToolApi
{
    abstract public function getUsername(array $headers, string $username);
    abstract public function createNewRepository(string $username, string $token,
                                                 string $title, string $description,
                                                 bool $private);
    abstract public function setHeaders(string $username, string $token) : array;

    protected function get(string $url, array $headers) : string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }

    protected function post(string $url, array $headers, array $postFields): string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, count($postFields));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postFields));

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }


}