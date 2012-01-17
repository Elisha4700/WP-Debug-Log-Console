<?php 

require '../../../wp-load.php';

if( isset($_POST['argument']) ){
	
	switch ($_POST['argument']) {

		case 'clear-log':
			echo 'Debug Log is empty';
			break;
		

		case 'defined-constants':
			$constants = get_defined_constants(true);
			foreach( $constants as $key => $constant_group ){
				echo '<div class="section"><div class="arrow"></div>';
				echo '<h3 class="group-name"><span>' . $key . '</span></h3>';
				echo '<ul>';
				foreach( $constant_group as $key => $val ){
					if( is_numeric($val) ){
						$val = '<span class="numeric">' . $val . '</span>';
					} else {
						$val = '<span class="string">"' . $val . '"</span>';
					}
					echo '<li><div class="key">' . $key . '</div><div class="val">' . $val . '</div></li>';
				}
				echo '</ul>';
				echo '</div>';
			}

			break;
		

		case 'php-info':
			echo WP_PLUGIN_URL . '/wp-debug-console/phpinfo.php' . '<br />';
			$file = @file_get_contents( WP_PLUGIN_URL . '/wp-debug-console/phpinfo.php');
			// $file = strip_tags($file, '<td>');
			// $file = str_replace('<td', '<li', $file);
			// $file = str_replace('</td', '</li', $file);
			echo $file;
			break;
		

		default:
			require WP_PLUGIN_DIR . '/wp-debug-console/debug-log-handler.php';
			$dbh = new DebugLogHandler( WP_CONTENT_DIR . '/debug.log' );
			echo $dbh->get_log();

			// foreach($lines as $line){
			// 	echo '<div>' . $line . '</div>';
			// }
			break;
	}

}		
