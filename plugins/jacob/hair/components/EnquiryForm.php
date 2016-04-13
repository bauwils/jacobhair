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

        \Mail::send('jacob.hair::mail.enquiry', [
            'enquiry' => $enquiry
        ], function($message) use ($enquiry)
        {
            $message->to('jofry@trueagency.com.au');
        });

        return [
            '#siteFlash' => $this->renderPartial('flash')
        ];
    }

}