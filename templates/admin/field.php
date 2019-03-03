<?php
/**
 * This template renders a single field.
 *
 * @package Antispam Bee Templates
 */

declare( strict_types = 1 );

if ( ! isset( $field ) ) {
	return;
}

/**
 * The field to render.
 *
 * @var \Pluginkollektiv\AntispamBee\Field\FieldInterface $field;
 */


if ( $field->type() === 'text' ) : ?>

	<label
		for="antispambee_fields-<?php echo esc_attr( $field->key() ); ?>"
	>
		<?php echo esc_html( $field->label() ); ?>
	</label>
	<input
		id="antispambee_fields-<?php echo esc_attr( $field->key() ); ?>"
		type="text"
		value="<?php echo esc_attr( $field->value() ); ?>"
		name="antispambee_field_config[<?php echo esc_attr( $tab_type ); ?>][<?php echo esc_attr( $type ); ?>][<?php echo esc_attr( $field->key() ); ?>]"
		/>

<?php endif; ?>
