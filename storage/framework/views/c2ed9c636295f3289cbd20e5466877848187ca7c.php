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
## Hey <?php echo e($user->first_name); ?>, we have finished verifying your profile! <?php echo e((($user->roles->count() > 0) && ( in_array($user->roles->first()->name, ['artist_pro', 'pro'])) ) ? ' - Welcome to the PRO club!' : ''); ?>


<ul>
    <?php if($user->roles->count() > 0): ?>
    <li>User type: <?php echo ( in_array($user->roles->first()->name, ['artist_pro', 'pro'])) ? 'Artist <b>PRO</b>' : \Illuminate\Support\Str::title($user->roles->first()->name); ?> </li>
    <?php endif; ?>
    <li>Status: <span style="color:#a1eee1;font-weight:bold;">Approved</span></li>
</ul>
<?php if($user->roles->count() > 0): ?>
    <?php if($user->roles->first()->name === 'artist'): ?>
    You now have all the benefits of an Artist user, visit our FAQs for further information
    <?php elseif( in_array($user->roles->first()->name, ['artist_pro', 'pro']) ): ?>
    You now have all the benefits of an Artist PRO user, visit our FAQs for further information
    <?php endif; ?>
<?php endif; ?>

<?php $__env->startComponent('mail::button', ['url' => config('app.url')]); ?>
    User Benefits →
<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

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
<?php /**PATH C:\xampp\htdocs\phase\resources\views/emails/account/approved.blade.php ENDPATH**/ ?>