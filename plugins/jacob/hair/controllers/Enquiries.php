<?php namespace Jacob\Hair\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Enquiries Back-end Controller
 */
class Enquiries extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Jacob.Hair', 'hair', 'enquiries');
    }
}