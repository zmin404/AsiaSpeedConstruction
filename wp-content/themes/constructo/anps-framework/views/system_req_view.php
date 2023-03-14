<?php
    $reqs = array(
        array(ini_get('max_execution_time'), 600, '', esc_html__('Max execution time', 'constructo')),
        array(ini_get('memory_limit'), 256, 'M', esc_html__('Memory limit', 'constructo')),
        array(ini_get('upload_max_filesize'), 32, 'M', esc_html__('Upload max filesize', 'constructo')),
        array(ini_get('post_max_size'), 32, 'M', esc_html__('Max post size', 'constructo'))
    );

    function anps_req_class($valid) {        
        if( !$valid ) {
            return ' class="invalid"';
        }
    }

    function anps_req_icon($valid) {
        if( !$valid ) {
            return '<i class="fa fa-close"></i>';
        }
        
        return '<i class="fa fa-check"></i>';
    }
?>
<div class="content-inner">
    <div class="row">
        <div class="col-md-12">
            <h3><?php esc_html_e('System requirements', 'constructo'); ?></h3>
            
            <p><?php esc_html_e('If your values do not match the recommended values, you could experience issues with your theme. In this case do contact your hosting provider for assistance.', 'constructo'); ?></p>
            
            <div class="table-responsive">
                <table class="system-req">
                    <thead>
                        <tr>
                            <th></th>
                            <th><?php esc_html_e('Currently', 'constructo'); ?></th>
                            <th><?php esc_html_e('Recommended', 'constructo'); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $allowed_html = array(
                                'tr' => array(
                                    'class' => array()
                                ),
                                'th' => array(
                                    'class' => array()
                                ),
                                'td' => array(
                                    'class' => array()
                                ),
                                'i' => array(
                                     'class' => array()
                                )
                            );

                            foreach($reqs as $req) {
                                $valid = $req[0] >= $req[1];

                                $return = '<tr' . anps_req_class($valid) . '>';
                                $return .= '<th class="system-req-title">' . $req[3] . '</th>';
                                $return .= '<td class="system-req-current">' . $req[0] . '</td>';
                                $return .= '<td class="system-req-recommended">' . $req[1] . $req[2] . '</td>';
                                $return .= '<td class="system-req-icon">' . anps_req_icon($valid) . '</td>';
                                $return .= '</tr>';

                                echo wp_kses($return, $allowed_html);
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    