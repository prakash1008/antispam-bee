<?php
/**
 * This template renders the main Antispam Bee template.
 *
 * @package Antispam Bee Templates
 */

if ( ! isset( $data ) ) {
	return;
}
?>

<img
	src="<?php echo esc_url( $data->url ); ?>/assets/images/antispam-bee.png"
	width="128"
	height="128"
	alt="Told ya, there will be a bee!"
	style="position: absolute; top: 0; right: 0;"
	onmousemove="console.log('bssssssssssssssssssssssssssssssssssss');"
/>
<h1><?php esc_html_e( 'Antispam Bee Settings', 'antispam-bee' ); ?></h1>
<h2 class="nav-tab-wrapper">
<?php
foreach ( $data->menu as $menu ) :
	$class = ( $menu->active ) ? 'nav-tab nav-tab-active' : 'nav-tab';
	?>
		<a
			href="<?php echo esc_url( $menu->url ); ?>"
			class="<?php echo esc_attr( $class ); ?>"
		>
			<?php echo esc_html( $menu->label ); ?>
		</a>
<?php endforeach; ?>
</h2>

<?php
if ( is_readable( $data->active_tab ) ) {
	$tab_data = $data->tab;
	include $data->active_tab;
}
