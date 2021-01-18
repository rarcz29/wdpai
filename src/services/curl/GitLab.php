<?php

require_once 'GitToolApi.php';

class GitLab extends GitToolApi
{
    public function getUsername(array $header, string $username) : string
    {
        $output = $this->get("https://gitlab.com/api/v4/users?username=".$username, $header);
        $json = json_decode($output, true);
        return $json[0]['username'];
    }

    public function createNewRepository(string $username, string $token, string $title,
                                        string $description, bool $private): ?Project
    {
        $headers = $this->setHeaders($username, $token);

        if ($this->getUsername($headers, $username) !== $username)
        {
            return null;
        }

        $postData = array(
            "name" => $title,
            "description" => $description,
            "visibility" => $private ? 'private' : 'public'
        );
        $output = $this->post("https://gitlab.com/api/v4/projects", $headers, $postData);
        $json = json_decode($output, true);

        if ($json['message'])
        {
            return null;
        }

        $visibility = $json['visibility'] === 'private';
        $project = new Project($title, $json['description'], '',
            'gitlab', $visibility, 0, 0, 0);
        $project->setOriginUrl($json['web_url']);
        $project->setRepoName($json['name']);
        return $project;
    }

    public function setHeaders(string $username, string $token) : array
    {
        return array(
            "Content-Type: application/json",
            "PRIVATE-TOKEN: ${token}"
        );
    }
}