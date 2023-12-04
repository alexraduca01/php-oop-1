<?php 

class Movie 
{
    private $id;
    private $title;
    private $overview;
    private $vote_average;
    private $poster_path;


    function __construct($id, $title, $overview, $vote_average, $poster_path)
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
        $vote = $this->printStars();
        $poster = $this->poster_path;
        include __DIR__ . '/../View/card.php';
    }

    function printStars()
    {
        $vote = ceil($this->vote_average / 2);
        $template = "<p class='m-0'>";
        for($n = 1; $n <= 5; $n++){
            $template .= $n <= $vote ? '<i class="fa-solid text-warning fa-star"></i>' : '<i class="fa-regular text-warning fa-star"></i>';
        }
        $template .= "</p>";
        return $template;
    }
    
}

$movieString = file_get_contents(__DIR__ . '/movie_db.json');
$movieList = json_decode($movieString, true);
$movies = [];

foreach($movieList as $item){
    $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path']);
}

?>