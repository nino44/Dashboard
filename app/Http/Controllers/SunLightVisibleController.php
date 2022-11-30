<?php

namespace App\Http\Controllers;



use App\Models\SunLightVisible;
use App\Models\Station;
use Carbon\Carbon;

class SunLightVisibleController extends Controller
{
    public function index()
    {

        $stations = Station::all();

        foreach ($stations as $station) {
            $var = [];
            ${'values' . $station->id} = SunLightVisible::all()
                ->where('idEstacao', '=', $station->id)
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d');
                });

            foreach (${'values' . $station->id} as ${'value' . $station->id} => ${'infos' . $station->id}) {
                ${'labels' . $station->id} = ${'value' . $station->id};
                ${'temp' . $station->id} = ${'infos' . $station->id}->pluck('valor')->avg();
                ${'data' . $station->id} = round(${'temp' . $station->id}, 2);

                $var[] = [${'labels' . $station->id}, ${'data' . $station->id}];
            }
            $id = $station->id;

            $all[] = [
                'id' => $id,
                'var' => $var,
            ];
        }

        return view('user.sunlightvisible')->with([
            'all' => $all
        ]);
    }
}
