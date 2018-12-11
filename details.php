    <article>
        <article>
            <h1><?= $data[0]["title"]?></h1>
            <p>Date de sortie :
                <time><?= $data[0]["releaseDate"]?></time>
            </p>
            <aside>
                <p>Synopsis : </p>
                <p><?= $data[0]["synopsys"]?>
                </p>
                <p>Note :
                    <meter min="0" max="5"
                           low="1.5" high="3.5" optimum="4.5"
                           value="<?= $data[0]["rating"]?>"></meter>
            </aside>
        </article>