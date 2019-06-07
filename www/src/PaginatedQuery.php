<?php
namespace App;
use App\Model\{Post, Category};

class PaginatedQuery{
    private $queryCount;
    private $query;
    private $classMapping;
    private $url;
    private $perPage;
    private $pdo;
    private $nbPage;

    public function __construct(string $queryCount, string $query, string $classMapping, string $url, int $perPage = 12){
        $this->queryCount = $queryCount;
        $this->query = $query;
        $this->classMapping = $classMapping;
        $this->url = $url;
        $this->perPage = $perPage;
        $this->pdo = Connection::getPDO();
    }

    public function getItems(): ?array{
        $nbPost = $this->pdo->query($this->queryCount)->fetch()[0];
        $this->nbPage = ceil($nbPost / $this->perPage);
        if ((int)$_GET['page'] > $this->nbPage) {
            throw new \Exception ('Pas de pages !');
        }
        if (isset($_GET['page'])) {
            $currentPage = (int)$_GET['page'];
        }else{
            $currentPage = 1;
        }
        $offset = ($currentPage - 1) * $this->perPage;
        $step1 = $this->pdo->query($this->query." LIMIT {$this->perPage} OFFSET {$offset}");
        $step1->setFetchMode(\PDO::FETCH_CLASS, $this->classMapping);
        return $step1->fetchAll();
    }

    public function getNav(){
        $test = '<nav class="navigation">';
        $test .= '<ul class="pagination">';
        for ($i = 1; $i <= $this->nbPage; $i++) :
            $this->url .= $i == 1 ? "" : "?page=" . $i;
        $test .= "<li><a href='{$this->url}'>{$i}</a></li>";
        endfor;
        $test .= '</ul></nav>';
        return $test;
    }
}