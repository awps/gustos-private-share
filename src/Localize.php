<?php

namespace GustosPrivateShare;

class Localize{
    public function add(){
        load_plugin_textdomain(
            'gustos-private-share',
            false,
            SPRG_PATH . '/lang'
        );
    }
}
