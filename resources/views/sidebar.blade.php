<?php
$pages = App\Models\tbl_menu_category::where('role', Auth::user()->role_id)->value('pages');
$string = explode(",",$pages);
?>
    <div class="left">
     <div class="item">
        <i class="fas fa-fw fa-bars"></i>Menu
     </div>
              @foreach($string as $str)
              <?php
                $url = App\Models\tbl_menu::where('id', $str)->value('url');
                $m = App\Models\tbl_menu::where('id', $str)->value('menu_category');
              ?>
 <div class="item">
     <a href="{{route($url)}}" style="color: white;font-size: 15px;"><i class='fas fa-fw fa-share'style="color: white;font-size:10px;"></i>{{$m}}</a>
    </div>

            @endforeach
    </div>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<style>
    .left,
    .right {
        top: 10%;
        float: left;
    }

    .left {
        background: #ffae00;
        display: inline-block;
        white-space: nowrap;
        width: 50px;
        transition: width .5s;
    }

    .right {
        background: #fff;
        width: 350px;
        transition: width 1s;
        border-style: solid;
        border-color: #ccc;
        border-width: 1px;
    }

    .left:hover {
        width: 250px;
    }

    .item:hover {
        background-color: #475e80;
    }

    .left .fas {
        margin: 15px;
        width: 20px;
        color: #fff;
    }

    i.fas {
        font-size: 14px;
        vertical-align: middle !important;
    }

    .item {
        height: 40px;
        overflow: hidden;
        color: #fff;
    }


</style>
