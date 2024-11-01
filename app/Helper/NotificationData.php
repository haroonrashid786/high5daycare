<?php

namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationData
{


    public static function getDailyUpdateNotificationData()
    {
        return [
            'title' => 'New Daily Update',
            'type' => 'daily_update_alert',
            'message' => 'You have new daily updates attached from the provider.',
            'url' => route('daily-updates'),
        ];
    }

    public static function getActivitySheetNotificationData()
    {
        return [
            'title' => 'New Activity Sheet',
            'type' => 'activity_sheet_alert',
            'message' => 'You have new activity sheet attached from the provider.',
            'url' => route('activity-sheets'),
        ];
    }


    public static function getNewKidNotificationData()
    {
        return [
            'title' => 'New Kid',
            'type' => 'new_kid_alert',
            'message' => "We're thrilled to share that a new child has registered.",
            'url' => null,
        ];
    }

    public static function getNewParentNotificationData()
    {
        return [
            'title' => 'New Parent Registered',
            'type' => 'new_parent_alert',
            'message' => "We're pleased to inform you that a new parent has registered with us",
            'url' => route('provider.parents'),
        ];
    }

    public static function getNewMealNotificationData()
    {
        return [
            'title' => 'New Kid Meal',
            'type' => 'kid_meal_alert',
            'message' => 'New kid meal added by the provider.',
            'url' => route('meals.index'),
        ];
    }

    public static function getInvoiceGeneratedNotificationData()
    {
        return [
            'title' => 'Invoice Generated',
            'type' => 'new_invoice',
            'message' => "New invoice have been generated - Monthly Invoice",
            'url' => route('invoices'),
        ];
    }

    public static function getPaymentGeneratedNotificationData()
    {
        return [
            'title' => 'Payment Generated',
            'type' => 'new_payment',
            'message' => "New payment have been generated - Monthly payment",
            'url' => route('pay.stubs'),
        ];
    }

    public static function getinfantVacantNotificationData()
    {
        return [
            'title' => 'Infant Position Free',
            'type' => 'infant_vacant',
            'message' => "We're Happy to Announce New Kid Spaces for Infants",
            'url' => route('admin.providers'),
        ];
    }

    public static function gettoddlerVacantNotificationData()
    {
        return [
            'title' => 'Toddler Position Free',
            'type' => 'toddler_vacant',
            'message' => "New Kid Space Available for Your Energetic Toddlers. Register Now!",
            'url' => route('admin.providers'),
        ];
    }

    public static function getpreSchoolVacantNotificationData()
    {
        return [
            'title' => 'Pre Schoolers Position Free',
            'type' => 'pre_school_vacant',
            'message' => "Adventure Awaits! New Kid Spaces Open for Preschoolers. Start the Journey!",
            'url' => route('admin.providers'),
        ];
    }

    
    public static function getAccidentAlertNotificationData()
    {
        return [
            'title' => 'Accident Report',
            'type' => 'AccidentAlert',
            'message' => "Alert! new accident report just haved been added",
            'url' => route('incidents'),
        ];
    }

}






