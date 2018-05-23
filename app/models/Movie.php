<?php

class Movie
{
    private $Database;
    private $db_table = 'movie_details';
    private $data;
    
    

    function __construct() {
        global $Database;
        $this->Database = $Database;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function get($title = null, $order = null, $page = null, $catagory = null)
    {
        

        if ($order == null) {
            $order = 'Title';
        }

        

        $data = array();

        if (is_array($title))
        {

        }
        else if ($title != null)
        {
            if ($stmt = $this->Database->prepare("SELECT 
            $this->db_table.Title,
            $this->db_table.Fulltitle,
            $this->db_table.Movie_year,
            $this->db_table.Catagory,
            $this->db_table.Summary,
            $this->db_table.Image_url,
            $this->db_table.IMBD_id,
            $this->db_table.IMBD_rating,
            $this->db_table.Runtime,
            $this->db_table.Language,
            $this->db_table.ytid
            FROM $this->db_table WHERE Title = ?"))
            {
                $stmt->bind_param("s", $title);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($title, $fulltitle, $movie_year, $catagory, $summary, $image_url, $IMBD_id, $IMBD_rating,
                                    $runtime, $language, $ytid);
                $stmt->fetch();

                if ($stmt->num_rows > 0)
                {
                    $data[] = array('title' => $title, 'full_title' => $fulltitle, 'movie_year' => $movie_year, 'catagory' => $catagory,
                                    'summary' => $summary, 'image_url' => $image_url, 'imbd_id' => $IMBD_id, 'imbd_rating' => $IMBD_rating,
                                    'runtime' => $runtime, 'language' => $language, 'ytid' => $ytid);
                }
                $stmt->close();
                return $data;
            }
        }
        else
        {
            $arrangement;
            if ($order == 'year') {
                $arrangement = 'DESC';
                $order = 'Movie_year';
            } else if ($order == 'year-oldest') {
                $arrangement = 'ASC';
                $order = 'Movie_year';
            } else if ($order == 'Title') {
                $arrangement = 'ASC';
            } else {
                $arrangement = 'DESC';
            }

            if ($catagory == 'Any') {
                $catagory = null;
            }
                
                if ($result = $this->Database->query("SELECT * FROM $this->db_table ORDER BY $order $arrangement")) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_array()) {
                            $data[] = array(
                                'title' => $row['Title'],
                                'year' => $row['Movie_year'],
                                'catagory' => $row['Catagory'],
                                'image_url' => $row['Image_url'],
                                'rating' => $row['IMBD_rating'],
                                'runtime' => $row['Runtime'],
                                'language' => $row['Language']
                            );
                        }

                        if ($catagory != 'Any' && $catagory != null) {
                            for ($i = 0; $i < count($data); $i++) {
                                if (! stristr($data[$i]['catagory'], $catagory)) {
                                    unset($data[$i]);
                                }
                            }
                        }

                        $result->close();
                        return $data;
                    }
                }
            }
        

        return $data;
        
    }

