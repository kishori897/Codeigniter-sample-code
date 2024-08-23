 <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>
<div class="container mt-4">
    <div class="row mb-12">
        
        <div class="col-md-4 text-left">
            <a href="<?= base_url('index.php/news/create') ?>" class="btn btn-info" role="button">Add News</a>
        </div>
        <div class="col-md-8 text-left">
            <form class="form-inline float-right" method="get" action="<?= site_url('news') ?>">
                <div class="input-group col-md-9 text-left">
                    <input type="text" name="search" class="form-control" placeholder="Search" value="<?= isset($search) ? $search : '' ?>">
                    
                </div>
                <div class="input-group col-md-2 text-right">
                        <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

    </div>
     <br>


   

    <!-- Search form -->
    <div class="row mb-4">
        
    </div>

    <!-- News table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Text</th>
                <th>Date</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($news)): ?>
                <?php foreach ($news as $news_item): ?>
                    <tr>
                        <td><?= $news_item['title'] ?></td>
                        <td><?= substr($news_item['text'], 0, 50) . '...' ?></td>
                        <td><?= isset($news_item['formatted_date']) ? $news_item['formatted_date'] : 'Unknown' ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('news/edit/' . $news_item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('news/view/' . $news_item['id']) ?>" class="btn btn-warning btn-sm">View</a>
                            <a href="<?= site_url('news/delete/' . $news_item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No news items found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?= $this->pagination->create_links(); ?>
        </ul>
    </nav>
</div>
