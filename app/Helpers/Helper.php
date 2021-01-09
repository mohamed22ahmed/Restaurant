<?php


use App\dictionary;

// function description_lang($english_desc, $other_desc){
//     $lang = session('lang');
//     if ($lang == 'ar')
//         return $other_desc;
//     else
//         return $english_desc;
// }

// function t($id){
//     $data = dictionary::find($id);
//     return @description_lang($data['name'], $data['name_ar']);
// }

// function mearge_dic($file){
//     $jsonString = file_get_contents(base_path('resources/lang/Dic/' . $file));
//     $data = json_decode($jsonString, true);
//     foreach ($data['dic'] as $dic) {
//         $dictionary = dictionary::find($dic['id']);
//         if ($dictionary) {
//             $dictionary->name = $dic['name'];
//             $dictionary->name_ar = $dic['name_ar'];
//         } else {
//             $dictionary = new dictionary;
//             $dictionary->company_id = 1;
//             $dictionary->id = $dic['id'];
//             $dictionary->name = $dic['name'];
//             $dictionary->name_ar = $dic['name_ar'];
//         }
//         $dictionary->save();
//     }
// }
