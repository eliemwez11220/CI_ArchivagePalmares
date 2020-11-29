<?php
if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) { ?>
    <div class="container" style="margin-top: 10px;margin-bottom: 10px;">
        <div class="row">
            <h6 class="text-dark">
                <?php include_once "application/views/alertes/alert-index.php"; ?>
            </h6>
        </div>
    </div>
<?php } ?>
<div class="row" style="font-size: 20px;">
    <div class="col-md-12">
          <div class="card mt-2">
                            <div class="card-header user-header alt unique-color">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="text-light text-uppercase font-weight-bold">
                                            Palmares Resultats Etudiants
                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">
                                <form class="form-inline" method="post" action="<?= base_url(). 'administratif/viewResultat' ?>">

                            <div class="form-group" style="width: 80%!important;">

                                <?php $array_periodes  = array(); foreach ($periodes as $periode) :

                                    $array_periodes[$periode->annee_scolaire] = $periode->annee_scolaire;

                                endforeach; ?>

                                <?=
                                form_dropdown('annee_scolaire', $array_periodes, $select,
                                    array(
                                        'class' => 'browser-default custom-select col-md-6',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => 'Année Academique',
                                        'id' => 'annee_scolaire',
                                        'required'
                                    )
                                );
                                ?>
                                    <input type="submit" class="btn btn-primary" name="submit" value="Afficher">
                                </div>
                        </form>
                    </div>
                       

                            <div class="col-md-6">
                                 <?php echo form_open_multipart(site_url('administratif/importerListingResultats')); ?>
                                <label for="uploadFile" class="control-label"><span class="text-danger">*</span>
                                    Importer Palmares Resultats Etudiants (Excel)
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Donnees a importer">
                                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </span>
                                </label>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="uploadFile" id="uploadFile"
                                           value="<?= set_value('uploadFile') ?>" accept=".xlsx, .cvs"/>
                                    <span class="text-danger"><?php echo form_error('uploadFile'); ?></span>
                                </div>
                            
                            <div class="text-center align-middle">
                                <button type="submit" class="btn btn-primary" value="Palmares" name="uploadFilebtn">
                                    <i class="fa fa-download"></i> Charger resultats etudiants
                                </button> 
                            </div>
                       
                    <?= form_close(); ?>
                     </div>
                  </div>
                          </div>   <!--Card content-->
                            <div class="card-body">
                                <!-- tableau des echeances de passports -->
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-hover"
                                           id="dtMaterialDesignExample">
                                        <thead class="unique-color-dark text-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Matricule</th>
                                            <th>Année Academique</th>
                                            <th>Promotion</th>
                                            <th>Option suivie</th>
                                            <th>Departement</th>
                                            <th>Session</th>
                                            <th>Cotes obtenues</th>
                                            <th>Pourcentage</th>
                                            <th>Date Pub</th>
                                            <th>Mention</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($resultats != "") {
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($resultats as $carte) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $count++; ?></td>
                                                    <td class="text-uppercase"><?= $carte->matricule; ?></td>
                                                    <td class="text-capitalize"><?= $carte->annee_scolaire; ?></td> 
                                                    <td class="text-capitalize"><?= $carte->promotion; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nom_option; ?></td>
                                                    <td class="text-capitalize"><?= $carte->departement; ?></td>
                                                    <td class="text-capitalize"><?= $carte->session; ?></td> 
                                                    <td class="text-capitalize"><?= $carte->cote_obtenue; ?></td>
                                                    <td class="text-capitalize"><?= $carte->pourcentage; ?></td>
                                                    <td class="text-capitalize"><?= $carte->date_pub; ?></td>
                                                    
                                                    <td class="text-capitalize"><?= $carte->mention; ?></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.Card-->





    </div>
</div>
