<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="col-md-12">
                            <aside class="profile-nav alt">
                                <section class="card">
                                    <div class="card-header user-header alt unique-color-dark">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="text-light text-uppercase font-weight-bold">
                                                Informations sur le resultat scolaire</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!empty($resultats['matricule_eleve'])){ ?>
                                    <div class="vue-lists">
                                        <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <ul class="list-group list-group-flush">

                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-check-o"></i> Date Publication :
                                                        <span><b><?= $resultats->date_pub; ?></b></span>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Classe :
                                                        <span><b><?= $resultats->nom_classe; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-building"></i> Section/cycle :
                                                        <span><b><?= $resultats->nom_classe; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-building"></i> Section/cycle :
                                                        <span><b><?= $resultats->nom_classe; ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <h3>
                                                    <b style="color: red;" class="text-center">Observation</b>
                                                </h3>
                                                <ul class="" style="padding: 10px">

                                                    <div class="mt-2">
                                                      
                                                          <span><b>  
                                                            <?= $d->mention; ?>
                                                                
                                                            </b></span>
                                                     
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else{?>
                                        <h3 class="text-center">Aucune information encours.
                                            Merci !</h3>
                                    <?php }?>
                                </section>
                            </aside>
                        </div>
                        </div>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </section><!-- /#right-panel -->
</div><!-- /#right-panel -->
