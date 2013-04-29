<? 
		/**
		 * @version 1.0
		 */
		/*
			Plugin Name: Category Meta
			Description: Мета теги для категорий
			Author: Polyukh Sergey
			Version: 1.0
		*/
		
		$wpdb->catmeta = $wpdb->prefix . "catmeta";
		
		function px_cm_install() {
		   global $wpdb;		
		   $table_name = $wpdb->prefix . "catmeta";
			  
		   $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
			  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			  `cat_id` bigint(20) unsigned NOT NULL DEFAULT '0',
			  `meta_key` varchar(255) DEFAULT NULL,
			  `meta_value` longtext,
			  PRIMARY KEY (`meta_id`),
			  KEY `post_id` (`cat_id`),
			  KEY `meta_key` (`meta_key`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		
		   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		   dbDelta( $sql );
		}
		register_activation_hook( __FILE__, 'px_cm_install' );
		
  		function add_cat_meta($cat_id, $meta_key, $meta_value, $unique = false) { 
               if(!count(get_category($cat_id)))
			   		return false;
               return add_metadata('cat', $cat_id, $meta_key, $meta_value, $unique);
        }
        
        function delete_cat_meta($cat_id, $meta_key, $meta_value = '') {
                if(!count(get_category($cat_id)))
			   		return false;
                return delete_metadata('cat', $cat_id, $meta_key, $meta_value);
        }

        function get_cat_meta($cat_id, $key = '', $single = false) {
				if(!count(get_category($cat_id)))
			   		return false;
                return get_metadata('cat', $cat_id, $key, $single);
        }
       
        function update_cat_meta($cat_id, $meta_key, $meta_value, $prev_value = '') {
				if(!count(get_category($cat_id)))
			   		return false;        
                return update_metadata('cat', $cat_id, $meta_key, $meta_value, $prev_value);
        }
