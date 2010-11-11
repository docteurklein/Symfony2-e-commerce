<?php echo $form->form('contact_index') ?>
    <?php echo $form->errors() ?>
    <table>
        <?php echo $form['email']->render() ?>
        <?php echo $form['subject']->render() ?>
        <?php echo $form['message']->render() ?>
    </table>
    <?php echo $form->hidden() ?>
    <input type="submit" />
</form>
