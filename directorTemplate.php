<article>
    <section>
        <figure class="Realisateur">
            <img class="Portrait" src="<?= $data[2]["path"]?>">
            <figcaption class="Realisateur">
                <h2><?= $data[0]["firstname"]." ".$data[0]["lastname"] ?></h2>
                <p>
                    <time><?= $data[0]["birthdate"]?></time>
                </p>
            </figcaption>
        </figure>
    </section>
    <section>
        <p> <?= $data[0]["biography"]?></p>
    </section>