<?php 

class Movie 
{
    private int $id;
    private string $title;
    private string $overview;
    private float $vote_average;
    private string $poster_path;


    function __construct(int $id, string $title, string $overview, float $vote_average, string $poster_path)
    {
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote_average;
        $this->poster_path = $poster_path;
    }

    function printMovies()
    {
        $id = $this->id;
        $title = $this->title;
        $overview = substr($this->overview, 0, 100) . "...";
        $vote_average = $this->vote_average;
        $poster_path = $this->poster_path;
        include __DIR__ . '/../Views/card.php';
    }
    
}

$movieString = file_get_contents(__DIR__ . '/movie_db.json');
$movieList = json_decode($movieString, true);
$movies = [];

foreach($movieList as $item){
    $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path']);
}

?>