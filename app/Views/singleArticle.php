<main class="container">
    <div class="row">
        <img src=<?= esc("/public/assets/images/" . $article->thumbnail) ?> style="object-fit: cover;" width="200"
            height="250" alt="">
        <h1><?= esc($article->title) ?></h1>
    </div>

    <div class="row">

        <!-- Left Column (Video Player) -->
        <div class="col-md-5" style="height:100vh;">

            <?php
            if (!$article->video_link == null):
                ?>
                <div class="video-container">
                    <video id="videoPlayer" controls width="100%" class="object-fit-contain border rounded">
                        <source src=<?= esc($article->video_link) ?> type="video/mp4">  <!-- TODO: @Joshua Da togliere il tag php da questa linea -->
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php endif ?>

            <div class="col p-2">
                    <div class="container border rounded mp-2" hidden>
                        
                    </div>
            </div>

            <!-- Left Column (Comments Section) -->
            <div class="col mt-3 position-sticky">
                <h3>Commenti:</h3>
                <?php
                $session = session();
                if (!empty($session->active)):
                    ?>
                    <form class="d-flex" role="Comment" method="post" action="/article/comment/<?= esc($article->crumb) ?>">
                    <input class="form-control me-2" name="content" placeholder="content" aria-label="content">
                        <button class="btn btn-outline-success" type="submit">Submit</button>
                    </form>
                <?php endif; ?>
            </div>

            <div>
                <?php 
                    if (!empty($comments)):
                    foreach ($comments as $comment): 
                ?>
                    <div class="container p-2">
                        <div class="container border rounded p-2">
                            <div class="second">
                                <p class="text-success"><?= esc($comment->created_at) ?></p>
                                <div class="container">
                                    <span><?= esc($comment->content) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                else: ?>
                <h6>Non ci sono commenti . . . 😕</h6>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column (Content) -->
        <div class="col-md-7 border-start position-sticky">
            <div class="container">
                <?php
                $Parsedown = new Parsedown();
                echo $Parsedown->text($article->content);
                ?>
            </div>
        </div>

    </div>
</main>