

<?php
$classes = Flux::classes()
    ->add('mx-auto w-full [:where(&)]:max-w-7xl px-6 lg:px-8')
    ;
?>

<div <?php echo e($attributes->class($classes)); ?> data-flux-container>
    <?php echo e($slot); ?>

</div>
<?php /**PATH C:\Users\marke\OneDrive\Desktop\METTACITY MAIN\mettacityv2\vendor\livewire\flux\stubs\resources\views\flux\container.blade.php ENDPATH**/ ?>