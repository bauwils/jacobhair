<?php namespace Jacob\Hair\Components;

use Cms\Classes\ComponentBase;
use Jacob\Hair\Models\Enquiry;

class EnquiryForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Enquiry Form',
            'description' => 'Accept enquiries to the site.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmit()
    {
        $enquiry = new Enquiry;
        $enquiry->fill(\Input::only('name', 'email', 'phone', 'comment'));
        $enquiry->save();

        \Flash::success('Thank you for your enquiry!');

        return [
            '#siteFlash' => $this->renderPartial('flash')
        ];
    }

}