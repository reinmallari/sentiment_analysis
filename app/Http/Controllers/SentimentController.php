<?php

namespace App\Http\Controllers;

use App\Models\Sentiment;
use Illuminate\Http\Request;

class SentimentController extends Controller
{

  public function index()
  {
      //
  }

  public function add_sentiment(Request $request){

    $sentiment = Sentiment::create([
      'sentiment_text' => $request['sentiment_text'],
      'positive_count' => $request['positive_count'],
      'negative_count' => $request['negative_count'],
      'sentiment_result' => $request['sentiment_result'],
      'sentiment_score' => $request['sentiment_score']
    ]);

    return response()->json([
     'success'=>true,
    ]);
  }

  public function fetch_list() {

    $pos_file_path = public_path('positive-words.txt');
    $neg_file_path = public_path('negative-words.txt');

    $positive_words = $this->readFileAsUtf8($pos_file_path);
    $negative_words = $this->readFileAsUtf8($neg_file_path);

    return response()->json([
      'positive_list_words' => $positive_words,
      'negative_list_words' => $negative_words
    ]);
  }


  private function readFileAsUtf8($filePath) {

    $content = file_get_contents($filePath);
    $utf8Content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
    $lines = preg_split('/\r\n|\r|\n/', $utf8Content);
    $lines = array_filter($lines, 'strlen');

    return $lines;
  }

  public function get_data(){
    $sentiments = Sentiment::all(); // Fetch all sentiments (you can use pagination if needed)
    return response()->json($sentiments);
  }

}
