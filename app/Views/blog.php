
<h1>
    <?= $title ?>
</h1>

<div>

    <?php foreach($posts as $post) : ?>
    <div>
        <h3><?= $post ?></h3>
        <img src="/assets/images/laptop.jpeg" style="width:200px; height:auto;" alt="laptop">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos quos quam fugit quo? Libero, asperiores
            earum ea suscipit voluptatem cum, voluptate delectus nostrum eveniet corporis similique unde rerum optio
            culpa.</p>
    </div>
    <?php endforeach?>
</div>