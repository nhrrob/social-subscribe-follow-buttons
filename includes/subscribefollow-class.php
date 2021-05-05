<?php

/**
 * Adds NHRROB_SFB_SFButtons_Widget widget.
 */
class NHRROB_SFB_SFButtons_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'subscribefollowbuttons_widget', // Base ID
			esc_html__( 'Social Subscribe - Follow Buttons', 'nhrrob_sfbuttons' ), // Name 
			// nhrrob => github username
			array( 'description' => esc_html__( 'Widget to display social subscribe and follow buttons', 'nhrrob_sfbuttons' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		
        if($instance['channel'] != ''){
            echo '<div class="g-ytsubscribe" data-channel="'.$instance['channel'].'" data-layout="'.$instance['layout'].'" data-count="'.$instance['count'].'"></div>';
        }else {
            echo '<div class="g-ytsubscribe" data-channelid="'.$instance['channel_id'].'" data-layout="'.$instance['layout'].'" data-count="'.$instance['count'].'"></div>';
        }
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Youtube Subs', 'nhrrob_sfbuttons' );
		$channel = ! empty( $instance['channel'] ) ? $instance['channel'] : esc_html__( '', 'nhrrob_sfbuttons' );
		$channel_id = ! empty( $instance['channel_id'] ) ? $instance['channel_id'] : esc_html__( 'UC7BEOZp45E0dGkaYB7OU5ZA', 'nhrrob_sfbuttons' );
		$layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( 'full', 'nhrrob_sfbuttons' );
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( 'default', 'nhrrob_sfbuttons' );

        ?>
        <!-- Title Starts -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'nhrrob_sfbuttons' ); ?>
            </label> 
		    <input 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
                type="text" 
                value="<?php echo esc_attr( $title ); ?>">
		</p>
        <!-- Title Ends -->

        <!-- Channel ID Starts -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'channel_id' ) ); ?>">
                <?php esc_attr_e( 'Youtube Channel ID:', 'nhrrob_sfbuttons' ); ?>
            </label> 
		    <input 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'channel_id' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'channel_id' ) ); ?>" 
                type="text" 
                value="<?php echo esc_attr( $channel_id ); ?>">
		</p>
        <!-- Channel ID Ends -->

        <!-- Channel Starts -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>">
                <?php esc_attr_e( 'Or, Youtube Channel Name:', 'nhrrob_sfbuttons' ); ?>
            </label> 
		    <input 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'channel' ) ); ?>" 
                type="text" 
                value="<?php echo esc_attr( $channel ); ?>"
                placeholder="E.x. techguyweb"
                >
		</p>
        <p><small>Add Yotube Channel ID or Channel Name</small> </p>
        <!-- Channel Ends -->

        <!-- Layout Starts -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>">
                <?php esc_attr_e( 'Layout:', 'nhrrob_sfbuttons' ); ?>
            </label> 
		    <select 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" 
                >
                <option value="default" <?php echo ( $layout == 'default' ) ? 'selected' : ''; ?>>Default</option>
                <option value="full" <?php echo ( $layout == 'full' ) ? 'selected' : ''; ?>>Full</option>
            </select>
		</p>
        <!-- Layout Ends -->

        <!-- Count Starts -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
                <?php esc_attr_e( 'Count:', 'nhrrob_sfbuttons' ); ?>
            </label> 
		    <select 
                class="widefat" 
                id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" 
                >
                <option value="default" <?php echo ( $count == 'default' ) ? 'selected' : ''; ?>>Default</option>
                <option value="hidden" <?php echo ( $count == 'hidden' ) ? 'selected' : ''; ?>>Hidden</option>
            </select>
		</p>
        <!-- Count Ends -->

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['channel'] = ( ! empty( $new_instance['channel'] ) ) ? sanitize_text_field( $new_instance['channel'] ) : '';
		$instance['channel_id'] = ( ! empty( $new_instance['channel_id'] ) ) ? sanitize_text_field( $new_instance['channel_id'] ) : '';
		$instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? sanitize_text_field( $new_instance['layout'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? sanitize_text_field( $new_instance['count'] ) : '';

		return $instance;
	}

} // class NHRROB_SFB_SFButtons_Widget