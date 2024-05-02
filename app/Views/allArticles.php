<main class="container">

    <!--Search Results-->

    <?php
    if ($title != "All Articles"):
        ?>
        <h2>Search results:</h1>
        <?php endif; ?>

        <div class="container">
            <div class="row p-4">

                <?php foreach ($articles as $article): ?>
                    <div class="secondary">
                        <div
                            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <h3 class="mb-0"><?= esc($article->title) ?></h3>
                                <div class="mb-1 text-body-secondary"><?= esc($article->created_at) ?></div>
                                <div>
                                    <?php
                                    $result = substr($article->content, 0, strpos(wordwrap($article->content, 350), "\n"));
                                    $Parsedown = new Parsedown();
                                    echo $Parsedown->text($result . " . . .");
                                    ?>
                                </div>
                                <a href=<?= esc("/article/" . $article->crumb) ?>
                                    class="icon-link gap-1 icon-link-hover stretched-link">
                                    Leggi l'articolo completo
                                    <svg class="bi">
                                        <use xlink:href="#chevron-right" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <img src=<?= esc("/public/assets/images/" . $article->thumbnail) ?>
                                    style="object-fit: cover;" width="200" height="250" alt="">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        </div>


</main>