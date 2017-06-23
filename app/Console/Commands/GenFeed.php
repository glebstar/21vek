<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Object;
use App\Image;
use App\User;

class GenFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genfeed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        define('PATH_TO_FEED', base_path() . '/public/21vek-an-feed.xml');
        $file = file_get_contents (base_path() . '/resources/console/genfeed/head.xml');
        $file = str_replace('--gendate--', date('Y-m-dTH:i:s+08:00'), $file);
        
        $offerApartment = file_get_contents (base_path() . '/resources/console/genfeed/apartment.xml');

        $objects = Object::where('is_trash', 0)->orderBy('id')->get();

        foreach ($objects as $object) {
            $images = Image::where('object_id', $object->id)->orderBy('id')->get();

            if ($object->category == 'квартира') {
                $offer = $offerApartment;

                $offer = str_replace('--id--', $object->id, $offer);
                $offer = str_replace('--url--', config('app.url') . $object->getUrl(), $offer);
                $offer = str_replace('--deal_status--', $object->deal_status, $offer);
                $offer = str_replace('--creation_date--', date('Y-m-dTH:i:s+08:00', $object->creation_date), $offer);
                $offer = str_replace('--last_update_date--', date('Y-m-dTH:i:s+08:00', $object->last_update_date), $offer);
                $offer = str_replace('--sub_locality_name--', $object->sub_locality_name, $offer);

                $address = str_replace([
                    '"', '&', '>', '<', '\''
                ], [
                    '&quot;', '&amp;', '&gt;', '&lt;', '&apos;'
                ], $object->address);
                $offer = str_replace('--address--', $address, $offer);

                $user = User::find($object->user_id);
                $name = $object->name ? $object->name : $user->name;
                $phone = $object->phone ? $object->phone : $user->phone;

                $offer = str_replace('--name--', $name, $offer);
                $offer = str_replace('--phone--', $phone, $offer);

                $offer = str_replace('--price--', $object->price, $offer);
                $offer = str_replace('--area--', $object->area, $offer);
                $offer = str_replace('--rooms--', $object->rooms, $offer);
                $offer = str_replace('--floor--', $object->floor, $offer);
                $offer = str_replace('--renovation--', $object->renovation, $offer);

                $description = str_replace([
                    '"', '&', '>', '<', '\''
                ], [
                    '&quot;', '&amp;', '&gt;', '&lt;', '&apos;'
                ], $object->description);
                $offer = str_replace('--description--', $description, $offer);

                $offer = str_replace('--floors_total--', $object->floors_total, $offer);

                $imgSet = '';
                foreach ($images as $image) {
                    $imgSet .= '<image>' . config('app.url') . '/photo/' . $object->id . '/' . $image->id . '.' . $image->name . '</image>' . "\n";
                }

                $offer = str_replace('--img--', $imgSet, $offer);

                $builtYearSet = '';
                if ($object->built_year) {
                    $builtYearSet = '<built-year>' . $object->built_year . '</built-year>';
                }

                $offer = str_replace('--built_year--', $builtYearSet, $offer);

                $file .= "\n" . $offer;
            }
        }

        $file .= "\n</realty-feed>";

        if ( file_exists(PATH_TO_FEED) ) {
            unlink(PATH_TO_FEED);
        }

        file_put_contents(PATH_TO_FEED, $file);
    }
}
