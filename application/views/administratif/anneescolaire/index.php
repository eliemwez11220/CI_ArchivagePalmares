<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-light">
                <h3 class="title">Lancement de l'année scolaire</h3>
            </div>
            <div class="tile-body text-justify">
                <form action="<?= base_url('administratif/lancer_annee'); ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="annee" value="<?= $annee_scolaire ?>"
                                           class="form-control is-valid text-center font-weight-bold text-info"
                                           readonly>
                                    <span class="text-danger"><?php echo form_error('annee'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group container-fluid" align="center">
                                <input type="submit" value="Lancer cette année"
                                       class="btn btn-primary">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="row mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-light">
                <h3 class="title">Listing des annees d'etudes</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-striped table-hover"
                           id="dtMaterialDesignExample">
                        <thead class="info-color-dark text-light font-weight-bold text-uppercase">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Année scolaire</th>
                            <th>Date et heure lancement</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($periodes != "") {
                            $count = 1;
                            //boucle de donnees
                            foreach ($periodes as $carte) { ?>
                                <tr>
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-uppercase"><?= $carte->annee_scolaire; ?></td>
                                    <td class="text-uppercase"><?= $carte->date_created; ?></td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>