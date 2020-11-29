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
        <div class="card ">
            <div class="card-header user-header alt unique-color">
            

                <div class="row d-sm-flex justify-content-between">
                    <div class="col-md-4">

                        <form class="form-inline" method="post" action="<?= base_url(). 'administratif/eleve' ?>">

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
                       

                            <div class="col-md-4">
                                 <?php echo form_open_multipart(site_url('administratif/importerListingEleves')); ?>
                                <label for="uploadFile" class="control-label"><span class="text-danger">*</span>
                                    Importer registre etudiants (Excel)
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
                                <button type="submit" class="btn btn-primary" value="ListeEleves" name="uploadFilebtn">
                                    <i class="fa fa-download"></i> Charger registre etudiants
                                </button> 
                            </div>
                       
                    <?= form_close(); ?>
                     </div>
                     <!--
                   <div class="col-md-2">
                        <span class="table-add float-right mb-3 mr-2">
                            <a data-toggle="tooltip" data-placement="bottom" title="Cliquer pour ajouter un élève"
                               href="<?php echo base_url() . 'administratif/add_form/eleve/add'; ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus fa-2x" aria-hidden="true"></i>Ajouter</a></span>

                         </div>-->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Table  -->
                    <table id="dtMaterialDesignExample" class="table-sm table table-hover table-striped" width="100%">

                        <!-- Table head -->
                        <thead class="unique-color-dark text-light lighten-4">
                        <tr class="text-uppercase">
                            <th class="th-sm">#</th>
                            <th>Matricule</th>
                             <th>Nom complet</th>
                             <th>Genre</th>
                             <th>Date naissance</th>
                            <th>Promotion</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                        <?php $line = 1;
                        foreach ($eleves as $eleve): ?>
                            <tr>
                                <td><?= $line++ ?></td>
                                <td class="text-capitalize"><?= $eleve->matricule; ?></td>

                                <td class="text-capitalize"><?= $eleve->nom_complet; ?></td>
                                <td class="text-capitalize"><?= $eleve->genre; ?></td>
                                 <td class="text-capitalize"><?= $eleve->date_naissance; ?></td>
                                 <td class="text-capitalize"><?= $eleve->promo_sid; ?></td>

                                <td class="text-center">
                                 

                                    <a class="btn btn-primary btn-rounded btn-sm my-0" data-toggle="modal" data-target="#details_el<?= $eleve->etudiant_id; ?>"
                                       href="<?= site_url( 'administratif/paiements_el?mat_el=' . $eleve->matricule). '&ann_sco='.$eleve->annee_scolaire; ?>">
                                        <i class="fa fa-eye"></i> Afficher details</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="details_el<?= $eleve->etudiant_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content unique-color-dark text-light">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="text-shadow-black text-center">Détail sur l'etudiant : <small><?= $eleve->matricule; ?></small></h3>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button> </div>
                                            </div>
                                        </div>

                                        <div class="card-body font-weight-bold">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="nom_complet">Nom complet</label>
                                                        <input type="text" name="nom_complet" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->nom_complet ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="annee_scolaire">Email</label>
                                                        <input type="text" name="annee_scolaire" class="form-control form-control-sm font-weight-bold"
                                                               value="<?= $eleve->email; ?>" readonly>
                                                    </div>
                                                    <div id="div_minerval" class="form-group">
                                                        <label for="mois">Genre</label>
                                                        <input type="text" name="mois" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->genre; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="type_frais">promotion</label>
                                                        <input type="text" name="type_frais" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->promo_sid; ?>" readonly>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="date_paiement">Date Naissance</label>
                                                    <div class="form-group">
                                                        <input type="text" name="date_paiement" class="form-control form-control-sm font-weight-bold"
                                                               value="Le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($eleve->date_naissance))); ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="montant_paye">Lieu Naissance</label>
                                                        <input type="text" name="montant_paye" class="form-control form-control-sm font-weight-bold"
                                                               value="Né à <?= $eleve->lieu_naissance; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="montant_complet">Père et mère</label>
                                                        <input type="text" name="montant_complet" class="form-control form-control-sm font-weight-bold"
                                                               value="Fils(lle) de <?= $eleve->nom_pere. " et de ". $eleve->nom_mere; ?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="mois">Contact</label>
                                                        <input type="text" name="mois" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->contact ?>" readonly>
                                                        </select>
                                                    </div>
                                                    <div id="div_minerval" class="form-group">
                                                        <label for="mois">Adresse du domicile</label>
                                                        <input type="text" name="mois" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->adresse; ?>" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        </tbody>
                        <!-- Table body -->
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
