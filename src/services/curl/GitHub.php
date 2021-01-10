<?php

require_once 'GitToolApi.php';

class GitHub extends GitToolApi
{
    public function getUsername(string $token) : string
    {
        $output = $this->get("https://api.github.com/user", "cnode", $token);
        $json = json_decode($output, true);
        return $json['login'];
    }

    // TODO: this method should return bool
    public function createNewRepository(string $username, string $token, string $title,
                                        string $description, bool $private): ?array
    {
        if ($this->getUsername($token) !== $username)
        {
            return null;
        }

        $postData = array(
            "name" => $title,
            "description" => $description,
            "private" => $private,
            "auto_init" => true
        );
        $output = $this->post("https://api.github.com/user/repos", $username, $token, $postData);
        $json = json_decode($output, true)['svn_url'];

        if ($json['message'] !== null)
        {
            return null;
        }

        return array(
            'name' => $json['name'],
            'url' => $json['svn_url']
        );
    }
}