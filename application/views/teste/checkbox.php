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
        <!-- <h3 class="page-title"> Link
            <small>Tipo de acesso</small>
        </h3> -->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12">

                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase"> Default Form</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-trash-o"></i> Delete </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-ban"></i> Ban </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> Make admin </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Inline Checkboxes</label>
                                    <div class="checkbox-list">
                                        <?php foreach ($modulos as $key => $modulos): ?>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox<?php echo $key; ?>" value="<?php echo $key; ?>"> <?php echo $modulos->nome_modulo; ?>
                                        </label>
                                        <?php endforeach ?>
   <!--                                      <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox1" value="option1"> Checkbox 1
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox3" value="option3"> Disabled
                                        </label> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->

            </div>
        </div>
    </div>
</div>



<!-- /* End of file checkbox.php */ -->
<!-- /* Location: ./application/views/teste/checkbox.php */ -->


