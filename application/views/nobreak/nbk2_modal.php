            <div id="modal_nbk2" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-line-chart"></i>Detalhes Nobreak 02</div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                                        <thead>
                                            <tr>
                                                <th class="all">Hora</th>
                                                <th class="all">Temperatura</th>
                                                <th class="all">Potência Total de Entrada</th>
                                                <th class="all">Porcentagem Bateria</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td><?=$temps2['hora']?></td>
                                            <td><?=$temps2['outros_temp']?> º C</td>
                                            <td><?=$temps2['ent_pot_apa_tot']?> KVA</td>
                                            <td><?=$temps2['bat_car_atu']?> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>