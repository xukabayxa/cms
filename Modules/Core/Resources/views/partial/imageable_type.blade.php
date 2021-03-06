<?php if ($showLabel && $showField): ?>
<?php if ($options['wrapper'] !== false): ?>
<div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
    <?php endif; ?>

    <?php if ($options['value']): ?>
    <img src="{!! $options['value']->path !!}" width="200"/><br>
    <?php endif; ?>

    <?php if ($showLabel && $options['label'] !== false): ?>
    <?= Form::label($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

    <?php if ($showField): ?>
    <?= Form::input($type, $name, $options['value'], $options['attr']) ?>

<?php endif; ?>

    <?php if ($showError && isset($errors)): ?>
    <?php foreach ($errors->get($nameKey) as $err): ?>
    <div <?= $options['errorAttrs'] ?>><?= $err ?></div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
</div>
<?php endif; ?>
<?php endif; ?>
