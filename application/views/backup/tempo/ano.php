<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php echo $this->breadcrumbs->show(); ?>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <br>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12">
              <div id="msgs"></div>
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                   <div class="portlet-title">
                      <div class="caption font-dark">
                          <i class="icon-settings font-dark"></i>
                          <span class="caption-subject bold uppercase">Backups com maior tempo de execução no mês</span>
                      </div>
                      <div class="tools">
                        <a href="" class="collapse"> </a>
                        <a href="" class="reload"> </a>
                        <!-- <a href="" class="remove"> </a> -->
                      </div>
                   </div>
                  <div class="portlet-body">
                    <form id="grafico" name="grafico" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-2">
                                  <label class="control-label"><b>Ano :</b></label>
                                  <select class="selectpicker form-control input-small" name="ano" onchange='this.form.submit()'>
                                      <option value="<?php print $nano;?>" ><?php print $nano;?></option>
                                      <?php
                                          for($a = 2012; $a <= date('Y'); $a++ ) {
                                              echo "<option value='".$a."' >".$a."</option>";
                                          }
                                      ?>
                                  </select>
                              </div>
                              <noscript><input type="submit" value="Submit"></noscript>
                        </div>
                    </form>
                    <div id="container"></div>
                  </div>
              </div>
            </div>
        </div>

<!-- /* End of file ano.php */ -->
<!-- /* Location: ./application/views/backup/tempo/ano.php */ -->