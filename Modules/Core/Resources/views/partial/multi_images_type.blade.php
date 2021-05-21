<?php if ($showLabel && $showField): ?>
<?php if ($options['wrapper'] !== false): ?>
<div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
    <?php endif; ?>

    <?php if ($options['value']): ?>
    @php($images = json_decode($options['value']))
    @foreach($images as $img)
    <img src="{!! $img !!}" width="200"/>
    @endforeach
    <br>
    <?php endif; ?>

    <?php if ($showLabel && $options['label'] !== false): ?>
    <?= Form::label($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

    <?php if ($showField): ?>
    <?= Form::input($type, $name, $options['value'], $options['attr']) ?>

<?php endif; ?>


    <?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
</div>
<?php endif; ?>
<?php endif; ?>
