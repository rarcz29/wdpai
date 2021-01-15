<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Technology.php';

class TechnologyRepository extends Repository
{
    public function getTechnologyByName(string $searchString): ?array
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM technologies
            WHERE LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $technologies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $array = null;

        foreach ($technologies as $technology)
        {
            array[] = new Technology($technology['id'], $technology['description']);
        }

        return array;
    }
}