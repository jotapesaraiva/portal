<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
    <title> Create And Validate Select Option Field (using for each loop) In CodeIgniter</title>
    <link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/select.css" ?>">
</head>
    <body>
        <div id="container">
            <?php echo form_open('select_ctrl/error'); ?>
            <h3>Create And Validate Select Option Field (using for each loop) In CodeIgniter</h3>
            <?php echo form_label('Student Name :'); ?> <?php echo form_error('dname'); ?>
            <?php echo form_input(array('id' => 'dname', 'name' => 'dname')); ?>
            <?php echo form_label('Student Email :'); ?> <?php echo form_error('demail'); ?>
            <?php echo form_input(array('id' => 'demail', 'name' => 'demail')); ?>
            <?php echo form_label('Student City :'); ?><?php echo form_error('city'); ?>
            <select name="city">
                <option value="none" selected="selected">------------Select City------------</option>
                <!----- Displaying fetched cities in options using foreach loop ---->
                <?php foreach($students as $student):?>
                <option value="<?php echo $student->student_id?>"><?php echo $student->student_city?></option>
                <?php endforeach;?>
            </select>
            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
            <?php echo form_close(); ?>
        </div>
    </body>
</html>


<!-- /* End of file select_view.php */ -->
<!-- /* Location: ./application/views/select_view.php */ -->