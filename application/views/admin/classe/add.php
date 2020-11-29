
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <!-- Heading -->
                        <div class="card mb-4 wow fadeIn">
                            <!--Card content-->
                            <div class="card-body d-sm-flex justify-content-between">

                                <h4 class="mb-2 mb-sm-0 pt-1">
                                    <a href="#">Ajout d'une classe scolaire</a>
                                </h4>

                            </div>

                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>

                        <form class="" action="<?= base_url(). 'admin/add_classe' ?>" method="post">
                            <div class="row clearfix">

                                <div class="col-md-4">
                                    <label for="classe_nom" class="control-label"><span class="text-danger"></span>Nom de la classe</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="classe_nom" value="<?= set_value('classe_nom') ?>"/>
                                        <span class="text-danger"><?php echo form_error('classe_nom');?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="classe_effectif_eleves" class="control-label"><span class="text-danger"></span>Effectif des élèves autorisés</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="classe_effectif_eleves" value="<?= set_value('classe_effectif_eleves') ?>"/>
                                        <span class="text-danger"><?php echo form_error('classe_effectif_eleves');?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    

                                    <label for="titulaire_sid" class="control-label"><span class="text-danger">*</span>
                                        Enseignant titulaire
                                    </label>
                                    <div class="form-group">
                                        <select class="form-control <?= form_error('titulaire_sid') ? 'is-invalid' : 'is-valid'; ?>"
                                                name="titulaire_sid" id="titulaire_sid">
                                            <option disabled selected>Choisissez un enseignant</option>
                                            <?php 
                                            if (!empty($enseignants )) {
                                               
                                            foreach ($enseignants as $enseignant) : ?>
                                                <option id="<?= $enseignant->enseignant_id; ?>"  
                                                    value="<?= $enseignant->matricule_enseignant; ?>"
                                                    <?= set_select('titulaire_sid', $enseignant->nom_enseignant); ?>>
                                                    <?= $enseignant->nom_enseignant; ?>
                                                </option>
                                            <?php endforeach;  }?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('titulaire_sid'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-outline-danger" value="Enregistrer">
                            <a href="<?= base_url() . "admin/classe/"; ?>" class="btn btn-danger">
                                <i class="fa fa-close"></i> Annuler & afficher la liste
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
