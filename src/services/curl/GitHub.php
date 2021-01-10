<?php

require_once 'GitToolApi.php';

class GitHub extends GitToolApi
{
    // TODO: remove comments
//    public function getNodeId(string $username, string $token) : ?string
//    {
//        $output = $this->get("https://api.github.com/user", $username, $token);
//        $json = json_decode($output, true);
//        return $json['login'] === $username ? $json['node_id'] : null;
//    }

    // TODO: this method should return bool
    public function createNewRepository(string $username, string $token, string $title,
                                        string $description, bool $private): string
    {
        $postData = array(
            "name" => $title,
            "description" => $description,
            "private" => $private,
            "auto_init" => true
        );
        $output = $this->post("https://api.github.com/user/repos", $username, $token, $postData);
        return json_decode($output, true)['svn_url'];
    }
}