<?php

namespace App\Http\Resources;

use App\Models\Comments;
use App\Models\Indicator;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Последнее изменение - надо потом переписать
        $last_edit = '';
        // $last_edit_indicatior = 0;
        // $last_edit_comment = 0;
        // $last_edit_info = Patient::where('id', $this->id)->first()->updated_at;
        
        // $indicator = Indicator::where('patient_id', $this->id)->orderBy('created_at', 'desc')->first();

        $comment = Comments::where('patient_id', $this->id)->orderBy('created_at', 'desc')->first();

        // if($indicator != null) {
        //     $last_edit_indicatior = $indicator->created_at;
        // }

        // if($comment != null) {
        //     $last_edit_comment = $comment->created_at;
        // }

        // if($last_edit_info != null && Carbon::parse($last_edit_info) > Carbon::parse($last_edit_indicatior) && Carbon::parse($last_edit_info) > Carbon::parse($last_edit_comment)) {
        //     $last_edit = $last_edit_info;
        // }
        // if($last_edit_indicatior != 0 && Carbon::parse($last_edit_indicatior) > Carbon::parse($last_edit_info) && Carbon::parse($last_edit_indicatior) > Carbon::parse($last_edit_comment)) {
        //     $last_edit = $last_edit_indicatior;
        // }
        // if($last_edit_comment != 0 && Carbon::parse($last_edit_comment) > Carbon::parse($last_edit_info) && Carbon::parse($last_edit_comment) > Carbon::parse($last_edit_indicatior)) {
        //     $last_edit = $last_edit_comment;
        // }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'birth' => $this->birth,
            'gender_id' => $this->birth ? 'мужской': 'женский',
            'growth' => $this->growth,
            'wieght' => $this->wieght,
            'stride_lenth' => $this->stride_lenth,
            'subscription_status' => ($this->subscription == null || Carbon::parse($this->subscription) < Carbon::now()) ? false : true,
            'subscription_date' => $this->subscription,
            'user' => $this->user(),
            'event' => $this->event(),
            'calibrate' => $this->calibrate(),
            'comment' => $comment,
            'last_edit' => $last_edit
        ];
    }
}
