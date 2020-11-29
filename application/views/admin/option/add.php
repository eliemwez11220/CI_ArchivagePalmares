
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
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
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <!-- Heading -->
                        <div class="card mb-4 wow fadeIn">
                            <!--Card content-->
                            <div class="card-body d-sm-flex justify-content-between">

                                <h4 class="mb-2 mb-sm-0 pt-1">
                                    <a href="#" >Ajouter d'une option</a>
                                </h4>
                            </div>
                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>
                        <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                        <form class="" action="<?= base_url(). 'admin/add_option' ?>" method="post">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="nom_option" class="control-label"><span class="text-danger">*</span>Nom de l'option</label>
                                    <div class="form-group">
                                        <input type="text" id="code" class="form-control text-capitalize" name="nom_option"
                                               value="<?= set_value('nom_option'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_option'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="section_id" class="control-label"><span class="text-danger">*</span>Section à laquelle cette option est attachée</label>
                                    <div class="form-group">
                                       
                                        <select class="browser-default custom-select select2" name="section_sid">
                                            <option disabled>Choisissez une section</option>
                                            <option value="Pedagogique">Pedagogique</option>
                                            <option value="Latin-philo">Latin-philo</option>
                                            <option value="Scientifique">Scientifique</option>
                                             <option value="C.O">C.0</option>
                                        </select>
                                           <span class="text-danger"><?php echo form_error('section_sid'); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Enregistrer">
                            <a href="<?= base_url() . "admin/option/"; ?>" class="btn btn-outline-danger pull-right">
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
