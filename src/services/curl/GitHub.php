<?php

require_once 'GitToolApi.php';

class GitHub extends GitToolApi
{
    public function getUsername(array $header, string $username) : string
    {
        $output = $this->get("https://api.github.com/user", $header);
        $json = json_decode($output, true);
        return $json['login'];
    }

    public function createNewRepository(string $username, string $token, string $title,
                                        string $description, bool $private): ?Project
    {
        $headers = $this->setHeaders($username, $token);

        if ($this->getUsername($headers, $username) !== $username)
        {
            return null;// TODO
        }

        $postData = [
            "name" => $title,
            "description" => $description,
            "private" => $private,
            "auto_init" => true
        ];
        $output = $this->post("https://api.github.com/user/repos", $headers, $postData);
        $json = json_decode($output, true);

        if ($json['message'])
        {
            //TODO private repo
            echo $json['message'];
            die();
        }

        $project = new Project($title, $json['description'], '',
            'github', $json['private'], 0, 0, 0);
        $project->setOriginUrl($json['html_url']);
        $project->setRepoName($json['name']);
        return $project;
    }

    public function setHeaders(string $username, string $token) : array
    {
        return array(
            "User-Agent: ${username}",
            "Authorization: token ${token}",
            "Accept: application/vnd.github.v3+json"
        );
    }
}