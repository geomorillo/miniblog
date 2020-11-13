<!-- Blog Post Content Column -->
<div class="col-lg-8">

    <!-- Blog Post -->

    <?= $post ?>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Dejar un comentario:</h4>
        <form role="form" action="/comentario/insertar/<?=$id_post?>" method="POST">
            <div class="form-group">
                <textarea class="form-control" rows="3" name="contenido"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comentar</button>
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    <?=$comentarios?>


</div>
