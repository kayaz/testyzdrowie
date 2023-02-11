<?php

namespace App\Observers;

use Illuminate\Http\Request;

//CMS
use App\Models\Client;
use App\Models\ClientRules;
use App\Models\RodoRules;

class ClientObserver
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function created(Client $client)
    {
        $checkboxes = preg_grep("/rule_([0-9])/i", array_keys($this->request->all()));

        if($checkboxes) {
            foreach($checkboxes as $rule) {

                // Get rule_id from request
                $rule_id = preg_replace('/[^0-9]/', '', $rule);

                // Get rodo_rule by rule_id
                $rodo_rule = RodoRules::whereId($rule_id)->first();

                // Save client rodo_rule to database
                ClientRules::create([
                    'client_id' => $client->id,
                    'ip' => $this->request->ip(),
                    'source' => $this->request->headers->get('referer'),
                    'duration' => strtotime("+".$rodo_rule->time." months", strtotime(date("y-m-d"))),
                    'months' => $rodo_rule->time,
                    'status' => 1,
                    'text' => strip_tags($rodo_rule->text)
                ]);
            }
        }
    }

    public function updated(Client $client)
    {
        $checkboxes = preg_grep("/rule_([0-9])/i", array_keys($this->request->all()));

        if($checkboxes) {
            ClientRules::where('client_id', $client->id)->whereStatus(1)->update(['status' => 2, 'canceled_at' => now()]);
            foreach($checkboxes as $rule) {

                // Get rule_id from request
                $rule_id = preg_replace('/[^0-9]/', '', $rule);

                // Get rodo_rule by rule_id
                $rodo_rule = RodoRules::whereId($rule_id)->first();

                // Save client rodo_rule to database
                ClientRules::create([
                    'client_id' => $client->id,
                    'ip' => $this->request->ip(),
                    'source' => $this->request->headers->get('referer'),
                    'duration' => strtotime("+".$rodo_rule->time." months", strtotime(date("y-m-d"))),
                    'months' => $rodo_rule->time,
                    'status' => 1,
                    'text' => strip_tags($rodo_rule->text)
                ]);
            }
        }
    }

}
