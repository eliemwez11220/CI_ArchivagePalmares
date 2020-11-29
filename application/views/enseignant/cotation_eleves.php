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
        <!--Card content
        <div class="card">
            <div class="card-header mb-4 wow fadeIn unique-color text-light font-weight-bold">

                
                <div class="row d-sm-flex justify-content-between">
                    <div class="col-md-6">
                        <h4 class="pt-1">
                            <span>Resultats de fin d'annee</span>
                        </h4>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        
            
                <div class="box-body">
                    <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>
                    <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                    <form class="" action="<?= base_url() . 'administratif/saveResult' ?>" method="post">
                        <div class="row clearfix mx-2">
                            <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="custom-select browser-default select2"
                                                        name="matricule_eleve" id="matricule_eleve">
                                                    <option disabled selected>Choisissez un eleve</option>
                                                    <?php foreach ($eleves as $eleve) : ?>
                                                        <option id="<?= $eleve->id_eleve; ?>"
                                                                value="<?= $eleve->matricule_eleve; ?>" <?= set_select('matricule_eleve', $eleve->matricule_eleve); ?>>
                                                            <?= $eleve->nom_complet; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('matricule_eleve'); ?></span>
                                            </div>
                                        </div>
                            <div class="col-md-4">
                           
                                                <div class="form-group">
                                                    <select data-toggle="tooltip" data-placement="top"
                                                            title="Nom de la classe"
                                                            class="custom-select browser-default"
                                                            name="nom_classe" id="nom_classe">
                                                        <option disabled selected>Choisissez une classe</option>
                                                        <?php foreach ($classes as $classe_mat) : ?>
                                                            <option id="<?= $classe_mat->id_classe; ?>"
                                                                    value="<?= $classe_mat->nom_classe; ?>" <?= set_select('nom_classe', $classe_mat->nom_classe); ?>>
                                                                <?= $classe_mat->nom_classe; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('nom_classe'); ?></span>
                                                </div>
                                            </div>
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="custom-select browser-default"
                                                        name="nom_option" id="nom_option">
                                                    <option disabled selected>Choisissez une option</option>
                                                    <?php foreach ($options as $option) : ?>
                                                        <option id="<?= $option->id_option; ?>"
                                                                value="<?= $option->nom_option; ?>" <?= set_select('nom_option', $option->nom_option); ?>>
                                                            <?= $option->nom_option; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('nom_option'); ?></span>
                                            </div>
                                        </div>
                            
                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <select class="form-control <?= form_error('section_id') ? 'is-invalid' : 'is-valid'; ?>"
                                            name="nom_section" id="section_id">
                                        <option disabled selected>Choisissez une section</option>
                                        <?php foreach ($sections as $section) : ?>
                                            <option id="<?= $section->id_section; ?>"
                                                    value="<?= $section->nom_section; ?>"
                                                <?= set_select('nom_section', $section->nom_section); ?>>
                                                <?= $section->nom_section; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                    <div class="form-group">
                                    
                                        <select class="browser-default custom-select" name="nom_cycle">
                                            <option disabled selected>Choisissez un cycle</option>
                                            <option value="primaire">Primaire</option>
                                            <option value="secondaire">Secondaire</option>
                                            <option value="maternelle">Maternelle</option>
                                           
                                            <span class="text-danger"><?php echo form_error('nom_cycle'); ?></span>
                                        </select>
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pourcentage" value="<?= set_value('pourcentage') ?>" placeholder="pourcentage obtenu"/>
                                        <span class="text-danger"><?php echo form_error('pourcentage');?></span>
                                    </div>
                                </div>


                                 <div class="col-md-4">
                                
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="place_occupee" value="<?= set_value('place') ?>" placeholder="Place occupée"/>
                                        <span class="text-danger"><?php echo form_error('place_occupee');?></span>
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    
                                    <div class="form-group">
                                        <select class="browser-default custom-select" name="mention">
                                            <option disabled selected>Choisissez une mention</option>
                                            <option value="Tres bien">Tres bien</option>
                                            <option value="Assez bien">Assez bien</option>
                                            <option value="Bien">Bien</option>
                                            <option value="Excellente">Excellente</option>
                                            <option value="Mediocre">Mediocre</option>
                                           
                                          
                                        </select> 
                                         <span class="text-danger"><?php echo form_error('mention'); ?></span>
                                    </div>
                                </div>


                                 <div class="col-md-4">
                                
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nombre_echec" value="<?= set_value('nombre_echec') ?>" placeholder="Echecs"/>
                                        <span class="text-danger"><?php echo form_error('nombre_echec');?></span>
                                    </div>
                                </div>

                        </div>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="<?= base_url() . "administratif/option/"; ?>" class="btn btn-outline-danger pull-right">
                            <i class="fa fa-close"></i> Annuler
                        </a>
                    </form>
                </div>
        
        </div>
    -->
 <!--Card-->
                        <div class="card mt-2">
                            <div class="card-header user-header alt unique-color">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="text-light text-uppercase font-weight-bold">
                                           Gestion cotation des eleves
                                        </h4>
                                    </div>
                                </div>
 <div class="row">
                                 <div class="col-md-6">
                                <form class="form-inline" method="post" action="<?= base_url(). 'administratif/viewCotation' ?>">

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
                                        'title' => 'Année scolaire',
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
                                 <?php echo form_open_multipart(site_url('administratif/importerListingCotation')); ?>
                                <label for="uploadFile" class="control-label"><span class="text-danger">*</span>
                                    Importer Cotes eleves (Excel)
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
                                <button type="submit" class="btn btn-primary" value="cotations" name="uploadFilebtn">
                                    <i class="fa fa-download"></i> Charger cotation
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
                                            <th>eleve</th>
                                            <th>Cours</th>
                                            <th>1ere Periode</th>
                                            <th>2eme Periode</th>
                                            <th>Examen1</th>
                                            <th>Semestre1</th>
                                            <th>3eme Periode</th>
                                            <th>4eme Periode</th>
                                            <th>Examen2</th>
                                            <th>Semestre2</th>
                                           
                                            <th>Année scolaire</th>
                                            <th>Total cotes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($cotations != "") {
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($cotations as $carte) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $count++; ?></td>
                                                    <td class="text-uppercase"><?= $carte->eleve_sid; ?></td>
                                                    <td class="text-capitalize"><?= $carte->cours_sid; ?></td>
                                                    <td class="text-capitalize"><?= $carte->cote_periode1; ?></td>
                                                    <td class="text-capitalize"><?= $carte->cote_periode2; ?></td>
                                                      <td class="text-capitalize"><?= $carte->cote_examen1; ?></td>      

                                                       <td class="text-capitalize"><?= $carte->premier_semestre; ?></td>

                                                    <td class="text-capitalize"><?= $carte->cote_periode3; ?></td>
                                                    <td class="text-capitalize"><?= $carte->cote_periode4; ?></td>
                                                     <td class="text-capitalize"><?= $carte->cote_examen2; ?></td>
                                                     <td class="text-capitalize"><?= $carte->deuxieme_semestre; ?></td>

                                                    <td class="text-capitalize"><?= $carte->annee_scolaire; ?></td> 
                                                    <td class="text-capitalize"><?= $carte->total_max; ?></td>
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
