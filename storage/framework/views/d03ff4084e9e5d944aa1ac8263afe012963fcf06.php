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
## Hey <?php echo e($user->first_name); ?>, we have received your request to upgrade to an Artist account

<ul>
    <li>User type: <?php echo e(\Illuminate\Support\Str::title($user->roles->first()->name)); ?> </li>
    <li>Status: <span style="color:#f8bd01;font-weight:bold;">Processing</span></li>
</ul>

<h5 style="color:#666666;padding-bottom:20px;margin-bottom:20px">We are in the process of verifying your profile and will update you once this is finished, until then you can access Phase as a standard user.</h5>

<?php echo $__env->make('emails.partials.artist-icons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<?php /**PATH C:\xampp\htdocs\phase\resources\views/emails/account/upgraded.blade.php ENDPATH**/ ?>