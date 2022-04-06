<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Validator;

class TranslationController extends Controller
{
    public function stringTranslation(Request $request)
    {
        try
		{
            $validator = Validator::make($request->all(),[
                'translate_string' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                return response()->json(['success'=>false,'error'=>201,'message'=> $validator->errors()]);
            }
			$string = $request->translate_string;
            $tr = new GoogleTranslate('en'); // Translates into English
            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
            $tr->setSource('en'); // Translate from English
            $tr->setSource(); // Detect language automatically
            $tr->setTarget('gu'); // Translate to Gujarati
            return response()->json(['success'=>true,'error'=>200,'string'=> $tr->translate($string)]);
		} catch (\Exception $e) {
            return response()->json(['success'=>false,'error'=>201,'exception'=> $e]);
		}
    }
}
