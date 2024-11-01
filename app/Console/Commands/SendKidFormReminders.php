<?php

namespace App\Console\Commands;

use App\Helper\GlobalHelper;
use App\Models\Parents;
use Illuminate\Console\Command;

class SendKidFormReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:form-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for unfilled forms';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $parents = Parents::where('status',1)->get();

        foreach($parents as $parent)
        {
             $totalDocumentsCount = 0;
             $unfilledKids = [];

            foreach ($parent->kids as $kid) {
            $emptyDocumentsCount = $this->countEmptyDocuments($kid);
            $totalDocumentsCount += $emptyDocumentsCount; 

            if ($emptyDocumentsCount > 0) {
                $unfilledKids[] = $kid->full_name;
            }
        }

        if($totalDocumentsCount > 0)
        {
            $this->info("Reminder sent to {$parent->email}");
            GlobalHelper::sendEmail($parent->email, 'Alert! There are still unfilled forms', 'emails.form_reminder', [
                'parent' => $parent,
                'unfilledKids' => $unfilledKids,
                'totalDocumentsCount' => $totalDocumentsCount,
            ]);
        }
       
            }
    }

     private function countEmptyDocuments($kid)
    {
        return !$kid->emergencyInformation()->count() + !$kid->supervision()->count() + !$kid->supervision()->count() + !$kid->supervision()->count() + 
        !$kid->releaseInformation()->count() + !$kid->photoPermission()->count() + !$kid->alternateSleeping()->count() + !$kid->drugInformation()->count() + !$kid->medicationConsent()->count()
        + !$kid->individualPlan()->count() + !$kid->contract()->count() + !$kid->immunizationRecord()->count();
    }

}
