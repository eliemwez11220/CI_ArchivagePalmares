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

                      

                            <div class="card">
                                
                            <div class="card-body">
                                <!-- tableau des echeances de passports -->
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-hover"
                                           id="dtMaterialDesignExample">
                                        <thead class="unique-color-dark text-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                          
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
