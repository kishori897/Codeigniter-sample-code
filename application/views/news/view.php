<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Title Section -->
                    <h2 class="card-title mb-3">Title: <?= htmlspecialchars($news_item['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    
                    <!-- Content Section -->
                    <h5 class="card-subtitle mb-2 text-muted">Content:</h5>
                    <p class="card-text"><?= htmlspecialchars($news_item['text'], ENT_QUOTES, 'UTF-8') ?></p>
                    
                    <!-- Back Button -->
                    <a href="<?= site_url('news') ?>" class="btn btn-primary" role="button">Back to News</a>
                </div>
            </div>
        </div>
    </div>
</div>
