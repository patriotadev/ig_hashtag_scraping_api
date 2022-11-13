<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    //
    public function getHashtag(Request $request)
    {
        // $api_key = '566df08be7mshf9ef165e818d6dap1b04f7jsn126aa1eead3c';
        // $api_key2 = '4603fd7c76msh5a1ebacced2e554p129103jsn99b44ab329b7';
        $api_key3 = '80840a83b5mshd29ca0fad387836p1a7903jsn31409db599d7';

        $api_host = 'instagram47.p.rapidapi.com';
        $api_url = 'https://instagram47.p.rapidapi.com/hashtag_post';

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => $api_key3,
            'X-RapidAPI-Host' => $api_host
        ])->get($api_url, [
            'hashtag' => $request->hashtag
        ]);

        $json_data = json_decode($response);

        if (isset($json_data)) {
            $data = $json_data->body->edge_hashtag_to_top_posts->edges;
            $node = [];
            foreach ($data as $d) {
                array_push($node, [
                    'image_url' =>  $d->node->display_url,
                    'like_count' => $d->node->edge_liked_by->count,
                    'caption' => $d->node->edge_media_to_caption->edges,
                    'username' => $d->node->owner->id
                ]);
            }
            return $node;
        }

        return null;
    }


    public function postEvent(Request $request)
    {
        try {
            $event_count = Event::all()->count();
            $data = [
                'event' => 'event' .  ((int)$event_count + 1),
                'hashtag' => $request->hashtag,
                'grid' => $request->grid,
                'transition' => $request->transition,
                'data_instagram' => $request->data_instagram
            ];
            $created = Event::create($data);
            if ($created) {
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Event successfully added.'
                    ]
                );
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'Failed',
                    'message' => $th
                ]
            );
        }
    }

    public function getEvent()
    {
        $data = Event::all();
        if ($data) {
            return json_decode($data);
        }
    }

    public function getEventById($id)
    {
        $data = Event::where('id', $id)->get();
        if ($data) {
            return json_decode($data);
        }
    }

    public function updateEventById(Request $request, $id)
    {
        try {
            $data = [
                'grid' => $request->grid,
                'transition' => $request->transition
            ];

            Event::where('id', $id)->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Event successfully updated.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => $th
            ]);
        }
    }

    public function deleteEvent($id)
    {
        try {
            Event::where('id', $id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Event successfully deleted'
            ]);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'Failed',
                    'message' => $th
                ]
            );
        }
    }
}
