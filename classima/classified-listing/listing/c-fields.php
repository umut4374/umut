<?php
/**
 * @author        RadiusTheme
 * @package       classified-listing/templates/listing
 * @version       3.0.0
 *
 * @var Form  $form
 * @var array $fields
 * @var int   $listing_id
 */

use Rtcl\Helpers\Functions;
use Rtcl\Models\Form\Form;
use Rtcl\Services\FormBuilder\FBField;
use Rtcl\Services\FormBuilder\FBHelper;

if ( ! is_a( $form, Form::class ) ) {
	return;
}

$fields = $form->getFieldAsGroup( FBField::CUSTOM );
if ( count( $fields ) ) :
	ob_start();
	foreach ( $fields as $fieldName => $field ) {
		$field = new FBField( $field );
		$value = $field->getFormattedCustomFieldValue( $listing_id );

		if ( ! empty( $value ) ) { ?>
            <li class="rtcl-cf-<?php echo esc_attr( $field->getElement() ) ?>">
				<?php if ( $field->getElement() === 'url' ) {
					$nofollow = ! empty( $field->getNofollow() ) ? ' rel="nofollow"' : ''; ?>
                    <a href="<?php echo esc_url( $value ); ?>"
                       target="<?php echo esc_attr( $field->getTarget() ) ?>"<?php echo esc_html( $nofollow ) ?>><?php echo esc_html( $field->getLabel() ) ?></a>
				<?php } else { ?>
                    <span class="rtin-label"><span><?php echo esc_html( $field->getLabel() ) ?></span>:</span>
                    <span class="rtin-title">
                        <?php
                        if ( 'repeater' === $field->getElement() ) {
	                        $repeaterFields = $field->getData( 'fields', [] );
	                        if ( ! empty( $repeaterFields ) && is_array( $value ) ) {
		                        ?>
                                <div class="cfp-repeater-items">
								<?php
								foreach ( $value as $rValueIndex => $rValues ) {
									?>
                                    <div class="cfp-repeater-item">
										<?php
										foreach ( $repeaterFields as $repeaterField ) {
											$rField = new FBField( $repeaterField );
											$rValue = $rValues[ $rField->getName() ] ?? '';
											?>
                                            <div>
												<?php
												$rIcon = $rField->getIconData();
												if ( ! empty( $rIcon['type'] ) && 'class' === $rIcon['type'] && ! empty( $rIcon['class'] ) ) {
													?>
                                                    <div class="rtcl-field-icon"><i class="<?php echo esc_attr( $rIcon['class'] ); ?>"></i></div>
													<?php
												}
												if ( ! empty( $rField->getLabel() ) ) {
													?>
                                                    <span class="rtin-label"><span><?php echo esc_html( $rField->getLabel() ); ?></span>:</span>
												<?php } ?>
												<span class="rtin-title">
													<?php Functions::print_html( FBHelper::getFormattedFieldHtml( $rValue, $rField ) ); ?>
												</span>
											</div>
											<?php
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
		                        <?php
	                        }
                        } elseif ( $field->getElement() === 'color_picker' ) { ?>
                            <span class="cfp-color"
                                  style="width:20px; height:20px; display:inline-block;background-color: <?php echo esc_attr( $value ) ?>;"></span>
                        <?php } elseif ( in_array( $field->getElement(), [ 'select', 'radio', 'checkbox' ] ) ) {
	                        $options           = $field->getOptions();
	                        $enable_icon_class = $field->getData( 'enable_icon_class', false );
	                        if ( $field->getElement() === 'checkbox' ) {
		                        if ( is_array( $value ) && ! empty( $value ) ) {
			                        $_value = [];
			                        foreach ( $options as $option ) {
				                        if ( ! empty( $option['value'] ) && in_array( $option['value'], $value ) ) {
					                        $_value[] = sprintf( '<span class="rtcl-cfp-vi">%s%s</span>',
						                        ! empty( $option['icon_class'] ) && $enable_icon_class ? '<i class="' . esc_attr( $option['icon_class'] )
						                                                                                 . '"></i>' : '', esc_html( $option['label'] ) );

				                        }
			                        }
			                        $value = ! empty( $_value ) ? implode( ', ', $_value ) : '';
		                        }
	                        } else {
		                        foreach ( $options as $option ) {
			                        if ( ! empty( $option['value'] ) && $option['value'] == $value ) {
				                        $value = sprintf( '<span class="rtcl-cfp-vi">%s%s</span>',
					                        ! empty( $option['icon_class'] ) && $enable_icon_class ? '<i class="' . esc_attr( $option['icon_class'] ) . '"></i>'
						                        : '', esc_html( $option['label'] ) );
				                        break;
			                        }
		                        }
	                        }
	                        Functions::print_html( $value );
                        } elseif ( $field->getElement() === 'html' ) {
	                        echo $value;
                        } elseif ( $field->getElement() === 'file' ) {
	                        if ( ! empty( $value ) && is_array( $value ) ) {
		                        foreach ( $value as $file ) {
			                        if ( empty( $file['url'] ) || empty( $file['name'] ) ) {
				                        continue;
			                        }
			                        $ext = pathinfo( $file['url'], PATHINFO_EXTENSION );
			                        if ( $ext == 'pdf' ) {
				                        $iconClass = 'rtcl-icon-file-pdf';
			                        } elseif ( in_array( $ext, [ 'avi', 'divx', 'flv', 'mov', 'ogv', 'mkv', 'mp4', 'm4v', 'divx', 'mpg', 'mpeg', 'mpe' ] ) ) {
				                        $iconClass = 'rtcl-icon-music';
			                        } elseif ( in_array( $ext, [ 'mp3', 'wav', 'ogg', 'oga', 'wma', 'mka', 'm4a', 'ra', 'mid', 'midi' ] ) ) {
				                        $iconClass = 'rtcl-icon-music';
			                        } elseif ( in_array( $ext, [ 'zip', 'gz', 'gzip', 'rar', '7z' ] ) ) {
				                        $iconClass = 'rtcl-icon-file-archive';
			                        } elseif ( in_array( $ext, [ 'jpg', 'jpeg', 'gif', 'png', 'bmp' ] ) ) {
				                        $iconClass = 'rtcl-icon-file-archive';
			                        } elseif ( in_array( $ext, [
				                        'doc',
				                        'ppt',
				                        'pps',
				                        'xls',
				                        'mdb',
				                        'docx',
				                        'xlsx',
				                        'pptx',
				                        'odt',
				                        'odp',
				                        'ods',
				                        'odg',
				                        'odc',
				                        'odb',
				                        'odf',
				                        'rtf',
				                        'txt',
				                        'csv'
			                        ] )
			                        ) {
				                        $iconClass = 'rtcl-icon-doc';
			                        } else {
				                        $iconClass = 'rtcl-icon-doc';
			                        }

			                        ?>
                                    <span class="rtcl-file-item">
										<i class="rtcl-icon rtcl-icon-video <?php echo esc_attr( $iconClass ); ?>"></i>
										<a href="<?php echo esc_url( $file['url'] ) ?>"
                                           target="_blank"><?php echo esc_html( $file['name'] ) ?></a>
									</span>
			                        <?php
		                        }
	                        }
                        } else {
	                        Functions::print_html( $value );
                        } ?>
					</span>
				<?php } ?>
            </li>
		<?php }
	}
	$fieldData = ob_get_clean();
	if ( $fieldData ) :
		printf( '<ul class="rtcl-cf-properties">%s</ul>', $fieldData );
	endif; ?>
<?php endif;
