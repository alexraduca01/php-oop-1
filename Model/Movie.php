<?php 

include __DIR__ . '/Genre.php';

class Movie 
{
    private $id;
    private $title;
    private $overview;
    private $vote_average;
    private $poster_path;

    public $genre;



    function __construct($id, $title, $overview, $vote_average, $poster_path, $genre)
    {
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote_average;
        $this->poster_path = $poster_path;
        $this->genre = $genre;
    }

    function printMovies()
    {
        $id = $this->id;
        $title = $this->title;
        $overview = substr($this->overview, 0, 100) . "...";
        $vote = $this->printStars();
        $poster = $this->poster_path;
        $genre = $this->genre;
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
$genreString = file_get_contents(__DIR__ . '/genre_db.json');

$movieList = json_decode($movieString, true);
$genreList = json_decode($genreString, true);

$genres = [];
$movies = [];

foreach($genreList as $genre){
    array_push($genres, $genre);
}

foreach($movieList as $item){
    $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path'], $genres[rand(0, count($genres) - 1)]);
}

?>