<main class="container">

  <!--Featured Post-->

  <div class="p-8 p-md-5 mb-4 rounded text-body-emphasis"
    style="<?= esc("background-image: url('/public/assets/images/" . $articles[0]->thumbnail) . "'); background-position: center;" ?>">
    <div class="p-8 p-md-5 col-lg-6 px-0 rounded"
      style="--bs-bg-opacity: 0.9; background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;">
      <h1 class="display-4 fst-italic text-light"><?= esc($articles[0]->title) ?></h1>
      <div class="mb-1 text-light"><?= esc($articles[0]->created_at) ?></div>
      <div class="lead my-3 text-light">
        <?php
        $result = substr($articles[0]->content, 0, strpos(wordwrap($articles[0]->content, 100), "\n"));
        $Parsedown = new Parsedown();
        echo $Parsedown->text($result . " . . .");
        ?>
      </div>
      <p class="lead mb-0"><a href=<?= esc("/article/" . $articles[0]->crumb) ?> class="text-body-light fw-bold">Leggi
          l'articolo completo...</a></p>
    </div>
  </div>

  <!--Sub Posts-->

  <div class="container">
    <div class="row p-4">

      <?php foreach (array_slice($articles, 1) as $article): ?>
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <h3 class="mb-0"><?= esc($article->title) ?></h3>
              <div class="mb-1 text-body-secondary"><?= esc($article->created_at) ?></div>
              <div>
                <?php
                $result = substr($article->content, 0, strpos(wordwrap($article->content, 110), "\n"));
                $Parsedown = new Parsedown();
                echo $Parsedown->text($result . " . . .");
                ?>
              </div>
              <a href=<?= esc("/article/" . $article->crumb) ?> class="icon-link gap-1 icon-link-hover stretched-link">
                Leggi l'articolo completo
                <svg class="bi">
                  <use xlink:href="#chevron-right" />
                </svg>
              </a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img src=<?= esc("/public/assets/images/" . $article->thumbnail) ?> style="object-fit: cover;" width="200"
                height="250" alt="">
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <p class="card-text mb-auto">Non trovi nulla che ti interessi?</p>
            <a href="/search" class="icon-link gap-1 icon-link-hover stretched-link">
              Prova a vedere la lista completa!
              <svg class="bi">
                <use xlink:href="#chevron-right" />
              </svg>
            </a>
          </div>
        </div>



      </div>
    </div>
  </div>


</main>