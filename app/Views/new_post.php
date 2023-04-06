<?= $this->extend('layouts/main')?>

<?= $this->section('content')?>
<h1>
    <?= $title ?>
</h1>

<div class="row">
    <div class="col-12 col-md-8 offset-md-2">
        <form method="POST" action="/blog/new">
            <div class="form-group">
                <label for="" >Title</label>
                <input type="text" class="form-control" name="post_title">
            </div>
            <div class="form-group">
                <label for="" >content</label>
               <textarea  class="form-control" name="post_content" id="" rows="3"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-sm" type="submit">Create</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>