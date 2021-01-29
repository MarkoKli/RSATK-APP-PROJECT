<div class="card container-card list-card">
    <div class="card-header">
        <h2>Дијагнози</h2>
    </div>
    <div id="accordion" class="card-body">
    <?php foreach ($_SESSION["diagnoses"] as $diagnosis): ?>
        <div class="card">
            <div class="card-header" id="title<?php echo $diagnosis["id"]; ?>">
                <div class="row justify-content-between">
                    <button class="btn collapsed col-lg-9 ml-2" 
                            data-toggle="collapse" 
                            data-target="#desc<?php echo $diagnosis["id"]; ?>" 
                            aria-expanded="false"
                            data-toggle="collapse"
                            aria-controls="desc<?php echo $diagnosis["id"]; ?>">
                        <?php echo $diagnosis["name"]; ?>
                    </button>
                    <div class="row col-lg-3">
                        <form action="<?php echo $location; ?>" method="post" class="mr-4">
                            <input type="hidden" name="action" value="edit_diagnosis">
                            <input type="hidden" name="id" value="<?php echo $diagnosis["id"]; ?>">
                            <input class="btn btn-outline-primary" type="submit" value="Промени">
                        </form>
                        <form action="<?php echo $location; ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $diagnosis["id"]; ?>">
                            <input type="hidden" name="action" value="delete_diagnosis">
                            <input class="btn btn-outline-danger" type="submit" value="Избриши">
                        </form>
                    </div>
                </div>
            </div>
            <div id="desc<?php echo $diagnosis["id"]; ?>"  
                aria-labelledby="title<?php echo $diagnosis["id"]; ?>"
                data-parent="#accordion" class="collapse">
                <div class="card-body">
                    <?php echo $diagnosis["description"]; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="card container-card">
    <div class="card-header">
        <h3>Креирај дијагноза: </h3>
    </div>
    <div class="card-body">
        <form class="needs-validation" action="<?php echo $location; ?>" method="post" novalidate>
            <input type="hidden" name="action" value="create_diagnosis">
            <div class="form-group row">
                <label for="title" class="col-2 col-form-label text-center">Име на дијагноза: </label>
                <div class="col-10">
                    <input class="form-control" id="name" name="name" 
                        placeholder="Назив" required>
                    <div class="invalid-feedback">
                        <?php echo (isset($invalidFeedback))? 
                                    $invalidFeedback :
                                    "Please enter a name!"; ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="desc" class="col-2 col-form-label text-center">Опис на дијагноза: </label>
                <div class="col-10">
                    <textarea class="form-control" id="desc" name="desc" 
                        placeholder="Опис..." cols="30" required></textarea>
                    <div class="invalid-feedback">
                        <?php echo (isset($invalidFeedback))? 
                                    $invalidFeedback :
                                    "Please enter a description!"; 
                        ?>
                    </div>
                </div>
            </div>
            <input class="btn btn-outline-primary" type="submit" value="Креирај!">
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#search-diagnoses").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#accordion .card-header").filter(function() {
                    $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    });
</script>
