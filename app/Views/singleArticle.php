<main class="container">
    <div class="row">
        <img src=<?= esc("/public/assets/images/" . $article->thumbnail) ?> style="object-fit: cover;" width="200"
            height="250" alt="">
        <h1><?= esc($article->title) ?></h1>
    </div>
    <div class="row">

        <!-- Left Column (Video Player) -->
        <div class="col-md-5">

            <?php
            if (!$article->video_link == null):
                ?>
                <div class="video-container">
                    <video id="videoPlayer" controls width="100%" class="object-fit-contain border rounded">
                        <source src=<?= esc($article->video_link) ?> type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php endif ?>

            <!-- Left Column (Comments Section) -->
            <div class="row mt-3">
                <h3>Commenti:</h3>
                <?php
                $session = session();
                if (!empty($session->active)):
                    ?>
                    <form class="d-flex" role="search" action="search">
                        <input class="form-control me-2" type="search" name="search" id="search" placeholder="Comment"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Submit</button>
                    </form>
                <?php endif ?>
            </div>

            <?php foreach ($comments as $comment): ?>
                <div class="container p-2">
                    <div class="container border rounded p-2">
                        <div class="second">
                            <p class="text-success"><?= esc($comment->nickname) ?></p>
                            <div class="container">
                            <span><?= esc($comment->content) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Right Column (Content) -->
        <div class="col-md-7 border-start">
            <div class="container">
                <?php
                $Parsedown = new Parsedown();
                echo $Parsedown->text($article->content);
                ?>
            </div>
        </div>

    </div>
</main>