<?php

namespace app\Traits;
use Illuminate\Support\Facades\Log;

trait DeleteModelTrait {
    public function deleteModelTrait($id, $model)
    {
        try{
            $model->find($id)->delete();
            return response() ->json([
                'code' => 200,
                'message' => 'Delete Sucess'
            ],200);

        }catch(\Exception $exception){
            Log::error('Lỗi : '. $exception->getMessage() . '-----line '. $exception->getLine());
            return response() ->json([
                'code' => 500,
                'message' => 'Delete Fail'
            ],500);
        }

    }
}