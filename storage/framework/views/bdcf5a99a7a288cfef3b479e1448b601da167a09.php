<?php $__env->startComponent('mail::message'); ?>
<table align="center">
    <tr>
        <td>
            <img src="<?php echo e(asset('img/emails/main-logo.png')); ?>" alt="Phase Logo" width="180">
        </td>
    </tr>
    <tr>
        <td>
            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:19px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:23px;color:#666666;text-align: center;">phase:<span style="color:#ff3366;">admin</span></p>
        </td>
    </tr>
</table>

<?php $__env->startComponent('mail::subcopy'); ?>
Hey <?php echo e($user->first_name); ?>, thanks for your release! we are just validating details and ensuring it's ready to go live on phase.<br><br>If you want to check the status of your releases then click the button below.
<br/>

<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/account/releases']); ?>
    My Releases →
<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>


<i>Please note, validating a release can take up to  24 hours, you will recieve an email confirmation when it has been approved.</i>

<?php if (isset($__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc)): ?>
<?php $component = $__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc; ?>
<?php unset($__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\phase\resources\views/emails/releases/processing.blade.php ENDPATH**/ ?>