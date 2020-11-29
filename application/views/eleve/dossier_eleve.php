<?php
if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) { ?>
<div class="container" style="margin-top: 10px;margin-bottom: 10px;">
    <div class="row">
        <h6 class="text-dark">
            <?php include_once "application/views/alertes/alert-index.php"; ?>
        </h6>
    </div>
</div>
<?php } ?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->eleve; ?></b></span>
                        <div class="col-md-14">
                            <aside class="profile-nav alt">
                                <section class="card">
                                    <div class="card-header user-header alt unique-color-dark">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="text-light text-uppercase font-weight-bold">
                                                    Coordonnées d'identification personnelle
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="vue-lists text-uppercase">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <i class="fa fa-user"></i>Nom complet:
                                                        <span><b><?= $eleve['nom_complet']; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-tasks"></i> Numéro matricule :
                                                        <span><b><?= $eleve['matricule_eleve'];?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-venus-double"></i> Genre :
                                                        <span><b><?= $eleve['genre'] ?></b></span>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <i class="fa fa-envelope-square"></i> Email Address:
                                                        <span><b class="text-lowercase"><?= $eleve['email'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-building-o"></i> D.R.Congo Address :
                                                        <span><b><?= $eleve['adresse_eleve'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-building-o"></i> Your home address :
                                                        <span><b><?= $eleve['contact_eleve'] ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar"></i> Date de naissance. :
                                                        <span><b><?= $eleve['date_naissance'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-graduation-cap"></i> Lieu de naissance :
                                                        <span><b><?= $eleve['lieu_naissance'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-user-circle"></i> Nom du père:
                                                        <span><b><?= $eleve['nom_pere'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-user-circle"></i> Nom de la mère:
                                                        <span><b><?= $eleve['nom_mere'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-list-ol"></i> Nom du tuteur :
                                                        <span><b><?= $eleve['nom_tuteur'] ?></b></span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </aside>
                        </div>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </section><!-- /#right-panel -->
</div><!-- /#right-panel -->
