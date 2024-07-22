<?php require_once 'app/views/templates/header.php' ?>
<style>
    .container-main {
        margin-top: 20px;
        padding: 0px 50px;
    }

    .ratings-header {
        text-align: center;
    }

    .no-movies {
      color: #f0327b;
      text-align: center;
    }
</style>


<div class="container container-main">
    <div class="row justify-content-center ratings-header">
        <div class="col-6" ><h5>My Ratings</h5></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <table class="table align-middle bottom-bordered"> 
            <?php
                if (empty($data['ratings'])) { ?>
                    <div class="no-movies">You haven't rated anything!</div>
                <? }
                foreach($data['ratings'] as $rating) { ?>
                <tr>
                    <td align="left" style="color: #e8e8e8; background-color: #1e1e1f;">
                        <?php echo $rating['movie']; ?></td>
                    <td align="right" style="color: #e8e8e8; background-color: #1e1e1f;">
                        <div class="stars">
                            <? if ($rating['rating'] < 1) { ?>
                                <i class="fa-regular fa-star" style="color: #f0327b"></i><? }
                            else { ?><i class="fa-solid fa-star" style="color: #f0327b;"></i><? } ?>
                            <? if ($rating['rating'] < 2) { ?>
                                <i class="fa-regular fa-star" style="color: #f0327b"></i><? }
                            else { ?><i class="fa-solid fa-star" style="color: #f0327b;"></i><? } ?>
                            <? if ($rating['rating'] < 3) { ?>
                                <i class="fa-regular fa-star" style="color: #f0327b"></i><? }
                            else { ?><i class="fa-solid fa-star" style="color: #f0327b;"></i><? } ?>
                            <? if ($rating['rating'] < 4) { ?>
                                <i class="fa-regular fa-star" style="color: #f0327b"></i><? }
                            else { ?><i class="fa-solid fa-star" style="color: #f0327b;"></i><? } ?>
                            <? if ($rating['rating'] < 5) { ?>
                                <i class="fa-regular fa-star" style="color: #f0327b"></i><? }
                            else { ?><i class="fa-solid fa-star" style="color: #f0327b;"></i><? } ?>
                        </div>
                    </td>
                </tr>
                <? } ?>
            </table>
    </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>