    /**
     * adds a new movie to the database
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function update($title, $fulltitle, $year, $catagory, $summary, $image, $id, $rating, $runtime, $language, $ytid)
    {
        if ($stmt = $this->Database->prepare("INSERT INTO $this->db_table VALUES(?,?,?,?,?,?,?,?,?,?,?)")) {
            $stmt->bind_param("ssisssiiiss", $title, $fulltitle, $year, $catagory, $summary, $image, $id, $rating, $runtime, $language, $ytid);
            $stmt->execute();
            $stmt->close();
        }
    }


    /**
     * builds html structure contaiing movie details to be displayed by the view
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function create_detail_view($title)
    {
        $movies = $this->get($title);

        $data = '';

        if (! empty($movies)){

            

            foreach ($movies as $movie) {

                $data .= '<h2 id="title">' . $movie['title'] . '</h2>';

                $data .= '<div class="row">';

                $data .= '<div class="col-sm-3 col-md-4">';
                $data .= '<img src="' . $movie['image_url'] . '" class="img-thumbnail">';
                $data .= '</div>';

                $data .= '<ul id="movie-info-list" class="col-sm-3 col-md-6 col-lg-9">';
                $data .= '<li id="realeased" class="movie-info-list-item"><strong>Released</strong>:  ' . $movie['movie_year'] . '</li>';
                $data .= '<li id="catagory" class="movie-info-list-item"><strong>Catagory:</strong> ' . $movie['catagory'] . '</li>';
                $data .= '<li id="runtime" class="movie-info-list-item"><strong>Runtime:</strong>   ' . $movie['runtime'] . ' mins</li>';
                $data .= '<li id="runtime" class="movie-info-list-item"><strong>Rating:</strong>   ' . $movie['imbd_rating'] . '</li>';
                $data .= '<li id="language" class="movie-info-list-item"><strong>Language:</strong> ' . $movie['language'] . '</li>';
                $data .= '</ul>';

                $data .= '</div>';
                $data .= '<h3>Summary</h3>';
                $data .= '<p>' .  $movie['summary']. '</p>';

                $data .= '<div class="embed-responsive embed-responsive-16by9">';
                $data .= '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . $movie['ytid'] . '?rel=0" allowfullscrean></iframe>';
                $data .= '</div>';

            }
        }
        return $data;
    }
        


    /**
     * builds html structure for 
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function create_list_view($order = null, $page, $catagory = null)
    {
        $movies = $this->get(null, $order, $page, $catagory);

        $per_page = 20; 

        $page = (int)$page;

        

        if (! empty($movies)) {

            $data = '';

            

            $total_results = count($movies);
            $total_pages = ceil($total_results / $per_page);

            if ($page > 0 && $page <= $total_pages) {
                $start = ($page - 1) * $per_page;
                $end = $start + $per_page;
            }
            else {
                $start = 0;
                $end = $per_page;
            }

            $prev_2 = $page - 2;
            $prev = $page - 1;
            $next = $page + 1;
            $next_2 = $page + 2;
            $last = $total_pages;


            // return $movies;

            for ($i = $start; $i < $end; $i++) {
                
                if (! isset($movies[$i])) { $end++; continue; }

                if (array_search($movies[$i], $movies) == $total_results) { break; }

                if ($page == $total_pages) { $end = $total_results - $start; }

                $data .= '<a style="color: black;" href="?title=' . $movies[$i]['title'] . '">';

                $data .= '<div class="row">';
                $data .= '<div class="col-sm-4 col-md-3 col-lg-2">';
                $data .= '<img src="' . $movies[$i]['image_url'] . '" class="img-thumbnail">';
                $data .= '</div>';

                $data .= '<div class="col-sm-8">';
                $data .= '<li class="list-group-item">';

                $data .= '<h3>' . $movies[$i]['title'] . '</h3>';

                $data .= '<div class="col-sm-4">';
                $data .= '<p><strong>Realesed: </strong>' . $movies[$i]['year'] . '</p>';
                $data .= '</div>';

                $data .= '<div class="col-sm-6">';
                $data .= '<p><strong>Catatgory: </strong>' . $movies[$i]['catagory'] . '</p>';
                $data .= '</div>';

                $data .= '<div class="col-sm-4">';
                $data .= '<p><strong>Runtime: </strong>' . $movies[$i]['runtime'] . '</p>';
                $data .= '</div>';

                $data .= '<div class="col-sm-4">';
                $data .= '<p><strong>Rating: </strong>' . $movies[$i]['rating'] . '</p>';
                $data .= '</div>';
                
                $data .= '</div></div>';

                $data .= '</li></a>';
            }

            $data .= '</ul>';

            $data .= '<div>';
            // create paginator
            if ($catagory == null) {
                $data .= '<ul class="pagination">';

            if ($page > 1) {
                $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . 1 . '">First Page</a></li>';
                $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $prev . '">Previous</a></li>';
                if ($page != 2) {
                    $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $prev_2 . '">' . $prev_2 . '</a></li>';
                }
                $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $prev . '">' . $prev . '</a></li>';
            }

            $data .= '<li class="page-item"><a class="page-link">' . $page . '</a></li>';
        

                if ($page != $total_pages) {
                    $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $next . '">' . $next . '</a></li>';
                    
                    if ($page != $total_pages - 1) {
                        $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $next_2 . '">' . $next_2 . '</a></li>';
                    }
                    $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $next . '">Next</a></li>';
                    $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $last . '">Last Page</a></li>';
                }

            $data .= '</ul>';
            $data .= '</div>';
            } else {
                $data .= '<ul class="pagination">';

                if ($page > 1) {
                    $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&catagory=' . $catagory . '&page=' . 1 . '">First Page</a></li>';
                    $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&page=' . $prev . '">Previous</a></li>';
                    if ($page != 2) {
                        $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&catagory=' . $catagory . '&page=' . $prev_2 . '">' . $prev_2 . '</a></li>';
                    }
                    $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&catagory=' . $catagory . '&page=' . $prev . '">' . $prev . '</a></li>';
                }

                $data .= '<li class="page-item"><a class="page-link">' . $page . '</a></li>';
            

                    if ($page != $total_pages) {
                        $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&catagory=' . $catagory . '&page=' . $next . '">' . $next . '</a></li>';
                        
                        if ($page != $total_pages - 1) {
                            $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&catagory=' . $catagory . '&page=' . $next_2 . '">' . $next_2 . '</a></li>';
                        }
                        $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&catagory=' . $catagory . '&page=' . $next . '">Next</a></li>';
                        $data .= '<li class="page-item"><a class="page-link" href="?order=' . $order . '&catagory=' . $catagory . '&page=' . $last . '">Last Page</a></li>';
                    }

                $data .= '</ul>';
                $data .= '</div>';
            }
            
            

        }
        else 
        {
            $data .= '<li>No results to display!</li>';
        }
        return $data;
    }

}

?>