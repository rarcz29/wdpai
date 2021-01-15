<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Technology.php';

class TechnologyRepository extends Repository
{
    public function getTechnologyByName(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM technologies
            WHERE LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}