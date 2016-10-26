<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Lobster List',
        'product' => 'Contact Management Solution',
        'street' => '4704 Bugg Road',
        'location' => 'Plant City, FL 33567',
        'phone' => '727-457-2232',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'tyler@hackrforce.com';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'tyler@hackrforce.com'
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::useStripe()->noCardUpFront()->teamTrialDays(365);

        Spark::freeTeamPlan()
            ->features([
                'Contact Manager', 'File Imports', 'File Exports'
            ]);

//        Spark::teamPlan('Basic', 'provider-id-1')
//            ->price(10)
//            ->features([
//                'First', 'Second', 'Third'
//            ]);
    }
}
