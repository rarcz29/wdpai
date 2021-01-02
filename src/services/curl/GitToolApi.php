<?php

abstract class GitToolApi
{
    abstract public function getNodeId(string $username, string $token) : ?string;
    abstract public function createNewRepository(string $username, string $token,
                                                 string $title, string $description,
                                                 bool $private);

    protected function get(string $url, string $username, string $token) : string
    {
        $curl = curl_init();
        $headers = $this->setHeaders($username, $token);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }

    protected function post(string $url, string $username, string $token, array $postFields)
    {
        $curl = curl_init();
        $headers = $this->setHeaders($username, $token);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, count($postFields));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postFields));

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }

    private function setHeaders(string $username, string $token) : array
    {
        return array(
            "User-Agent: ${username}",
            "Authorization: token ${token}",
            "Accept: application/vnd.github.v3+json"
        );
    }
}