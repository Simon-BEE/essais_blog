<?php
namespace App;

use App\Model\Post;
use App\Model\Category;

class PaginatedQuery
{
    private $queryCount;
    private $query;
    private $classMapping;
    private $url;
    private $perPage;
    private $pdo;
    private $nbPage;
    private $currentPage;
    private $nbItems;
    private $count;

    public function __construct(string $queryCount, string $query, string $classMapping, string $url, int $perPage = 12)
    {
        $this->queryCount = $queryCount;
        $this->query = $query;
        $this->classMapping = $classMapping;
        $this->url = $url;
        $this->perPage = $perPage;
        $this->pdo = Connection::getPDO();
    }

    public function getItems(): ?array
    {
        $this->nbPage = $this->getNbPages();
        $this->currentPage = $this->getCurrentPage();

        if ($this->currentPage > $this->nbPage) {
            throw new \Exception('Pas de pages !');
        }

        if ($this->items === null) {
            $offset = ($this->currentPage - 1) * $this->perPage;
            $step1 = $this->pdo->query($this->query." LIMIT {$this->perPage} OFFSET {$offset}");
            $step1->setFetchMode(\PDO::FETCH_CLASS, $this->classMapping);
            $this->items = $step1->fetchAll();
        }
        return $this->items;
    }

    public function getNav():string
    {
        $test = '<nav class="navigation">';
        $test .= '<ul class="pagination">';
        for ($i = 1; $i <= $this->getNbPages(); $i++) :
                $this->url = $i == $this->url ? "" : "?page=" . $i;
                $test .= "<li><a href='{$this->url}'>{$i}</a></li>";
        endfor;
        $test .= '</ul></nav>';
        return $test;
    }

    public function getNavArray(): array
    {
        $uri = $this->url;
        $nbPage = $this->getNbPages();
        $navArray = [];
        for ($i = 1; $i <= $nbPage; $i++) {
            $url = $i == 1 ? $uri : $uri . "?page=" . $i;
            $navArray[$i] = $url;
        }
        return $navArray;
    }

    public function getNavHtml():string
    {
        $urls = $this->getNavArray();
        $html = "";
        foreach ($urls as $key => $url) {
            $class = $this->getCurrentPage() === $key ? "active" : "";
            $html .= "<li class=\"{$class}\"><a class=\"\" href=\"{$url}\">{$key}</a></li>";
        }
        return <<<HTML
            <nav class="navigation">
            <ul class="pagination">
                {$html}
            </ul>
            </nav>
HTML;
    }

    private function getNbPages():int
    {
        if ($this->count === null) {
            $this->count = $this->pdo->query($this->queryCount)->fetch()[0];
        }
        return (int)ceil($this->count / $this->perPage);
    }

    private function getCurrentPage():int
    {
        return URL::getPositiveInt('page', 1);
    }
}
