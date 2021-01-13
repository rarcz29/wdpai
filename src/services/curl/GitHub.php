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
                                        string $description, bool $private): ?Project
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
        $json = json_decode($output, true);

        if ($json['message'])
        {
            //TODO private repo
            echo $json['message'];
            die();
        }

        $project = new Project($title, $json['description'], '',
            'github', $json['private'], 0, 0, 0);
        $project->setOriginUrl($json['url']);
        $project->setRepoName($json['name']);
        return $project;
    }
}