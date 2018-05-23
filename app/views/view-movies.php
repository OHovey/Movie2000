<?php include('includes/header.php'); ?>

<nav class="filter-nav navbar navbar-expand navbar-light">
    <li class="navbar-item align-left" style="list-style: none;">Filter By:   </li>
    
    <form class="filter-form" action="" method="GET">
    <div class="row">
    <div class="col-sm-4">
    
        <select style="margin-top: 10px; margin-bottom: 7px; display: inline;" class="form-control" name="order" id="">
            <option value="year">Latest</option>
            <option value="year-oldest">Oldest first</option>
            <option value="rating">Rating</option>
            <option value="runtime">Runtime</option>
    </select>
    </div>
    <li class="navbar-item" style="list-style: none; margin-top: 14px;">Catagory</li>
    <div class="col-sm-3">
    
    
    <select class="form-control" style="display: inline; margin-top: 8px;" name="catagory" id="catagory">
        <option value="Any">Any</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Animation">Animation</option>
        <option value="Biography">Biography</option>
        <option value="Comedy">Comedy</option>
        <option value="Crime">Crime</option>
        <option value="Documentary">Documentary</option>
        <option value="Drama">Drama</option>
        <option value="Family">Family</option>
        <option value="Fantasy">Fantasy</option>
        <option value="History">History</option>
        <option value="Horror">Horror</option>
        <option value="Music">Music</option>
        <option value="Musical">Musical</option>
        <option value="Mystery">Mystery</option>
        <option value="News">News</option>
        <option value="Romance">Romance</option>
        <option value="Sci-Fi">Sci-Fi</option>
        <option value="Sport">Sport</option>
        <option value="Thriller">Thriller</option>
        <option value="War">War</option>
        <option value="Western">Western</option>


    </select>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-outline-primary" style="margin-top: 8px;">Filter</button>
    </div>
    <input style="display: none;" type="text" name="page" value="0">
    </div>
    </form>
    
</nav>

<div class="content">
    <ul class="movies-list list-group">
        <?php $this->get_data('movie_items'); ?>
    

    <?php $this->get_data('paginator') ?>
</div>

<?php include('includes/footer.php'); ?>