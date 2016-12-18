<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <form method="post" action="/search" >
        <div class="well">
            <h4>Buscar Blog</h4>

            <div class="input-group">

                <input type="text" name='buscar' class="form-control">
                <span class="input-group-btn">

                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>

            </div>
            <!-- /.input-group -->
        </div>
    </form>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?= $categorias ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!--                    <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Category Name</a>
                                        </li>
                                        <li><a href="#">Category Name</a>
                                        </li>
                                        <li><a href="#">Category Name</a>
                                        </li>
                                        <li><a href="#">Category Name</a>
                                        </li>
                                    </ul>
                                </div>-->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <!--            <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>-->

</div>

</div>
<!-- /.row -->

<hr>
<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; <?= $copyright ?></p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</footer>

</div>

<?= $js ?>
</body>
</html>
