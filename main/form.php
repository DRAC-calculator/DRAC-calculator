<?php
    global $drac_calc;

    if( $drac_calc->errors() ) {
        echo '<div class="drac_field_error">';
        echo $drac_calc->errorMessage();
        echo '</div>';
    }
?>
    <form action="" method="post" class="au-form">
        <fieldset>
            <?= !$drac_calc->fieldValid('name') ? drac_field_error_html($drac_calc->fieldErrorMessage('name')) : '' ?>
            <label for="drac_data_name">Name <em>*</em></label>
            <input type="text" name="drac_data[name]" id="drac_data_name" required="true" value="<?= $drac_calc->value('name') ?>" />
        </fieldset>

        <fieldset>
            <?= !$drac_calc->fieldValid('table') ? drac_field_error_html($drac_calc->fieldErrorMessage('table')) : '' ?>
            <label for="drac_data_table">Data <em>*</em></label>
            <textarea name="drac_data[table]" id="drac_data_table" ><?= $drac_calc->value('table') ?></textarea>
        </fieldset>

        <button type="submit" id="drac_data_submit" title="Run the calcular.">Calculate</button></form>
    </form>

    <p class="drac_data_actions">
        <button id="drac_load_example_data" title="Populate the fieds with some example data, overwriting the current content.">Load Exampe Data</button>
        <button id="drac_clear_data" title="Clear the data from the input fields.">Clear Data</button>
    </p>