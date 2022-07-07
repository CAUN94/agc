<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event as GCalendar;
// use Spatie\IcalendarGenerator\Components\Calendar;
// use Spatie\IcalendarGenerator\Components\Event as IEvent;
// use Spatie\IcalendarGenerator\Properties\TextProperty;

class CalendarController extends Controller
{
    public function google(){
        $event = new GCalendar;

        $event->name = 'por fin funciona LPM';
        $event->startDateTime = \Carbon\Carbon::now();
        $event->endDateTime = \Carbon\Carbon::now()->addHour();
        // $event->addAttendee(['email' => 'anotherEmail@gmail.com']);
        $event->save();
        return GCalendar::get();
    }

    // public function icalendar(){
        // $calendar = Calendar::create('Laracon online')
        // ->event(IEvent::create('Creating calender feeds')
        //     ->organizer('cristobalugarte6@gmail.com', 'Cris')
        //     ->attendee('cristobal.ugarte@edu.uai.cl')
        // );
        // $calendar->appendProperty(TextProperty::create('METHOD', 'REQUEST'));

        // header("text/calendar");
        // $filename = 'invite.ics';
        // file_put_contents($filename, "\xEF\xBB\xBF".  $calendar->get());

        // \Mail::send(["text"=>"mail"], array(), function($message) use($filename)
        // {
        //     $message->from('cristobalugarte6@gmail.com', 'Jon Doe');
        //     $message->to('cristobalugarte6@gmail.com')->subject('Registration information');

        //     $message->attach($filename, array('mime' => "text/calendar"));
        // });

        // return true;

        // $calendar = Calendar::create('Laracon Online');

        // return response($calendar->get())
        //     ->header('Content-Type', 'text/calendar; charset=utf-8');

        // }
}
