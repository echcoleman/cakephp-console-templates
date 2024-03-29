<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (strpos($action, 'add') !== false) {
	return;
}

echo "<?php\n";
echo "\$action = \$this->params['origAction'];\n";
echo "?>\n";

?>
<div class="<?php echo $pluralVar; ?> form">
<?php echo "<?php echo \$this->Form->create('{$modelClass}'); ?>\n"; ?>
	<fieldset>
		<legend><?php echo "<?php echo __('%s {$singularHumanName}', Inflector::humanize(\$action)); ?>"; ?></legend>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$this->Form->input('{$field}');\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
	echo "<?php echo \$this->Form->end(__('Submit')); ?>\n";
?>
</div>
<div class="actions">
	<h3><?php echo "<?php echo __('Actions'); ?>"; ?></h3>
	<ul>
<?php
if (strlen(trim($displayField)) > 0) {
	$deleteModelProperty = $displayField;
	$deleteMessage = "Are you sure you want to delete {$singularVar}: %s?";
}
else {
	$deleteModelProperty = $primaryKey;
	$deleteMessage = "Are you sure you want to delete {$singularVar} # %s?";
}
?>
		<?php echo "<?php if (strpos(\$action, 'add') === false) { ?>\n"; ?>
		<li><?php echo "<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, __('{$deleteMessage}', \$this->Form->value('{$modelClass}.{$deleteModelProperty}'))); ?>"; ?></li>
		<?php echo "<?php } ?>\n"; ?>
		<li><?php echo "<?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index')); ?>"; ?></li>
	</ul>
</div>
