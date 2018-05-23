<?php

include('app/init.php');

if (isset($_GET['title']))
{
    // echo '<pre>';
    // print_r($Movie->create_detail_view($_GET['title']));
    // echo '</pre>';

    // $data = $Movie->get(trim($_GET['title']));
    // $img = $data[0]['image_url'];
    // $Template->set_data('img', $img);
    
    $display = $Movie->create_detail_view($_GET['title']);
    $Template->set_data('movie_details', $display);
    $Template->load('app/views/view-movie.php', 'movie_details');
}
else if (isset($_GET['page']))
{
    if (isset($_GET['order']) && ! isset($_GET['catagory']) || isset($_GET['order']) && $_GET['catagory'] == 'Any' ) 
    {
        if ($_GET['order'] == 'rating') {
            $_GET['order'] = 'IMBD_rating';
        }
        else if ($_GET['order'] == 'runtime') {
            $_GET['order'] = 'Runtime';
        }
        $display = $Movie->create_list_view($_GET['order'], $_GET['page']);
        $Template->set_data('movie_items', $display);
    }
    else if (isset($_GET['order']) && $_GET['catagory'] != 'Any')
    {
        if ($_GET['order'] == 'rating') {
            $_GET['order'] = 'IMBD_rating';
        }
        else if ($_GET['order'] == 'runtime') {
            $_GET['order'] = 'Runtime';
        }
        $display = $Movie->create_list_view($_GET['order'], $_GET['page'], $_GET['catagory']);
        $Template->set_data('movie_items', $display);
    }
    else 
    {
        $display = $Movie->create_list_view(null, $_GET['page']);
        $Template->set_data('movie_items', $display);
    }

    $Template->load('app/views/view-movies.php', 'Movies');

}
else
{
    $Template->redirect('index.php');
}

