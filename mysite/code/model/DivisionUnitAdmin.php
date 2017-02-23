<?php

class DivisionUnitAdmin extends ModelAdmin {

    private static $managed_models = array(
        'DivisionUnit',
    );

    private static $url_segment = 'units';

    private static $menu_title = 'Units';
}